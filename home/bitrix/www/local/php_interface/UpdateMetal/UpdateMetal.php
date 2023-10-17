<?php

class UpdateMetal
{
    private static $base_path;
    private static $metal_csv_path;
    private static $bankmet_json_path;
    private static $metal_json_path;

    function __construct()
    {
        self::$base_path = "/home/bitrix/www";
        self::$metal_csv_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/met.csv';
        //self::$metal_csv_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/metalls.csv';
        //self::$bankmet_json_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/met.json'; // входной файл данных
        //self::$bankmet_json_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/full.json'; // входной файл данных
        self::$bankmet_json_path = self::$base_path . '/currency/rates.json'; // входной файл данных
        self::$metal_json_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/metal.json';
    }

    /**
     * Обновляем курсы драг. металлов на сайте
     */
    public function updateMetal()
    {
        try {
            // проверяем существование json-файла и его валидность
            $json = $this->checkJson();

            // проверяем существование csv-файла
            //if (!file_exists(self::$metal_csv_path)) {
            //    throw new Exception('CSV-файл с курсами валют отсутствует');
            //}
            if (!file_exists(self::$bankmet_json_path)) {
                throw new Exception('Входной файл с курсами валют отсутствует');
            }

            // проверяем существование json-файла
            if (!file_exists(self::$bankmet_json_path)) {
                throw new Exception('входной JSON-файл с курсами валют отсутствует');
            }

            // если время последнего обновления курсов драг. металлов < времени обновления файла с актуальными курсами, то обновляем курсы в json
            if ((int)$json['time'] < (int)filectime(self::$bankmet_json_path)) { // реагируем на время изменения входного json-файла
            //if ((int)$json['time'] < (int)filectime(self::$metal_csv_path)) {
                $metal_courses = $this->parseMetalCsv();

                if (!empty($metal_courses)) {
                    $json = $this->updateMetalCsv($metal_courses, $json);
                    $update = true;
                }
            }
            // если обновлились данные по курсам, то записываем всё в json-файл
            if (!empty($update)) {
                file_put_contents(self::$metal_json_path, json_encode($json));

                // если запись в json-файл не произошла, заносим в логи ошибку
                if (filectime(self::$metal_json_path) < time() - 120) {
                    $this->logger('error', 'При обновлении json-файла возникла ошибка');
                } else {
                    $this->logger('notice', 'Json-файл успешно обновлен');
                }
            }
        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());
        }
    }

    /**
     * Проверка json-файла с курсами драг. металлов
     *
     * @return array
     */
    private function checkJson()
    {
        try {
            if (!file_exists(self::$metal_json_path)) {
                throw new Exception('Файл json отстутствует. Будет создан новый файл.');
            }

            $json = json_decode(file_get_contents(self::$metal_json_path), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Невалидный json. Данные будут полностью заменены новыми.');
            }
        } catch (Exception $e) {
            $json = array(
                'time' => time() - 365 * 24 * 60 * 60,
                'data' => []
            );

            $this->logger('warning', $e->getMessage());
        }

        return $json;
    }

    /**
     * Обновляем курсы драг. металов из csv-файла
     *
     * @param array $courses Массив с актуальными курсами драг. металлов
     * @param array $json Массив последних обновленных данных по курсам драг. металлов
     *
     * @return array Обновленный массив данных по курсам драг. металлам
     */
    private function updateMetalCsv(array $courses, array $json)
    {
        $metal_out = [];

        foreach ($courses as $key => $course) {
            $metal_out[$key] = $course;

            if (empty($json['data'][$key])) {
                continue;
            }

            $metal_out[$key] = $this->updateMetalDifference($course, $json['data'][$key]);
        }

        $json['time'] = time();
        $json['data'] = $metal_out;

        return $json;
    }


    /**
     * Обновляем разницу с предыдущим значением курса драг. металла
     *
     * @param array $course Актуальный курс драг. металла
     * @param array $json Массив последних обновленных данных по курсам драг. металлов
     *
     * @return array Возвращает массив с обновленными разницами курсов драг. металлов
     */
    private function updateMetalDifference(array $course, array $json)
    {
        foreach ($course['currency'] as $key => $currency) {
            if (!empty($json['currency'][$key])) {
                $difference_buy = $currency['buy'] - $json['currency'][$key]['buy'];
                $difference_sell = $currency['sell'] - $json['currency'][$key]['sell'];

                $course['currency'][$key]['difference_buy'] = $difference_buy != 0
                    ? round($difference_buy, 2)
                    : $json['currency'][$key]['difference_buy'];

                $course['currency'][$key]['difference_sell'] = $difference_sell != 0
                    ? round($difference_sell, 2)
                    : $json['currency'][$key]['difference_sell'];
            }
        }

        return $course;
    }

    /**
     * Парсим CSV-файл с курсами драг. металлов
     *
     * @return array
     */
    private function parseMetalCsv()
    {
        try {
            /*$fd = @fopen(self::$metal_csv_path, "r");

            if (!$fd) {
                throw new Exception('CSV-файл с курсами драг. металлов не доступен.');
            }

            $result = [];

            while (($data = fgetcsv($fd, 1000, ";")) !== false) {
                $num = count($data);
                //if ($num == 6) {
                    for ($c = 0; $c < $num; $c++) {
                        $result[$data['0']]['code'] = $data['0'];
                        $result[$data['0']]['name'] = $data['1'];
                        $result[$data['0']]['date'] = $data['2'];
                        $result[$data['0']]['currency'][$data['3']]['buy'] = $data['4'];
                        $result[$data['0']]['currency'][$data['3']]['sell'] = $data['5'];
                        $result[$data['0']]['currency'][$data['3']]['difference_buy'] = 0;
                        $result[$data['0']]['currency'][$data['3']]['difference_sell'] = 0;
                    }
                //}
            }
            @fclose($fd);*/
            //file_put_contents(self::$base_path . '/currency/a_metal_result.json', json_encode($result));

            $curtab = [];
            $table = [];
            $ar_dates = [];
            $ar_times = [];
            //$dataID = 10900;
            $dataID = 10901;
            if (file_exists(self::$bankmet_json_path)) {
                $fjdArr = json_decode(file_get_contents(self::$bankmet_json_path), true);
                /*foreach ($fjdArr['rates'] as $ii=>$arItem) {
                    $aux = [];
                    $aux['buy'] = $arItem['mcurs_b'];
                    $aux['difference_buy'] = 0;
                    $aux['sell'] = $arItem['mcurs_s'];
                    $aux['difference_sell'] = 0;

                    $curtab[$arItem['id_cash']]['code'] = $arItem['id_cash'];
                    $curtab[$arItem['id_cash']]['name'] = $arItem['id_decree'];  // номер распоряжения
                    $curtab[$arItem['id_cash']]['date'] = $arItem['date_decree'];
                    $curtab[$arItem['id_cash']]['time'] = $arItem['unix_date'];
                    $curtab[$arItem['id_cash']]['currency'][$arItem['iso']] = $aux;
                    unset($aux);
                }*/
                foreach ($fjdArr['rates'] as $ii=>$arItem) {
                    if ($arItem['id_cash'] == $dataID) {
                        if ($arItem['iso']=='XAG' || $arItem['iso']=='XAU' || $arItem['iso']=='XPD' || $arItem['iso']=='XPT') {
                            $aux = [];
                            $aux['buy'] = $arItem['mcurs_b'];
                            $aux['difference_buy'] = 0;
                            $aux['sell'] = $arItem['mcurs_s'];
                            $aux['difference_sell'] = 0;

                            $curtab[$arItem['id_cash']]['code'] = $arItem['id_cash'];
                            $curtab[$arItem['id_cash']]['name'] = $arItem['id_decree'];  // номер распоряжения
                            $curtab[$arItem['id_cash']]['date'] = $arItem['date_decree'];
                            $curtab[$arItem['id_cash']]['time'] = $arItem['unix_date'];
                            $curtab[$arItem['id_cash']]['currency'][$arItem['iso']] = $aux;
                            unset($aux);
                        }
                    }
                }
                //file_put_contents(self::$base_path . '/currency/a_metal_curtab.json', json_encode($curtab));

            } else {
                throw new Exception('входной JSON-файл с курсами драг. металлов не доступен.');
            }
            unset($table);
            //file_put_contents(self::$base_path . '/currency/a_metal_curtab.json', json_encode($curtab));

            return $curtab;

            //return $result;
        } catch (Exception $e) {
            $this->logger('error', $e->getMessage());

            return [];
        }
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
            $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/UpdateMetal/log/' . $type . '.log',
            '[' . date('d.m.Y H:i:s') . ']' . $message . PHP_EOL,
            FILE_APPEND
        );
    }
}