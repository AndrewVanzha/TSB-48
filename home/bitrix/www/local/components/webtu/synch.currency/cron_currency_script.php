<?php
//use \Bitrix\Main;
//use \Bitrix\Main\Application;
//use \Bitrix\Main\Loader;

//require_once ($_SERVER['DOCUMENT_ROOT']."/local/php_interface/functions.php");

class ScriptSynchCurrency {
    public $MessageError = array();
    public $MessageSend  = array();

    private static $base_path;
    private static $json_path;
    private static $csv_path;
    private static $rates_path;
    private static $rates_json_path;
    private static $xml_path;
    private static $day_path;

    //public function __construct($component)
    public function __construct()
    {
        //parent::__construct($component);

        self::$base_path = "/home/bitrix/www";
        self::$json_path = self::$base_path . '/currency/currency.json';
        //self::$json_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/currency.json';
        self::$csv_path = self::$base_path . '/currency/cur.csv';
        self::$rates_path = self::$base_path . '/currency/rates.csv';
        self::$rates_json_path = self::$base_path . '/currency/rates.json'; // входной файл данных
        //self::$rates_json_path = self::$base_path . '/currency/full.json'; // входной файл данных
        self::$xml_path = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=';
        self::$day_path = self::$base_path . '/currency/day.json';
    }

    public function updateTest()
    {
        //AddMessage2Log(date('d-m-Y H:i:s'));
        $filename = self::$base_path . "/chastnym-klientam/obmen-valyut/test" . "_" . date("Y-m-d_H-i-s") . ".txt";
        //file_put_contents($filename, self::$json_path . ' ' . self::$rates_path);
        //file_put_contents($filename, self::$json_path);
        //file_put_contents($filename, self::$rates_path);
        //echo $filename;
    }

