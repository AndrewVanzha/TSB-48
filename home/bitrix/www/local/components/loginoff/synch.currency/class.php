<?php
if ( ! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;

class SynchCurrency extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend = array();

    private static $json_path;
    private static $csv_path;
    private static $xml_path;
    private static $html_path;

    public function __construct($component)
    {
        parent::__construct($component);

        self::$json_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/currency.json';
        self::$csv_path  = $_SERVER['DOCUMENT_ROOT'] . '/currency/cur.csv';
        self::$html_path = $_SERVER['DOCUMENT_ROOT'] . '/currency_rates_table.html';
        self::$xml_path  = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=';
    }

    /**
     * Перезаписываем $this->arParams (удаляем ненужное)
     *
     * @param array $params Параметры компонента
     *
     * @return array Возвращает очищенные параметры компонента
     */
    public function onPrepareComponentParams($params)
    {
        return array(
            "CACHE_TIME"       => $params['CACHE_TIME'],
            "OFFICE_IBLOCK_ID" => $params['OFFICE_IBLOCK_ID'],
            "CBR_IBLOCK_ID"    => $params['CBR_IBLOCK_ID'],
        );
    }

    /**
     * Проверяет подключение необходиимых модулей
     */
    protected function checkModules()
    {
        if ( ! Loader::includeModule('iblock')) {
            throw new Main\LoaderException('Ошибка модуля iblock');
        }
    }

    /**
     * Вывод сообщения об ошибке
     */
    protected function actionMessage()
    {
        $this->arResult["MESSAGE_ERROR"] = $this->MessageError;
        $this->arResult["MESSAGE_SEND"]  = $this->MessageSend;
        foreach ($this->arResult['MESSAGE_ERROR'] as $error) {
            echo "<p style='color: red;'>{$error}</p>";
        }
        foreach ($this->arResult['MESSAGE_SEND'] as $send) {
            echo "<p style='color: green;'>{$send}</p>";
        }
    }

    /**
     * Вывод курсов валют на сайт
     */
    protected function getResult()
    {
        try {
            $json = $this->checkJson();

            if ( ! empty($json['tsb']['time'])) {
                $this->arResult['MODIFY_DATE_FILE'] = $json['tsb']['time'];
            }

            $tsb = $this->getCourseTSB($json);
            $cbr = $this->getCourseCBR($json);

            foreach (self::templateCourses() as $key => $course) {
                if ( ! empty($tsb[$key]['buy'])) {
                    $this->arResult['CUR'][$key] = array(
                        $course['iso_s'] . ' ' . $course['symbol'],
                        $tsb[$key]['buy'] . '/' . $tsb[$key]['status'],
                        $tsb[$key]['sell'] . '/' . $tsb[$key]['status'],
                        $cbr[$key]['course'] . '/' . $cbr[$key]['status']
                    );
                }
            }
        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());
        }
    }

    /**
     * Выполнение компонента
     */
    public function executeComponent()
    {
        try {
            $this->arResult["COMPONENT_ID"] = 'SC';
            $this->checkModules();
            $this->updateCourses();
            $this->getResult();
            $this->actionMessage();

            $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    /**
     * Обновляем курсы валют на сайте
     */
    public function updateCourses()
    {
        try {
            // проверяем существование json-файла и его валидность
            $json = $this->checkJson();

            // проверяем существование csv-файла
            if ( ! file_exists(self::$csv_path)) {
                throw new Exception('CSV-файл с курсами валют отсутствует');
            }

            // если время последнего обновления курсов ТСБ < времени обновления файла с актуальными курсами, то обновляем курсы в json
            if ($json['tsb']['time'] < filectime(self::$csv_path)) {
                $tsb_courses = $this->parseCoursesTSB();

                $json   = $this->updateCoursesTSB($tsb_courses, $json);
                $update = true;
            }

            // если курсы валют ЦБ сегодня ещё не обновлялись, то обновляем
            if ($json['cbr']['time'] < mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
                $cbr_courses = $this->parseCoursesCBR();

                $json   = $this->updateCoursesCBR($cbr_courses, $json);
                $update = true;

                $this->addCourseForDynamic($json['cbr']['data']);
            }

            // если обновлились данные по курсам ТСБ или ЦБ, то записываем всё в json-файл
            if ( ! empty($update)) {
                file_put_contents(self::$json_path, json_encode($json));

                // если запись в json-файл не произошла, заносим в логи ошибку
                if (filectime(self::$json_path) < time() - 120) {
                    $this->logger('error', 'При обновлении json-файла возникла ошибка');
                } else {
                    $this->logger('notice', 'Json-файл успешно обновлен');

                    // обновляем html-файл для банки.ру
                    $this->createHtml($json);
                }
            }
        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());
        }
    }

    /**
     * Проверка json-файла с курсами валют
     *
     * @return array
     */
    private function checkJson()
    {
        try {
            if ( ! file_exists(self::$json_path)) {
                throw new Exception('Файл json отстутствует. Будет создан новый файл.');
            }

            $json = json_decode(file_get_contents(self::$json_path), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Невалидный json. Данные будут полностью заменены новыми.');
            }
        } catch (Exception $e) {
            $json = array(
                'tsb' => array(
                    'time' => time() - 365 * 24 * 60 * 60,
                    'data' => []
                ),
                'cbr' => array(
                    'time' => time() - 365 * 24 * 60 * 60,
                    'data' => []
                )
            );

            $this->logger('warning', $e->getMessage());
        }

        return $json;
    }

    /**
     * Обновляем курсы валют по банку ТСБ
     *
     * @param array $courses Массив с актуальными курсами валют ТСБ банка
     * @param array $json Массив последних обновленных данных по курсам валют
     *
     * @return array Обновленный массив данных по курсам валют
     */
    private function updateCoursesTSB(array $courses, array $json)
    {
        $currency_out = [];

        foreach ($courses as $key => $course) {
            $currency_out[$key] = $course;

            if (empty($json['tsb']['data'][$key])) {
                continue;
            }

            $currency_out[$key] = $this->updateCoursesTSBStatus($course, $json['tsb']['data'][$key]);
        }

        $json['tsb']['time'] = time();
        $json['tsb']['data'] = $currency_out;

        return $json;
    }

    /**
     * Обновляем курсы валют по ЦБ РФ
     *
     * @param array $courses Массив с актуальными курсами валют ЦБ РФ
     * @param array $json Массив последних обновленных данных по курсам валют
     *
     * @return array Обновленный массив данных по курсам валют
     */
    private function updateCoursesCBR(array $courses, array $json)
    {
        $currency_out = [];

        foreach ($courses as $key => $course) {
            $currency_out[$key] = $course;

            if (empty($json['cbr']['data'][$key])) {
                continue;
            }

            $currency_out[$key] = $this->updateCoursesCBRStatus($course, $json['cbr']['data'][$key]);
        }

        $json['cbr']['time'] = time();
        $json['cbr']['data'] = $currency_out;

        return $json;
    }

    /**
     * Обновляем статусы курса валюты ТСБ
     *
     * @param array $course Актуальный курс валюты
     * @param array $json Массив последних обновленных данных по курсам валют
     *
     * @return array Возвращает массив с обновленными статусами курсов валют ТСБ
     */
    private function updateCoursesTSBStatus(array $course, array $json)
    {
        foreach ($course['currency'] as $key => $currency) {
            if ( ! empty($json['currency'][$key])) {
                if ($json['currency'][$key]['buy'] === $currency['buy'] && $json['currency'][$key]['sell'] === $currency['sell']) {
                    $course['currency'][$key]['status'] = $json['currency'][$key]['status'];
                } elseif ($json['currency'][$key]['buy'] > $currency['buy']) {
                    $course['currency'][$key]['status'] = '<';
                } else {
                    $course['currency'][$key]['status'] = '>';
                }
            }
        }

        return $course;
    }

    /**
     * Обновляем статусы курса валюты ЦБ РФ
     *
     * @param array $course Актуальный курс валюты
     * @param array $json Массив последних обновленных данных по курсам валют
     *
     * @return array Возвращает массив с обновленными статусами курсов валют ЦБ РФ
     */
    private function updateCoursesCBRStatus(array $course, array $json)
    {
        if ($json['course'] === $course['course']) {
            $course['status'] = $json['status'];
        } elseif ($json['course'] > $course['course']) {
            $course['status'] = '<';
        } else {
            $course['status'] = '>';
        }

        return $course;
    }

    /**
     * Шаблонные данные по курсам валют
     * @return array
     */
    private static function templateCourses()
    {
        $courses = [];

        $courses['USD']['name']   = 'Доллар США';
        $courses['USD']['symbol'] = '$';
        $courses['USD']['count']  = 1;
        $courses['USD']['iso_n']  = 840;
        $courses['USD']['iso_s']  = 'USD';

        $courses['EUR']['name']   = 'Евро';
        $courses['EUR']['symbol'] = '€';
        $courses['EUR']['count']  = 1;
        $courses['EUR']['iso_n']  = 978;
        $courses['EUR']['iso_s']  = 'EUR';

        $courses['GBP']['name']   = 'Фунт стерлингов Соединенного королевства';
        $courses['GBP']['symbol'] = '£';
        $courses['GBP']['count']  = 1;
        $courses['GBP']['iso_n']  = 826;
        $courses['GBP']['iso_s']  = 'GBP';

        $courses['CHF']['name']   = 'Швейцарский франк';
        $courses['CHF']['symbol'] = '₣';
        $courses['CHF']['count']  = 1;
        $courses['CHF']['iso_n']  = 756;
        $courses['CHF']['iso_s']  = 'CHF';

        $courses['JPY']['name']   = 'Японская иена';
        $courses['JPY']['symbol'] = '¥';
        $courses['JPY']['count']  = 100;
        $courses['JPY']['iso_n']  = 392;
        $courses['JPY']['iso_s']  = 'JPY';

        $courses['CNY']['name']   = 'Китайский юань';
        $courses['CNY']['symbol'] = '¥';
        $courses['CNY']['count']  = 10;
        $courses['CNY']['iso_n']  = 156;
        $courses['CNY']['iso_s']  = 'CNY';

        $courses['PLN']['name']   = 'Польский злотый';
        $courses['PLN']['symbol'] = 'zł';
        $courses['PLN']['count']  = 1;
        $courses['PLN']['iso_n']  = 985;
        $courses['PLN']['iso_s']  = 'PLN';

        return $courses;
    }

    /**
     * Парсим CSV-файл с курсами валют банка ТСБ
     *
     * @return array
     */
    private function parseCoursesTSB()
    {
        try {
            $fd = @fopen(self::$csv_path, "r");

            if ( ! $fd) {
                throw new Exception('CSV-файл с курсами валют не доступен.');
            }

            $result = [];

            while (($data = fgetcsv($fd, 1000, ";")) !== false) {
                $num = count($data);
                if ($num == 6) {
                    for ($c = 0; $c < $num; $c++) {
                        $result[$data['0']]['code']                           = $data['0'];
                        $result[$data['0']]['name']                           = $data['1'];
                        $result[$data['0']]['date']                           = $data['2'];
                        $result[$data['0']]['currency'][$data['3']]['buy']    = $data['4'];
                        $result[$data['0']]['currency'][$data['3']]['sell']   = $data['5'];
                        $result[$data['0']]['currency'][$data['3']]['status'] = '>';
                    }
                }
            }

            @fclose($fd);

            return $result;
        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());

            return [];
        }
    }

    /**
     * Парсим XML-файл с курсами валют ЦБ РФ
     *
     * @return array
     */
    private function parseCoursesCBR()
    {
        try {
            $data = $this->loadCoursesCBR();

            if (empty($data)) {
                throw new Exception('Данные по курсам валют ЦБ РФ отсутствуют');
            }

            $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
            preg_match_all($pattern, $data, $courses, PREG_SET_ORDER);

            $result = [];

            foreach ($courses as $course) {
                foreach (self::templateCourses() as $template) {
                    if ($course[2] == $template['iso_n']) {
                        $result[$template['iso_s']]['course'] = str_replace(",", ".", $course[4]);
                        $result[$template['iso_s']]['status'] = '>';
                    }
                }
            }

            return $result;

        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());

            return [];
        }
    }

    /**
     * Загрузка курсов валют с ЦБ РФ
     *
     * @return string Данные по курсам валют
     * @throws Exception
     */
    private function loadCoursesCBR()
    {
        $date = date('d/m/Y');
        $link = self::$xml_path . $date;

        $fd = @fopen($link, "r");

        if ( ! $fd) {
            throw new Exception('Сервер данных ЦБ РФ не отвечает.');
        }

        $data = '';

        while ( ! feof($fd)) {
            $data .= @fgets($fd, 4096);
        }

        @fclose($fd);

        return $data;
    }

    /**
     * Получение списка городов
     *
     * @return array
     */
    private function getCity()
    {
        $cities = [];

        $rsCities = CIBlockElement::GetList(
            array(),
            Array('IBLOCK_ID' => 114, 'ACTIVE' => 'Y'),
            false,
            false,
            Array('ID', 'NAME', 'PROPERTY_ATT_CODE')
        );
        while ($arCity = $rsCities->Fetch()) {
            $cities[] = $arCity;
        }

        return $cities;
    }

    /**
     * Создание HTML-файла с курсами валют
     *
     * @param array $json Массив с данными по курсам валют
     */
    private function createHTML(array $json)
    {
        $date = date('d.m.y', $json['tsb']['time']);

        $output = '<!DOCTYPE html>';
        $output .= '<html lang="ru">';
        $output .= '<head>';
        $output .= '<title>Курсы обмена наличной иностранной валюты, установленные банком на ' . $date . '</title>';
        $output .= '<style type="text/css">table {border-collapse: collapse;}td, th {padding: 5px 10px; border-bottom: 1px #999 solid;}th {text-align: left; border-width: 2px;}tr:hover td {background-color: #F3F3F3; border-color: #555;}</style>';
        $output .= '</head>';
        $output .= '<body>';

        $cities = $this->getCity();

        foreach ($cities as $city) {
            $output .= '<h2>' . $city['NAME'] . '</h2>';
            $output .= '<table>';
            $output .= '<thead>';
            $output .= '<tr><th>код</th><th>единиц</th><th>название валюты</th><th>покупка</th><th>продажа</th></tr>';
            $output .= '</thead>';

            if ( ! empty($city['PROPERTY_ATT_CODE_VALUE'])) {
                $courses = $this->minimumCourse($city, $json);

                foreach ($courses as $key => $course) {
                    if ($course['buy'] == 0) {
                        continue;
                    }

                    $output .= '<tr>';
                    $output .= '<td>' . $key . '</td>';
                    $output .= '<td>' . self::templateCourses()[$key]['count'] . '</td>';
                    $output .= '<td>' . self::templateCourses()[$key]['name'] . '</td>';
                    $output .= '<td>' . str_replace('.', ',', $course['buy']) . '</td>';
                    $output .= '<td>' . str_replace('.', ',', $course['sell']) . '</td>';
                    $output .= '</tr>';
                }
            }

            $output .= '</table>';
        }

        file_put_contents(self::$html_path, $output);
    }

    /**
     * Формирование минимальных курсов валют для выбранного города
     *
     * @param array $city Данные по городу и офисам
     * @param array $json Массив с данными по курсам валют
     *
     * @return array Возвращает минимальные курсы валют под текущий город
     */
    private function minimumCourse(array $city, array $json)
    {
        $courses = [];

        foreach ($city['PROPERTY_ATT_CODE_VALUE'] as $code) {
            if (empty($json['tsb']['data'][$code])
                || ($city['ID'] == 399 && $code != 10013)
                || ($city['ID'] == 400 && $code != 10017)
            ) {
                continue;
            }

            $course_code = $json['tsb']['data'][$code]['currency'];

            foreach ($course_code as $key => $course) {
                if (empty($courses[$key]) || $courses[$key]['buy'] > $course['buy']) {
                    $courses[$key]['buy']    = $course['buy'];
                    $courses[$key]['sell']   = $course['sell'];
                    $courses[$key]['status'] = $course['status'];
                }
            }
        }

        return $courses;
    }

    /**
     * Получаем курсы валют ТСБ для вывода на сайт
     *
     * @param array $json Массив с курсами валют
     *
     * @return array Возвращает массив курсов валют ТСБ
     * @throws Exception
     */
    private function getCourseTSB(array $json)
    {
        if (empty($json['tsb']['data'])) {
            throw new Exception('Данные по курсам валют ТСБ отсутствуют');
        }

        $data = $json['tsb']['data'];

        $office_id = \GarbageStorage::get('OfficeId');

        if ( ! empty($office_id)) {
            $result = $this->getCourseByOffice($office_id, $data);
        } else {
            session_start();

            if (isset($_SESSION['city'])) {
                $selectCity = $_SESSION['city'];
            } else {
                $selectCity = 399;
            }

            $result = $this->getCourseByCity($selectCity, $json);
        }

        return $result;
    }

    /**
     * Получаем курсы валют ТСБ конкретного офиса
     *
     * @param int $office_id ID офиса банка ТСБ
     * @param array $data Данные курсов валют
     *
     * @return array Возвращает курсы валют по текущему офису
     * @throws Exception
     */
    private function getCourseByOffice($office_id, array $data)
    {
        $rsOffices = CIBlockElement::GetList(
            Array("SORT" => "ASC"),
            Array("IBLOCK_ID" => 115, "ID" => $office_id),
            false,
            false,
            Array("IBLOCK_ID", "ID", "PROPERTY_ATT_CODE")
        );

        while ($arOffice = $rsOffices->Fetch()) {
            if ( ! empty($arOffice['PROPERTY_ATT_CODE_VALUE'])) {
                return $data[$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'];
            }
        }

        throw new Exception('Не удалось получить данные курсов валют по офису');
    }

    /**
     * Получаем курсы валют ТСБ конкретного города
     *
     * @param int $city ID города
     * @param array $json Данные курсов валют
     *
     * @return array Возвращает курсы валют по текущему городу
     * @throws Exception
     */
    private function getCourseByCity($city, array $json)
    {
        $cities = CIBlockElement::GetList(
            Array("SORT" => "ASC"),
            Array("IBLOCK_ID" => "114", "ID" => $city, 'ACTIVE' => 'Y'),
            false,
            false,
            Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_CODE")
        );

        while ($city = $cities->Fetch()) {
            if ( ! empty($city['PROPERTY_ATT_CODE_VALUE'])) {
                return $this->minimumCourse($city, $json);
            }
        }

        throw new Exception('Не удалось получить данные курсов валют по городу');
    }

    /**
     * Получаем курсы валют ЦБ РФ для вывода на сайт
     *
     * @param array $json Массив с курсами валют
     *
     * @return array Возвращает массив курсов валют ЦБ РФ
     * @throws Exception
     */
    private function getCourseCBR(array $json)
    {
        if (empty($json['cbr']['data'])) {
            throw new Exception('Данные по курсам валют ЦБ РФ отсутствуют');
        }

        return $json['cbr']['data'];
    }

    /**
     * Добавляем курсы валют ЦБ РФ для динамического графика
     *
     * @param array $data Данные по курсам валют ЦБ РФ
     */
    private function addCourseForDynamic(array $data)
    {
        $el    = new CIBlockElement;
        $props = [];

        foreach ($data as $key => $course) {
            $props['ATT_' . $key] = $course['course'];
        }

        $el->Add(Array(
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"         => $this->arParams['CBR_IBLOCK_ID'],
            "PROPERTY_VALUES"   => $props,
            "NAME"              => date("Y-m-d", time()),
            "ACTIVE"            => "Y",
            "PREVIEW_TEXT"      => "",
            "DETAIL_TEXT"       => ""
        ));
    }

    /**
     * Логирование ошибок, предупреждений, действий
     *
     * @param string $type Тип лог-данных
     * @param string $message Сообщение для записи в логи
     */
    private function logger($type, $message)
    {
        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'] . $this->GetPath() . '/log/' . $type . '.log',
            '[' . date('d.m.Y H:i:s') . ']' . $message . PHP_EOL,
            FILE_APPEND
        );
    }
}