    /**
     * Обновляем курсы валют на сайте
     */
    public function updateCourses()
    {
        //file_put_contents(self::$base_path . '/currency/a_time_cron.json', json_encode(date('F j, Y, g:i a')));
        try {
            // проверяем существование json-файла и его валидность
            $json = $this->checkJson();
            $day_json = $this->checkDayJson();

            // проверяем существование csv-файла
            //if (!file_exists(self::$csv_path)) {
            //    throw new Exception('CSV-файл с курсами валют отсутствует');
            //}

            // проверяем существование json-файла
            if (!file_exists(self::$rates_json_path)) {
                throw new Exception('входной JSON-файл с курсами валют отсутствует');
            }

            // если время последнего обновления курсов ТСБ < времени обновления файла с актуальными курсами, то обновляем курсы в json
            //if ($json['tsb']['time'] < filectime(self::$csv_path)) {
            //if ($json['tsb']['time'] < filectime(self::$rates_path)) {
            if ($json['tsb']['time'] < filectime(self::$rates_json_path)) { // реагируем на время изменения входного json-файла
                $tsb_courses = $this->parseCoursesTSB();
                //file_put_contents(self::$base_path . '/logs/a_tsb_courses_cron.json', json_encode($tsb_courses));

                if (!empty($tsb_courses)) {
                    $json = $this->updateCoursesTSB($tsb_courses, $day_json); // сравниваю с данными на начало дня
                    $update = true;
                }
            }

            // если курсы валют ЦБ сегодня ещё не обновлялись, то обновляем
            if ($json['cbr']['time'] < mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
                $cbr_courses = $this->parseCoursesCBR();
                //file_put_contents(self::$base_path . '/currency/cbr_courses_cron.json', json_encode($cbr_courses));

                if (!empty($cbr_courses)) {
                    $json = $this->updateCoursesCBR($cbr_courses, $json);
                    $update = true;

                    //$this->addCourseForDynamic($json['cbr']['data']);  - делает отдельно в агенте битрикса
                }
            }

            // если обновились данные по курсам ТСБ или ЦБ, то записываем всё в json-файл
            if (!empty($update)) {
                file_put_contents(self::$json_path, json_encode($json));

                // если запись в json-файл не произошла, заносим в логи ошибку
                if (filectime(self::$json_path) < time() - 120) {
                    $this->logger('error', 'При обновлении json-файла возникла ошибка');
                } else {
                    $this->logger('notice', 'Json-файл успешно обновлен');

                    // обновляем html-файл для банки.ру
                    //$this->createHtml($json);   - делает отдельно в агенте битрикса
                    //$this->add_history_rate($json);   - делает отдельно в агенте битрикса
                }
            }

            // обновляю json-файл данных day.json с курсами ТСБ и ЦБ для сравнения на завтра
            $current_time = getdate();
            if($current_time['hours'] == 23 && $current_time['minutes'] == 50) {
            //if($current_time['hours'] == 0 && $current_time['minutes'] < 5) {
                file_put_contents(self::$day_path, json_encode($json));
            }
            //$this->test_logger('test', ' qq ');
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
            if (!file_exists(self::$json_path)) {
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
     * Проверка json-файла с курсами валют для опорной точки (начало дня)
     *
     * @return array
     */
    private function checkDayJson()
    {
        try {
            if (!file_exists(self::$day_path)) {
                throw new Exception('Файл day.json отстутствует. Будет создан новый файл из currency.json.');
            }

            $json = json_decode(file_get_contents(self::$day_path), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Невалидный day.json. Данные будут полностью заменены новыми.');
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
     * Парсим CSV-файл с курсами валют банка ТСБ
     *
     * @return array
     */
    private function parseCoursesTSB()
    {
        $csv_count = 6;
        $rates_count = 8;
        try {
            //$fd = @fopen(self::$csv_path, "r");
            $fd = @fopen(self::$rates_path, "r"); // парсим csv (осталось, не используется)

            if (!$fd) {
                throw new Exception('входной CSV-файл с курсами валют не доступен.');
            }

            $courses = [];
            $result = [];
            $rates = []; // первоначальный расчет
            $table = [];
            $ii = 0;

            while (($data = fgetcsv($fd, 1000, ";")) !== false) {
                $num = count($data);
                    for ($c = 0; $c < $num; $c++) {
                        $table[$ii][$c] = $data[$c];

                    }
                $ii += 1;
            }
            for ($ii=0; $ii<count($table); $ii++) { // формирую массив курсов по офисам и валютам
                $aux = [];
                $aux['code'] = $table[$ii][0];
                $aux['name'] = $table[$ii][1];
                $aux['time'] = $table[$ii][2];
                $aux['cur'] = $table[$ii][3];
                $aux['buy'] = $table[$ii][4];
                $aux['sell'] = $table[$ii][5];
                $aux['multi'] = $table[$ii][6];
                $aux['volume'] = $table[$ii][7];
                $courses[$table[$ii][0]]['code'] = $table[$ii][0];
                $courses[$table[$ii][0]]['name'] = $table[$ii][1];
                $courses[$table[$ii][0]]['date'] = $table[$ii][2];
                $courses[$table[$ii][0]]['currency'][$table[$ii][3]][] = $aux;
                unset($aux);
            }
            foreach ($courses as $code=>$item) {
                $rates[$code]['code'] = $item['code'];
                $rates[$code]['name'] = $item['name'];
                $rates[$code]['date'] = $item['date'];
                foreach ($item['currency'] as $cur=>$rtdata) {
                    for ($ii=0; $ii<count($rtdata); $ii++) {
                        $rates[$code]['currency'][$cur][$ii]['buy'] = $rtdata[$ii]['buy'];
                        $rates[$code]['currency'][$cur][$ii]['buy_move'] = '=';
                        $rates[$code]['currency'][$cur][$ii]['sell'] = $rtdata[$ii]['sell'];
                        $rates[$code]['currency'][$cur][$ii]['sell_move'] = '=';
                        $rates[$code]['currency'][$cur][$ii]['multi'] = $rtdata[$ii]['multi'];
                        $rates[$code]['currency'][$cur][$ii]['volume'] = $rtdata[$ii]['volume'];
                    }
                }
            }

            @fclose($fd);
            //file_put_contents(self::$base_path . '/currency/a_table.json', json_encode($table));
            //file_put_contents(self::$base_path . '/currency/a_rates.json', json_encode($rates));
            unset($table);
            unset($courses);

            $curtab = [];
            $table = [];
            $dataID_except_1 = 10900; // офис, где есть металлы
            $dataID_except_2 = 10901; // офис, где есть металлы
            if (file_exists(self::$rates_json_path)) {                          // парсим входной json
                $fjdArr = json_decode(file_get_contents(self::$rates_json_path), true);
                foreach ($fjdArr['rates'] as $ii => $arItem) {
                    if ($arItem['id_cash'] != $dataID_except_2) {
                        if ($arItem['iso']!='XAG' && $arItem['iso']!='XAU' && $arItem['iso']!='XPD' && $arItem['iso']!='XPT') {
                            $aux = [];
                            $aux['buy'] = $arItem['mcurs_b'];
                            $aux['buy_move'] = '=';
                            $aux['sell'] = $arItem['mcurs_s'];
                            $aux['sell_move'] = '=';
                            $aux['multi'] = $arItem['lza_b'];
                            $aux['volume'] = $arItem['mmore_b'];

                            $table[$arItem['id_cash']]['code'] = $arItem['id_cash'];
                            $table[$arItem['id_cash']]['name'] = $arItem['id_decree'];  // номер распоряжения
                            $table[$arItem['id_cash']]['date'] = $arItem['date_decree'];
                            $table[$arItem['id_cash']]['time'] = $arItem['unix_date'];
                            $table[$arItem['id_cash']]['currency'][$arItem['iso']][(int)$arItem['mmore_b']] = $aux;
                            unset($aux);
                        }
                    }
                }

                //file_put_contents(self::$base_path . '/currency/a_table.json', json_encode($table));
                foreach ($table as $office=>$arOffice) {
                    $curtab[$office]['code'] = $arOffice['code'];
                    $curtab[$office]['name'] = $arOffice['name'];
                    $curtab[$office]['date'] = $arOffice['date'];
                    $curtab[$office]['time'] = $arOffice['time'];
                    foreach ($arOffice['currency'] as $cur=>$arItem) {
                        ksort($arItem);  // сортирую в порядке возрастания ключа=volume
                        $kk = 0;
                        foreach ($arItem as $item) {
                            $curtab[$office]['currency'][$cur][$kk] = $item;  // переписываю в числовой массив
                            $kk += 1;
                        }
                    }
                }
            } else {
                throw new Exception('входной JSON-файл с курсами валют не доступен.');
            }
            unset($table);
            //file_put_contents(self::$base_path . '/currency/a_table_agent.json', json_encode($table));

            $table = [];
            foreach ($curtab as $nn=>$office) {
                $table[$nn]['code'] = $office['code'];
                $table[$nn]['name'] = $office['name'];
                $table[$nn]['date'] = $office['date'];
                $table[$nn]['time'] = $office['time'];

                //$template_courses = $this->templateCourses();
                foreach ($this->templateCourses() as $tt=>$template) {
                    if (array_key_exists($tt, $office['currency'])) {
                        $table[$nn]['currency'][$tt] = $office['currency'][$tt];
                    }
                }
            }
            //file_put_contents(self::$base_path . '/currency/a_curtab.json', json_encode($curtab));

            return $table; // сортировка, как задано в пилотном объекте self::$courses_list

            //return $curtab; // сортировка, как задано в АБС

            //return $rates;
        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());

            return [];
        }
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
            if (!empty($json['currency'][$key])) {
                if ($json['currency'][$key][0]['buy'] == $currency[0]['buy']) {
                    $course['currency'][$key][0]['buy_move'] = '=';
                } elseif ($json['currency'][$key][0]['buy'] > $currency[0]['buy']) {
                    $course['currency'][$key][0]['buy_move'] = '<';
                } else {
                    $course['currency'][$key][0]['buy_move'] = '>';
                }
                if (isset($json['currency'][$key][1]) && isset($currency[1])) {
                    if ($json['currency'][$key][1]['buy'] == $currency[1]['buy']) {
                        $course['currency'][$key][1]['buy_move'] = '=';
                    } elseif ($json['currency'][$key][1]['buy'] > $currency[1]['buy']) {
                        $course['currency'][$key][1]['buy_move'] = '<';
                    } else {
                        $course['currency'][$key][1]['buy_move'] = '>';
                    }
                }

                if ($json['currency'][$key][0]['sell'] == $currency[0]['sell']) {
                    $course['currency'][$key][0]['sell_move'] = '=';
                } elseif ($json['currency'][$key][0]['sell'] > $currency[0]['sell']) {
                    $course['currency'][$key][0]['sell_move'] = '<';
                } else {
                    $course['currency'][$key][0]['sell_move'] = '>';
                }
                if (isset($json['currency'][$key][1]) && isset($currency[1])) {
                    if ($json['currency'][$key][1]['sell'] == $currency[1]['sell']) {
                        $course['currency'][$key][1]['sell_move'] = '=';
                    } elseif ($json['currency'][$key][1]['sell'] > $currency[1]['sell']) {
                        $course['currency'][$key][1]['sell_move'] = '<';
                    } else {
                        $course['currency'][$key][1]['sell_move'] = '>';
                    }
                }

            }
        }

        return $course;
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

            foreach ($courses as $key=>$course) {
                //foreach (self::templateCourses() as $template) {
                foreach ($this->templateCourses() as $tt=>$template) {
//if ($course[2] == $template['iso_n'] && $template['iso_n'] !== 376 && $template['iso_n'] !== 784 && $template['iso_n'] !== 941 && $template['iso_n'] !== 764 && $template['iso_n'] !== 818 && $template['iso_n'] !== 682) { // кроме ILS, AED, RSD, THB, SAR
                    if ($course[2] == $template['iso_n'] && $template['iso_n'] != '376' && $template['iso_n'] != '682' && $template['iso_n'] != '484') { // кроме ILS, SAR, MXN
//if ($course[2] == $template['iso_n'] && $template['iso_n'] !== 376 && $template['iso_n'] !== 784 && $template['iso_n'] !== 941 && $template['iso_n'] !== 764 && $template['iso_n'] !== 818 && $template['iso_n'] !== 682 && $template['iso_n'] !== 634 && $template['iso_n'] !== 484) { // кроме ILS, AED, RSD, THB, SAR, QAR, MXN
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
     * Загрузка курсов валют с ЦБ РФ
     *
     * @return string Данные по курсам валют
     * @throws Exception
     */
    private function loadCoursesCBR()
    {
        $date = date('d/m/Y');
        $link = self::$xml_path . $date; // - это все делается в агенте битрикса

        $fd = @fopen($link, "r");

        if (!$fd) {
            throw new Exception('Сервер данных ЦБ РФ не отвечает.');
        }

        $data = '';

        while (!feof($fd)) {
            $data .= @fgets($fd, 4096);
        }

        @fclose($fd);

        file_put_contents(self::$base_path . '/currency/cur_cbr.xml', $data);

        /*$data = '';
        try {
            $filename = self::$base_path . '/currency/cur_cbr.json';
            $data = json_decode(file_get_contents($filename), true); // чтение сделанного в агенте файла
            if ($data == false) {
                throw new Exception('Файл ' . $filename . ' с данными по курсам валют ЦБ РФ отсутствует');
            }

        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());
        }*/

        return $data;
    }

    /**
     * Шаблонные данные по курсам валют
     * @return array
     */
    //private static function templateCourses()
    private function templateCourses()
    {
        $courses = [];
        try {
            $filename = self::$base_path . '/currency/cur_template.txt';
            $courses = json_decode((file_get_contents($filename)),true); // чтение сделанного в агенте опорного файла валют
            if ($courses == false) {
                throw new Exception('Файл ' . $filename . ' с данными по отображаемым банком курсам валют отсутствует');
            }
        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());
        }

        return $courses;
    }

    /**
     * Логирование ошибок, предупреждений, действий
     *
     * @param string $type Тип лог-данных
     * @param string $message Сообщение для записи в логи
     */
    private function logger($type, $message)
    {
        $log_path = '/local/components/webtu/synch.currency'; // error logs files path
        file_put_contents(
            self::$base_path . $log_path . '/log/' . $type . '.log',
            //$_SERVER['DOCUMENT_ROOT'] . $this->GetPath() . '/log/' . $type . '.log',
            '[' . date('d.m.Y H:i:s') . ']' . $message . PHP_EOL,
            FILE_APPEND
        );
    }

    /*private function test_logger($type, $message)
    {
        $log_path = '/local/components/webtu/synch.currency';
        file_put_contents(
            self::$base_path . $log_path . '/log/' . $type . '.log',
            '[' . date('d.m.Y H:i:s') . ']' . $message . PHP_EOL,
            FILE_APPEND
        );
    }*/


}


function updateKursTSB(){
    //$path_parts = pathinfo($_SERVER['cron_currency_script.php']);
    //chdir($path_parts['dirname']);

    $kurs = new ScriptSynchCurrency();
    $kurs->updateTest();

    $kurs->updateCourses();

    sleep(15);
    $kurs->updateCourses();

    sleep(15);
    $kurs->updateCourses();

    sleep(15);
    $kurs->updateCourses();

    //return "updateKursTSB();";
}

updateKursTSB();
