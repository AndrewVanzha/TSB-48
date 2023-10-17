<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;

define('LOG_FILENAME', $_SERVER['DOCUMENT_ROOT'].'/currency/log.txt'); // лог для проверки работы агента

class SynchCurrency extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend  = array();

    private static $json_path;
    private static $csv_path;
    private static $rates_path;
    private static $rates_json_path;
    private static $xml_path;
    private static $html_path;
    private static $day_path;

    private static $courses_list;

    //public function __construct($component)
    public function __construct()
    {
        //parent::__construct($component);
        parent::__construct();

        self::$json_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/currency.json';
        self::$csv_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/cur.csv';
        self::$rates_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/rates.csv';
        self::$rates_json_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/rates.json'; // входной файл данных
        self::$html_path = $_SERVER['DOCUMENT_ROOT'] . '/currency_rates_table.html';
        self::$xml_path = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=';
        self::$day_path = $_SERVER['DOCUMENT_ROOT'] . '/currency/day.json';

// опорный массив валют, задается в качестве исходного для порядка следования валют (вместо массива из templateCourses)
        self::$courses_list = array(
            'USD' => [
                'name' => 'Доллар США',
                'symbol' => '$',
                'count' => 1,
                'iso_n' => '840',
                'iso_s' => 'USD' ,
            ],
            'EUR' => [
                'name' => 'Евро',
                'symbol' => '€',
                'count' => 1,
                'iso_n' => '978',
                'iso_s' => 'EUR' ,
            ],
            'GBP' => [
                'name' => 'Фунт стерлингов Соединенного королевства',
                'symbol' => '£',
                'count' => 1,
                'iso_n' => '826',
                'iso_s' => 'GBP' ,
            ],
            'CHF' => [
                'name' => 'Швейцарский франк',
                'symbol' => '₣',
                'count' => 1,
                'iso_n' => '756',
                'iso_s' => 'CHF' ,
            ],
            'JPY' => [
                'name' => 'Японская иена',
                'symbol' => '¥',
                'count' => 100,
                'iso_n' => '392',
                'iso_s' => 'JPY' ,
            ],
            'CNY' => [
                'name' => 'Китайский юань',
                'symbol' => '¥',
                'count' => 1,
                'iso_n' => '156',
                'iso_s' => 'CNY' ,
            ],
            'PLN' => [
                'name' => 'Польский злотый',
                'symbol' => 'zł',
                'count' => 1,
                'iso_n' => '985',
                'iso_s' => 'PLN' ,
            ],
            'AED' => [
                'name' => 'Дирхам ОАЭ',  // добавка с 20.12.21
                'symbol' => 'DH',
                'count' => 1,
                'iso_n' => '784',
                'iso_s' => 'AED' ,
            ],
            'AMD' => [
                'name' => 'Армянский драм',  // добавка с 10.12.21
                'symbol' => '֏',
                'count' => 100,
                'iso_n' => '051',
                'iso_s' => 'AMD' ,
            ],

            'AUD' => [
                'name' => 'Австралийский доллар',  // добавка с 5.12.21
                'symbol' => '$',
                'count' => 1,
                'iso_n' => '036',
                'iso_s' => 'AUD' ,
            ],
            'AZN' => [
                'name' => 'Азербайджанский манат',  // добавка с 5.12.21
                'symbol' => '₼',
                'count' => 1,
                'iso_n' => '944',
                'iso_s' => 'AZN' ,
            ],
            'BGN' => [
                'name' => 'Болгарский лев',  // добавка с 5.12.21
                'symbol' => 'лв',
                'count' => 1,
                'iso_n' => '975',
                'iso_s' => 'BGN' ,
            ],
            'BHD' => [
                'name' => 'Бахрейнский динар',  // добавка с 5.08.22
                'symbol' => 'BD',
                'count' => 1,
                'iso_n' => '048',
                'iso_s' => 'BHD' ,
            ],
            'BRL' => [
                'name' => 'Бразильский реал',  // добавка с 8.09.22
                'symbol' => 'R$',
                'count' => 1,
                'iso_n' => '986',
                'iso_s' => 'BRL' ,
            ],
            'BYN' => [
                'name' => 'Белорусский рубль',
                'symbol' => 'Br',
                'count' => 1,
                'iso_n' => '933',
                'iso_s' => 'BYN' ,
            ],
            'CAD' => [
                'name' => 'Канадский доллар',  // добавка с 5.12.21
                'symbol' => 'C$',
                'count' => 1,
                'iso_n' => '124',
                'iso_s' => 'CAD' ,
            ],
            'CZK' => [
                'name' => 'Чешская крона',  // добавка с 5.12.21
                'symbol' => 'Kč',
                'count' => 10,
                'iso_n' => '203',
                'iso_s' => 'CZK' ,
            ],
            'DKK' => [
                'name' => 'Датская крона',  // добавка с 11.1.22
                'symbol' => 'kr',
                'count' => 1,
                'iso_n' => '208',
                'iso_s' => 'DKK' ,
            ],
            'EGP' => [
                'name' => 'Египетский фунт',  // добавка с 22.12.21
                'symbol' => 'ДУ',
                'count' => 10,
                'iso_n' => '818',
                'iso_s' => 'EGP' ,
            ],
            'GEL' => [
                'name' => 'Грузинский лари',  // добавка с 22.2.22
                'symbol' => '₾',
                'count' => 10,
                'iso_n' => '981',
                'iso_s' => 'GEL' ,
            ],
            'HKD' => [
                'name' => 'Гонконгский доллар',  // добавка с 14.12.21
                'symbol' => 'HK$',
                'count' => 10,
                'iso_n' => '344',
                'iso_s' => 'HKD' ,
            ],
            'HUF' => [
                'name' => 'Венгерский форинт',  // добавка с 5.12.21
                'symbol' => 'F',
                'count' => 100,
                'iso_n' => '348',
                'iso_s' => 'HUF' ,
            ],
            'IDR' => [
                'name' => 'Индонезийская рупия',  // добавка с 19.5.22
                'symbol' => 'Rp',
                'count' => 10000,
                'iso_n' => '360',
                'iso_s' => 'IDR' ,
            ],
            'ILS' => [
                'name' => 'Новый израильский шекель',  // добавка с 16.12.21
                'symbol' => 'ש',
                'count' => 1,
                'iso_n' => '376',
                'iso_s' => 'ILS' ,
            ],
            'INR' => [
                'name' => 'Индийская рупия',  // добавка с 5.12.21
                'symbol' => 'Rs',
                'count' => 100,
                'iso_n' => '356',
                'iso_s' => 'INR' ,
            ],
            'KGS' => [
                'name' => 'Киргизский сом',  // добавка с 5.12.21
                'symbol' => 'с',
                'count' => 100,
                'iso_n' => '417',
                'iso_s' => 'KGS' ,
            ],
            'KRW' => [
                'name' => 'Южнокорейская вона',  // добавка с 10.1.22
                'symbol' => '₩',
                'count' => 1000,
                'iso_n' => '410',
                'iso_s' => 'KRW' ,
            ],
            'KZT' => [
                'name' => 'Казахстанский тенге',  // добавка с 5.12.21
                'symbol' => '₸',
                'count' => 100,
                'iso_n' => '398',
                'iso_s' => 'KZT' ,
            ],
            'KWD' => [
                'name' => 'Кувейтский динар',  // добавка с 28.02.23
                'symbol' => 'KD',
                'count' => 10,
                'iso_n' => '414',
                'iso_s' => 'KWD' ,
            ],
            'LKR' => [
                'name' => 'Шри-Ланкийская рупия',  // добавка с 26.05.23
                'symbol' => 'Rs',
                'count' => 100,
                'iso_n' => '144',
                'iso_s' => 'LKR' ,
            ],
            'MAD' => [
                'name' => 'Марокканский дирхам',  // добавка с 2.6.22
                'symbol' => 'DH',
                'count' => 1,
                'iso_n' => '504',
                'iso_s' => 'MAD' ,
            ],
            'MDL' => [
                'name' => 'Молдавский лей',  // добавка с 14.12.21
                'symbol' => 'L',
                'count' => 10,
                'iso_n' => '498',
                'iso_s' => 'MDL' ,
            ],
            'MXN' => [
                'name' => 'Мексиканское песо',  // добавка с 14.1.22
                'symbol' => '$',
                'count' => 10,
                'iso_n' => '484',
                'iso_s' => 'MXN' ,
            ],
            'MUR' => [
                'name' => 'Маврикийская рупия',  // добавка с 11.10.23
                'symbol' => 'Rs',
                'count' => 10,
                'iso_n' => '480',
                'iso_s' => 'MUR' ,
            ],
            'MVR' => [
                'name' => 'Мальдивская руфия',  // добавка с 26.05.23
                'symbol' => 'L',
                'count' => 10,
                'iso_n' => '462',
                'iso_s' => 'MVR' ,
            ],
            'MYR' => [
                'name' => 'Малайзийский ринггит',  // добавка с 16.4.22
                'symbol' => 'RM',
                'count' => 1,
                'iso_n' => '458',
                'iso_s' => 'MYR' ,
            ],
            'NOK' => [
                'name' => 'Норвежская крона',  // добавка с 16.4.22
                'symbol' => 'kr',
                'count' => 10,
                'iso_n' => '578',
                'iso_s' => 'NOK' ,
            ],
            'NZD' => [
                'name' => 'Новозеландский доллар',  // добавка с 26.05.23
                'symbol' => '$',
                'count' => 1,
                'iso_n' => '554',
                'iso_s' => 'NZD' ,
            ],
            'OMR' => [
                'name' => 'Оманский реал',  // добавка с 26.05.23
                'symbol' => 'RO',
                'count' => 1,
                'iso_n' => '512',
                'iso_s' => 'OMR' ,
            ],
            'PHP' => [
                'name' => 'Филиппинское песо',  // добавка с 28.08.23
                'symbol' => '₱',
                'count' => 10,
                'iso_n' => '608',
                'iso_s' => 'PHP' ,
            ],
            'QAR' => [
                'name' => 'Катарский риал',  // добавка с 13.1.22
                'symbol' => 'QR',
                'count' => 1,
                'iso_n' => '634',
                'iso_s' => 'QAR' ,
            ],
            'RON' => [
                'name' => 'Румынский лей',  // добавка с 31.01.23
                'symbol' => 'L',
                'count' => 1,
                'iso_n' => '946',
                'iso_s' => 'RON' ,
            ],
            'RSD' => [
                'name' => 'Сербский динар',  // добавка с 20.12.21
                'symbol' => 'din',
                'count' => 100,
                'iso_n' => '941',
                'iso_s' => 'RSD' ,
            ],
            'SAR' => [
                'name' => 'Саудовский риял',  // добавка с 28.12.21
                'symbol' => 'SR',
                'count' => 1,
                'iso_n' => '682',
                'iso_s' => 'SAR' ,
            ],
            'SEK' => [
                'name' => 'Шведская крона',  // добавка с 16.4.22
                'symbol' => 'kr',
                'count' => 10,
                'iso_n' => '752',
                'iso_s' => 'SEK' ,
            ],
            'SGD' => [
                'name' => 'Сингапурский доллар',  // добавка с 5.12.21
                'symbol' => '$',
                'count' => 1,
                'iso_n' => '702',
                'iso_s' => 'SGD' ,
            ],
            'THB' => [
                'name' => 'Тайский бат',  // добавка с 20.12.21
                'symbol' => '฿',
                'count' => 10,
                'iso_n' => '764',
                'iso_s' => 'THB' ,
            ],
            'TJS' => [
                'name' => 'Таджикский сомони',  // добавка с 10.12.21
                'symbol' => 'c',
                'count' => 10,
                'iso_n' => '972',
                'iso_s' => 'TJS' ,
            ],
            'TRY' => [
                'name' => 'Турецкая лира',
                'symbol' => '₺',
                'count' => 10,
                'iso_n' => '949',
                'iso_s' => 'TRY' ,
            ],
            'UZS' => [
                'name' => 'Узбекский сум',  // добавка с 31.1.22
                'symbol' => "So'm",
                'count' => 10000,
                'iso_n' => '860',
                'iso_s' => 'UZS' ,
            ],
            'VND' => [
                'name' => 'Вьетнамский донг',  // добавка с 16.4.22
                'symbol' => '₫',
                'count' => 10000,
                'iso_n' => '704',
                'iso_s' => 'VND' ,
            ],
            'ZAR' => [
                'name' => 'Южноафриканский рэнд',  // добавка с 5.12.21
                'symbol' => 'R',
                'count' => 10,
                'iso_n' => '710',
                'iso_s' => 'ZAR' ,
            ],
        );
    }

    public static function getCoursesList() {
        if (file_exists(self::$json_path)) {
            $json = json_decode(file_get_contents(self::$json_path), true);
            foreach (self::$courses_list as $base_cur=>$currency) { // подставляю множитель валюты из currency.json
                foreach ($json['tsb']['data'] as $office) {
                    foreach ($office['currency'] as $json_cur=>$values) {
                        if ($base_cur == $json_cur) {
                            self::$courses_list[$base_cur]['count'] = $values[0]['multi'];
                            //self::$courses_list[$base_cur]['count'] = 222;
                            break;
                        }
                    }
                }
            }
        }
        return self::$courses_list;
    }

    public function updateTest()
	{
		//AddMessage2Log(date('d-m-Y H:i:s'));
        $json = $this->checkJson();
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/test_currency.json', json_encode($json));
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
            "CACHE_TIME" => $params['CACHE_TIME'],
            "OFFICE_IBLOCK_ID" => $params['OFFICE_IBLOCK_ID'],
            "CBR_IBLOCK_ID" => $params['CBR_IBLOCK_ID'],
        );
    }

    /**
     * Проверяет подключение необходиимых модулей
     */
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')) {
            throw new Main\LoaderException('Ошибка модуля iblock');
        }
    }

    /**
     * Вывод сообщения об ошибке
     */
    protected function actionMessage()
    {
        $this->arResult["MESSAGE_ERROR"] = $this->MessageError;
        $this->arResult["MESSAGE_SEND"] = $this->MessageSend;
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

            if (!empty($json['tsb']['time'])) {
                $this->arResult['MODIFY_DATE_FILE'] = $json['tsb']['time'];
            }

            try {
                $tsb = $this->getCourseTSB($json);
            } catch (Exception $e) {
                $tsb = array();
                $this->logger('error', $e->getMessage());
            }

            try {
                $cbr = $this->getCourseCBR($json);
            } catch (Exception $e) {
                $cbr = array();
                $this->logger('error', $e->getMessage());
            }

            // проверяем существование day.json
            if (!file_exists(self::$day_path)) {
                $day_json = $json;
                throw new Exception('файл day.json с курсами валют отсутствует, данные берем из текущего json');
            } else {
                $day_json = json_decode(file_get_contents(self::$day_path), true);
                $day_tsb = $this->getCourseTSB($day_json);
                $day_cbr = $this->getCourseCBR($day_json);
                //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/test_day_tsb.json', json_encode($day_tsb));
            }

            //foreach (self::templateCourses() as $key => $course) {
            foreach (self::getCoursesList() as $key => $course) {
                if (!empty($tsb[$key]['buy'])) {
                    if (!empty($cbr[$key]) && !empty($cbr[$key]['course']) && !empty($cbr[$key]['status'])) {
                        $cbr_course = $cbr[$key]['course'];
                        $cbr_status = $cbr[$key]['status'];
                    } else {
                        $cbr_course = '';
                        $cbr_status = '';
                    }

                    if(isset($tsb[$key]['multi'])) $multi_coeff = $tsb[$key]['multi']; // ***
                    else $multi_coeff = ''; // ***
                    $this->arResult['CUR'][$key] = array(
                        $course['iso_s'] . ' ' . $course['symbol'],
                        $tsb[$key]['buy'] . '/' . $tsb[$key]['status'],
                        $tsb[$key]['sell'] . '/' . $tsb[$key]['status'],
                        $cbr_course . '/' . $cbr_status,
                        $course['name'],
                        $course['iso_s'],
                        $course['symbol'],
                        $multi_coeff,
                    );

                    $this->arResult['CUR'][$key] = array( // для старого конвертора валют
                        $course['iso_s'] . ' ' . $course['symbol'],
                        $tsb[$key]['buy'] . '/' . $tsb[$key]['status'],
                        $tsb[$key]['sell'] . '/' . $tsb[$key]['status'],
                        $cbr_course . '/' . $cbr_status
                    );
                }
            }
            $this->arResult['MAIN_TABLE'] = $this->makeCurrencyTableArray($this->arResult['CUR'], $day_tsb, $day_cbr);
            return $this->arResult['MAIN_TABLE'];
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
            //$this->updateCourses();
            $this->getResult();
            $this->actionMessage();

            $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    /**
     * Делаем таблицу с курсами валют для сайта
     */
    public function makeCurrencyTableArray($arCurrency, $day_tsb, $day_cbr)
    {
        function compare_currency_words($a, $b) {
            return strnatcmp($a["name"], $b["name"]);
        }

        \Bitrix\Main\Loader::IncludeModule('highloadblock');

        $ID = 6; // CurrencyOutCbrf
        $hlData = \Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
        $hlEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlData)->getDataClass();

        $arCurrencyOutCbrf = [];
        $result = $hlEntity::getList([
            'select' => ["*"],
            'filter' => [],
            "order" => array(),
            //"order" => array("UF_SORT" => "ASC"),
        ]);
        while ($res = $result->fetch()) {
            $arCurrencyOutCbrf[] = $res;
        }


        $ID = 7; // CurrencyMultiplicity
        $hlData = \Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
        $hlEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlData)->getDataClass();

        $arCurrencyMultiplicity = [];
        $result = $hlEntity::getList([
            'select' => ["*"],
            'filter' => [],
            "order" => array(),
        ]);
        while ($res = $result->fetch()) {
            $arCurrencyMultiplicity[] = $res;
        }

        $arShowTable = [];
        $arShowLine = [];
        $ii = 1;
        foreach ($arCurrency as $key=>$arCur) {
            if ($arCur[1] !== '/') {
                $arShowLine['name'] = $arCur[4];
                $symbol = $arCur[5];
                $arShowLine['symbol'] = $symbol;

                $arElement = explode("/", $arCur[1]);
                $arShowLine['buy'] = $arElement[0];
                $arShowLine['buy_move0'] = $arElement[1];
                if($arShowLine['buy'] > $day_tsb[$symbol]['buy']) $arShowLine['buy_move'] = '>';
                if($arShowLine['buy'] < $day_tsb[$symbol]['buy']) $arShowLine['buy_move'] = '<';
                if($arShowLine['buy'] == $day_tsb[$symbol]['buy']) $arShowLine['buy_move'] = '=';

                $arElement = explode("/", $arCur[2]);
                $arShowLine['sell'] = $arElement[0];
                $arShowLine['sell_move0'] = $arElement[1];
                if($arShowLine['sell'] > $day_tsb[$symbol]['sell']) $arShowLine['sell_move'] = '>';
                if($arShowLine['sell'] < $day_tsb[$symbol]['sell']) $arShowLine['sell_move'] = '<';
                if($arShowLine['sell'] == $day_tsb[$symbol]['sell']) $arShowLine['sell_move'] = '=';

                $arElement = explode("/", $arCur[3]);
                $arShowLine['cb'] = $arElement[0];
                $arShowLine['cb_move0'] = $arElement[1];
                if(!empty($arElement[0])) {
                    if($arShowLine['cb'] > $day_cbr[$symbol]['course']) $arShowLine['cb_move'] = '>';
                    if($arShowLine['cb'] < $day_cbr[$symbol]['course']) $arShowLine['cb_move'] = '<';
                    if($arShowLine['cb'] == $day_cbr[$symbol]['course']) $arShowLine['cb_move'] = '=';
                } else {
                    $arShowLine['cb_move'] = '';
                }

                $arShowLine['note'] = '';
                $arShowLine['mark'] = '';
                if(empty($arCur[7])) {
                    $arShowLine['multi'] = '';
                    $ask_highload_multi_flag = true; // беру multi из соотв. highloadblock
                }
                else {
                    $arShowLine['multi'] = $arCur[7]; // multi из входного cur.csv
                    $ask_highload_multi_flag = false;
                }
            }
            $arShowTable[$key] = $arShowLine;
        }
        usort($arShowTable, "compare_currency_words");

        $ii = 1;
        foreach ($arShowTable as $key=>$arCur) {
            $symbol = $arCur['symbol'];
            foreach ($arCurrencyOutCbrf as $item) {
                if($symbol == $item['UF_CURRENCY_OUT_CB']) {
                    //$arShowTable[$key]['note'] = "<sup>" . $ii . "</sup>";
                    $arShowTable[$key]['note'] = "<sup>" . "i" . "</sup>";
                    $ii += 1;
                    $arShowTable[$key]['mark'] = 'cb';
                }
            }

            foreach ($arCurrencyMultiplicity as $item) {
                if($symbol == $item['UF_CURR_WITH_MULT']) {
                    if($arShowTable[$key]['mark'] === 'cb') {
                        $arShowTable[$key]['mark'] = 'both';
                    } else {
                        $arShowTable[$key]['mark'] = 'multi';
                        //$arShowTable[$key]['note'] = "<sup>" . $ii . "</sup>";
                        $arShowTable[$key]['note'] = "<sup>" . "i" . "</sup>";
                        $ii += 1;
                    }
                    if($ask_highload_multi_flag) {
                        $arShowTable[$key]['multi'] = $item['UF_MULT_COEFF'];
                    }
                    if (isset($item['UF_CURR_TEXT_MULT'])) {
                        $arShowTable[$key]['genetive'] = $item['UF_CURR_TEXT_MULT'];
                    } else {
                        $arShowTable[$key]['genetive'] = ' единиц валюты';
                    }
                }
            }
        }
        return $arShowTable;
    }

    /**
     * Обновляем курсы валют на сайте
     */
    public function updateCourses()
    {
        try {
            // проверяем существование json-файла и его валидность
            $json = $this->checkJson();
            $day_json = $this->checkDayJson();

            // проверяем существование csv-файла
            if (!file_exists(self::$csv_path)) {
            //if (!file_exists(self::$rates_path)) {
                throw new Exception('входной CSV-файл с курсами валют отсутствует');
            }

            // проверяем существование json-файла
            if (!file_exists(self::$rates_json_path)) {
                throw new Exception('входной JSON-файл с курсами валют отсутствует');
            }
            $this->loadCurrencyTemplate();

            // если время последнего обновления курсов ТСБ < времени обновления файла с актуальными курсами, то обновляем курсы в json
            //if ($json['tsb']['time'] < filectime(self::$csv_path)) { //- делает по cron
            //if ($json['tsb']['time'] < filectime(self::$rates_path)) { //- делает по cron
            if ($json['tsb']['time'] < filectime(self::$rates_json_path)) { //- делает по cron
                $tsb_courses = $this->parseCoursesTSB();
				//file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/a_tsb_courses_agent.json', json_encode($tsb_courses));

                if (!empty($tsb_courses)) {
                    $json = $this->updateCoursesTSB($tsb_courses, $day_json);
                    $update = true;
                }
            }

            // если курсы валют ЦБ сегодня ещё не обновлялись, то обновляем - делает по cron
            if ($json['cbr']['time'] < mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
                $cbr_courses = $this->parseCoursesCBR(); //- делает по cron

                //$this->loadCurrencyTemplate();

                if (!empty($cbr_courses)) {
                    $json = $this->updateCoursesCBR($cbr_courses, $json);
                    $update = true;

                    $this->addCourseForDynamic($json['cbr']['data']);
                }
            }

            // обновляем html-файл для банки.ру
            $this->createHtml($json);
            $this->add_history_rate($json);

            // если обновлились данные по курсам ТСБ или ЦБ, то записываем всё в json-файл - делает по cron
            if (!empty($update)) {
                //file_put_contents(self::$json_path, json_encode($json));

                // если запись в json-файл не произошла, заносим в логи ошибку
                if (filectime(self::$json_path) < time() - 120) {                // - делает по cron
                    //$this->logger('error', 'При обновлении json-файла возникла ошибка');
                    //$this->logger('error', 'При обновлении html-файла для банки.ру возникла ошибка');
                } else {
                    //$this->logger('notice', 'Json-файл успешно обновлен');
                    //$this->logger('notice', 'html-файл для банки.ру успешно обновлен');

                    // обновляем html-файл для банки.ру
                    //$this->createHtml($json);
                    //$this->add_history_rate($json);
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
        foreach ($course['currency'] as $key => $currency) { // ***
            if (!empty($json['currency'][$key])) {
                if ($json['currency'][$key][0]['buy'] === $currency[0]['buy']) {
                    $course['currency'][$key][0]['buy_move'] = '=';
                } elseif ($json['currency'][$key][0]['buy'] > $currency[0]['buy']) {
                    $course['currency'][$key][0]['buy_move'] = '<';
                } else {
                    $course['currency'][$key][0]['buy_move'] = '>';
                }
                if (isset($json['currency'][$key][1]) && isset($currency[1])) {
                    if ($json['currency'][$key][1]['buy'] === $currency[1]['buy']) {
                        $course['currency'][$key][1]['buy_move'] = '=';
                    } elseif ($json['currency'][$key][1]['buy'] > $currency[1]['buy']) {
                        $course['currency'][$key][1]['buy_move'] = '<';
                    } else {
                        $course['currency'][$key][1]['buy_move'] = '>';
                    }
                }

                if ($json['currency'][$key][0]['sell'] === $currency[0]['sell']) {
                    $course['currency'][$key][0]['sell_move'] = '=';
                } elseif ($json['currency'][$key][0]['sell'] > $currency[0]['sell']) {
                    $course['currency'][$key][0]['sell_move'] = '<';
                } else {
                    $course['currency'][$key][0]['sell_move'] = '>';
                }
                if (isset($json['currency'][$key][1]) && isset($currency[1])) {
                    if ($json['currency'][$key][1]['sell'] === $currency[1]['sell']) {
                        $course['currency'][$key][1]['sell_move'] = '=';
                    } elseif ($json['currency'][$key][1]['sell'] > $currency[1]['sell']) {
                        $course['currency'][$key][1]['sell_move'] = '<';
                    } else {
                        $course['currency'][$key][1]['sell_move'] = '>';
                    }
                }

            }
        }

        /*foreach ($course['currency'] as $key => $currency) { // вариант для конвертора ***
            if (!empty($json['currency'][$key])) {
                if ($json['currency'][$key]['buy'] === $currency['buy'] && $json['currency'][$key]['sell'] === $currency['sell']) {
                    $course['currency'][$key]['status'] = $json['currency'][$key]['status'];
                } elseif ($json['currency'][$key]['buy'] > $currency['buy']) {
                    $course['currency'][$key]['status'] = '<';
                } else {
                    $course['currency'][$key]['status'] = '>';
                }
            }
        }*/

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
     * Парсим CSV-файл с курсами валют банка ТСБ
     *
     * @return array
     */
    private function parseCoursesTSB()
    {
        try {
            $fd = @fopen(self::$csv_path, "r"); // cur.csv
            //$fd = @fopen(self::$rates_path, "r"); // rates.csv

            if (!$fd) {
                throw new Exception('CSV-файл с курсами валют не доступен.');
            }

            $result = [];
            $table = [];
            $ii = 0;

            while (($data = fgetcsv($fd, 1000, ";")) !== false) {
                $num = count($data);
                //if ($num == 6) {
                    for ($c = 0; $c < $num; $c++) {
                        //$table[$ii][$c] = $data[$c]; // ***

                        /*$result[$data['0']]['code'] = $data['0']; // ***
                        $result[$data['0']]['name'] = $data['1'];
                        $result[$data['0']]['date'] = $data['2'];
                        $result[$data['0']]['currency'][$data['3']]['buy'] = $data['4'];
                        $result[$data['0']]['currency'][$data['3']]['sell'] = $data['5'];
                        $result[$data['0']]['currency'][$data['3']]['status'] = '>';
                        if($num > 6) {
                            $result[$data['0']]['currency'][$data['3']]['multi'] = $data['6'];
                            $result[$data['0']]['currency'][$data['3']]['volume'] = $data['7'];
                        }*/
                    }
                //}
                $ii += 1;
            }
            for ($ii=0; $ii<count($table); $ii++) { // ***
                $result[$table[$ii][0]]['code'] = $table[$ii][0];
                $result[$table[$ii][0]]['name'] = $table[$ii][1];
                $result[$table[$ii][0]]['date'] = $table[$ii][2];
                if ($ii == 0) {
                    $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['buy'] = $table[$ii][4];
                    $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['sell'] = $table[$ii][5];
                    $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['buy_move'] = '>';
                    $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['sell_move'] = '<';
                    if($num > 6) {
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['multi'] = $table[$ii][6];
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['volume'] = $table[$ii][7];
                    }
                } else {
                    if ($table[$ii][3] == $table[$ii-1][3] && $table[$ii][0] == $table[$ii-1][0]) {  // курсы для другого количества валюты
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][1]['buy'] = $table[$ii][4];
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][1]['sell'] = $table[$ii][5];
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['buy_move'] = '>';
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['sell_move'] = '<';
                        if($num > 6) {
                            $result[$table[$ii][0]]['currency'][$table[$ii][3]][1]['multi'] = $table[$ii][6];
                            $result[$table[$ii][0]]['currency'][$table[$ii][3]][1]['volume'] = $table[$ii][7];
                        }
                    } else {
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['buy'] = $table[$ii][4];
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['sell'] = $table[$ii][5];
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['buy_move'] = '>';
                        $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['sell_move'] = '<';
                        if($num > 6) {
                            $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['multi'] = $table[$ii][6];
                            $result[$table[$ii][0]]['currency'][$table[$ii][3]][0]['volume'] = $table[$ii][7];
                        }
                    }
                }
            }
            @fclose($fd);
            //file_put_contents(self::$base_path . '/currency/a_agent_result.json', json_encode($result));
            unset($table);

            $curtab = [];
            $table = [];
            if (file_exists(self::$rates_json_path)) {
                //file_put_contents(self::$base_path . '/currency/a_ququ_agent.txt', 'ququ');
                //$fjd = file_get_contents(self::$rates_json_path);
                $fjdArr = json_decode(file_get_contents(self::$rates_json_path), true);

                foreach ($fjdArr['rates'] as $ii=>$arItem) {
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
            //file_put_contents(self::$base_path . '/currency/a_agent_curtab.json', json_encode($curtab));
            return $curtab;

            //return $result;
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
                //foreach (self::templateCourses() as $template) {
                foreach (self::getCoursesList() as $template) {
//if ($course[2] == $template['iso_n'] && $template['iso_n'] !== 376 && $template['iso_n'] !== 784 && $template['iso_n'] !== 941 && $template['iso_n'] !== 764 && $template['iso_n'] !== 818 && $template['iso_n'] !== 682 && $template['iso_n'] !== 410) { // кроме ILS, AED, RSD, THB, SAR, KRW
//if ($course[2] == $template['iso_n'] && $template['iso_n'] !== 376 && $template['iso_n'] !== 784 && $template['iso_n'] !== 941 && $template['iso_n'] !== 764 && $template['iso_n'] !== 818 && $template['iso_n'] !== 682) { // кроме ILS, AED, RSD, THB, SAR
//if ($course[2] == $template['iso_n'] && $template['iso_n'] !== 376 && $template['iso_n'] !== 784 && $template['iso_n'] !== 941 && $template['iso_n'] !== 764 && $template['iso_n'] !== 818 && $template['iso_n'] !== 682 && $template['iso_n'] !== 634 && $template['iso_n'] !== 484) { // кроме ILS, AED, RSD, THB, SAR, QAR, MXN
//if ($course[2] == $template['iso_n'] && $template['iso_n'] !== 376 && $template['iso_n'] !== 784 && $template['iso_n'] !== 941 && $template['iso_n'] !== 764 && $template['iso_n'] !== 818 && $template['iso_n'] !== 682 && $template['iso_n'] !== 634 && $template['iso_n'] !== 484 && $template['iso_n'] !== 458 && $template['iso_n'] !== 704) { // кроме ILS, AED, RSD, THB, SAR, QAR, MXN, MYR, VND
//if ($course[2] == $template['iso_n'] && $template['iso_n'] !== 376 && $template['iso_n'] !== 784 && $template['iso_n'] !== 941 && $template['iso_n'] !== 764 && $template['iso_n'] !== 818 && $template['iso_n'] !== 682 && $template['iso_n'] !== 634 && $template['iso_n'] !== 484 && $template['iso_n'] !== 458 && $template['iso_n'] !== 704 && $template['iso_n'] !== 360 && $template['iso_n'] !== 504) { // кроме ILS, AED, RSD, THB, SAR, QAR, MXN, MYR, VND, IDR, MAD
if ($course[2] == $template['iso_n'] && $template['iso_n'] != '376' && $template['iso_n'] != '682' && $template['iso_n'] != '484' && $template['iso_n'] != '458' && $template['iso_n'] != '504' && $template['iso_n'] != '048' && $template['iso_n'] != '144' && $template['iso_n'] != '462' && $template['iso_n'] != '512' && $template['iso_n'] != '480') { // кроме ILS, SAR, MXN, MYR, MAD, BHD, LKR, MVR, OMR, MUR
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

        if (!$fd) {
            throw new Exception('Сервер данных ЦБ РФ не отвечает.');
        }

        $data = '';

        while (!feof($fd)) {
            $data .= @fgets($fd, 4096);
        }

        @fclose($fd);

        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/cur_cbr.xml', $data);

        return $data;
    }

    /**
     * Загрузка курсов валют с ЦБ РФ
     *
     * @return string Данные по курсам валют
     * @throws Exception
     */
    private function loadCurrencyTemplate()
    {
        //$data = self::templateCourses(); // беру из стандартного массива
        $data = self::getCoursesList(); // беру из заданного объекта self::$courses_list

        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/cur_template.txt', json_encode($data));
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
            array('IBLOCK_ID' => 114, 'ACTIVE' => 'Y'),
            false,
            false,
            array('ID', 'NAME', 'PROPERTY_ATT_CODE')
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
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/a_json.json', json_encode($json));

        foreach ($cities as $city) {
            $output .= '<h2>' . $city['NAME'] . '</h2>';
            $output .= '<table>';
            $output .= '<thead>';
            $output .= '<tr><th>код</th><th>единиц</th><th>название валюты</th><th>покупка</th><th>продажа</th></tr>';
            $output .= '</thead>';

            if (!empty($city['PROPERTY_ATT_CODE_VALUE'])) {
                $courses = $this->minimumCourse($city, $json);
                //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/a_$courses.json', json_encode($courses));

                foreach ($courses as $key => $course) {
                    if ($course['buy'] == 0) {
                        continue;
                    }
                    //$template_course = self::templateCourses();
                    $template_course = self::getCoursesList();

					//if (in_array($key, ['BYN', 'TRY', 'ILS'])) {
					//if (in_array($key, ['BYN', 'TRY', 'ILS', 'CAD', 'SAR', 'INR', 'AZN', 'QAR', 'SGD', 'AUD', 'KZT'])) {
					//if (in_array($key, ['BYN', 'TRY', 'ILS', 'CAD', 'SAR', 'INR', 'AZN', 'QAR', 'SGD', 'AUD', 'KZT', 'AED', 'EGP'])) {
					//if (in_array($key, ['KGS', 'ZAR' ,'BYN', 'TRY', 'ILS', 'CAD', 'SAR', 'INR', 'AZN', 'QAR', 'SGD', 'AUD', 'KZT', 'AED', 'EGP'])) {
					//if (in_array($key, ['KGS', 'ZAR' ,'BYN', 'TRY', 'ILS', 'CAD', 'SAR', 'INR', 'AZN', 'QAR', 'SGD', 'AUD', 'KZT', 'AED', 'EGP', 'KRW'])) {
					//if (in_array($key, ['KGS', 'ZAR' ,'BYN', 'TRY', 'ILS', 'CAD', 'SAR', 'INR', 'AZN', 'QAR', 'SGD', 'AUD', 'KZT', 'AED', 'EGP', 'KRW', 'DKK'])) {
					//if (in_array($key, ['KGS', 'ZAR' ,'BYN', 'TRY', 'ILS', 'CAD', 'SAR', 'INR', 'AZN', 'QAR', 'SGD', 'AUD', 'KZT', 'AED', 'EGP', 'KRW', 'DKK', 'QAR', 'MXN', 'MDL', 'CZK', 'THB', 'TJS', 'BGN', 'TJS', 'RSD', 'HKD', 'HUF', 'AMD', 'UZS', 'GEL'])) {
					//if (in_array($key, ['KGS', 'ZAR' ,'BYN', 'TRY', 'ILS', 'CAD', 'SAR', 'INR', 'AZN', 'QAR', 'SGD', 'AUD', 'KZT', 'AED', 'EGP', 'KRW', 'DKK', 'QAR', 'MXN', 'MDL', 'CZK', 'THB', 'TJS', 'BGN', 'TJS', 'RSD', 'HKD', 'HUF', 'AMD', 'UZS', 'GEL', 'NOK', 'SEK', 'MYR', 'VND'])) {
					if (in_array($key, ['KGS', 'ZAR' ,'BYN', 'TRY', 'ILS', 'CAD', 'SAR', 'INR', 'AZN', 'QAR', 'SGD', 'AUD', 'KZT', 'AED', 'EGP', 'KRW', 'DKK', 'QAR', 'MXN', 'MDL', 'CZK', 'THB', 'TJS', 'BGN', 'TJS', 'RSD', 'HKD', 'HUF', 'AMD', 'UZS', 'GEL', 'NOK', 'SEK', 'MYR', 'VND', 'IDR', 'MAD', 'BHD', 'BRL', 'RON', 'KWD', 'MUR'])) {
                        //continue;
					} /* AUD TRY AZN BYN ILS QAR SAR AED EGP INR KZT CAD SGD */ /* KGS ZAR BHD BRL */

                    $output .= '<tr>';
                    $output .= '<td>' . $key . '</td>';
                    //$output .= '<td>' . self::templateCourses()[$key]['count'] . '</td>';
                    $output .= '<td>' . $template_course[$key]['count'] . '</td>';
                    //$output .= '<td>' . self::templateCourses()[$key]['name'] . '</td>';
                    $output .= '<td>' . $template_course[$key]['name'] . '</td>';
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
                //|| ($city['ID'] == 400 && $code != 10017) // не надо так
            ) {
                continue;
            }

            $course_code = $json['tsb']['data'][$code]['currency'];

            foreach ($course_code as $key => $course) {
                if (empty($courses[$key]) || $courses[$key]['buy'] > $course[0]['buy']) {
                    $courses[$key]['buy'] = $course[0]['buy'];
                    $courses[$key]['sell'] = $course[0]['sell'];
                    $courses[$key]['status'] = $course['status']; // статуса нет
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

        if (!empty($office_id)) {
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
            array("SORT" => "ASC"),
            array("IBLOCK_ID" => 115, "ID" => $office_id),
            false,
            false,
            array("IBLOCK_ID", "ID", "PROPERTY_ATT_CODE")
        );

        while ($arOffice = $rsOffices->Fetch()) {
            if (!empty($arOffice['PROPERTY_ATT_CODE_VALUE'])) {
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
            array("SORT" => "ASC"),
            array("IBLOCK_ID" => "114", "ID" => $city, 'ACTIVE' => 'Y'),
            false,
            false,
            array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_CODE")
        );

        while ($city = $cities->Fetch()) {
            if (!empty($city['PROPERTY_ATT_CODE_VALUE'])) {
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
     * Шаблонные данные по курсам валют
     * @return array
     */
    private static function templateCourses() // работает self::$courses_list с 8.06.23
    {
        $courses = [];

        $courses['USD']['name'] = 'Доллар США';
        $courses['USD']['symbol'] = '$';
        $courses['USD']['count'] = 1;
        $courses['USD']['iso_n'] = '840';
        $courses['USD']['iso_s'] = 'USD';

        $courses['EUR']['name'] = 'Евро';
        $courses['EUR']['symbol'] = '€';
        $courses['EUR']['count'] = 1;
        $courses['EUR']['iso_n'] = '978';
        $courses['EUR']['iso_s'] = 'EUR';

        $courses['GBP']['name'] = 'Фунт стерлингов Соединенного королевства';
        $courses['GBP']['symbol'] = '£';
        $courses['GBP']['count'] = 1;
        $courses['GBP']['iso_n'] = '826';
        $courses['GBP']['iso_s'] = 'GBP';

        $courses['CHF']['name'] = 'Швейцарский франк';
        $courses['CHF']['symbol'] = '₣';
        $courses['CHF']['count'] = 1;
        $courses['CHF']['iso_n'] = '756';
        $courses['CHF']['iso_s'] = 'CHF';

        $courses['JPY']['name'] = 'Японская иена';
        $courses['JPY']['symbol'] = '¥';
        $courses['JPY']['count'] = 100;
        $courses['JPY']['iso_n'] = '392';
        $courses['JPY']['iso_s'] = 'JPY';

        $courses['CNY']['name'] = 'Китайский юань';
        $courses['CNY']['symbol'] = '¥';
        $courses['CNY']['count'] = 1;
        $courses['CNY']['iso_n'] = '156';
        $courses['CNY']['iso_s'] = 'CNY';

        $courses['PLN']['name'] = 'Польский злотый';
        $courses['PLN']['symbol'] = 'zł';
        $courses['PLN']['count'] = 1;
        $courses['PLN']['iso_n'] = '985';
        $courses['PLN']['iso_s'] = 'PLN';

        $courses['AED']['name'] = 'Дирхам ОАЭ';  // добавка с 20.12.21
        $courses['AED']['symbol'] = 'DH';
        $courses['AED']['count'] = 1;
        $courses['AED']['iso_n'] = '784';
        $courses['AED']['iso_s'] = 'AED'; // **

        $courses['AMD']['name'] = 'Армянский драм';  // добавка с 10.12.21
        $courses['AMD']['symbol'] = '֏';
        $courses['AMD']['count'] = 100;
        $courses['AMD']['iso_n'] = '051';
        $courses['AMD']['iso_s'] = 'AMD'; // **

        $courses['AUD']['name'] = 'Австралийский доллар';  // добавка с 5.12.21
        $courses['AUD']['symbol'] = '$';
        $courses['AUD']['count'] = 1;
        $courses['AUD']['iso_n'] = '036';
        $courses['AUD']['iso_s'] = 'AUD'; // **

        $courses['AZN']['name'] = 'Азербайджанский манат';  // добавка с 5.12.21
        $courses['AZN']['symbol'] = '₼';
        $courses['AZN']['count'] = 1;
        $courses['AZN']['iso_n'] = '944';
        $courses['AZN']['iso_s'] = 'AZN'; // **

        $courses['BGN']['name'] = 'Болгарский лев';  // добавка с 5.12.21
        $courses['BGN']['symbol'] = 'лв';
        $courses['BGN']['count'] = 1;
        $courses['BGN']['iso_n'] = '975';
        $courses['BGN']['iso_s'] = 'BGN'; // **

        $courses['BHD']['name'] = 'Бахрейнский динар';  // добавка с 5.08.22
        $courses['BHD']['symbol'] = 'BD';
        $courses['BHD']['count'] = 1;
        $courses['BHD']['iso_n'] = '048';
        $courses['BHD']['iso_s'] = 'BHD'; // **

        $courses['BRL']['name'] = 'Бразильский реал';  // добавка с 8.09.22
        $courses['BRL']['symbol'] = 'R$';
        $courses['BRL']['count'] = 1;
        $courses['BRL']['iso_n'] = '986';
        $courses['BRL']['iso_s'] = 'BRL'; // **

        $courses['BYN']['name'] = 'Белорусский рубль';
        $courses['BYN']['symbol'] = 'Br';
        $courses['BYN']['count'] = 1;
        $courses['BYN']['iso_n'] = '933';
        $courses['BYN']['iso_s'] = 'BYN'; // **

        $courses['CAD']['name'] = 'Канадский доллар';  // добавка с 5.12.21
        $courses['CAD']['symbol'] = 'C$';
        $courses['CAD']['count'] = 1;
        $courses['CAD']['iso_n'] = '124';
        $courses['CAD']['iso_s'] = 'CAD'; // **

        $courses['CZK']['name'] = 'Чешская крона';  // добавка с 5.12.21
        $courses['CZK']['symbol'] = 'Kč';
        $courses['CZK']['count'] = 10;
        $courses['CZK']['iso_n'] = '203';
        $courses['CZK']['iso_s'] = 'CZK'; // **

        $courses['DKK']['name'] = 'Датская крона';  // добавка с 11.1.22
        $courses['DKK']['symbol'] = 'kr';
        $courses['DKK']['count'] = 1;
        $courses['DKK']['iso_n'] = '208';
        $courses['DKK']['iso_s'] = 'DKK'; // **

        $courses['EGP']['name'] = 'Египетский фунт';  // добавка с 22.12.21
        $courses['EGP']['symbol'] = 'ДУ';
        $courses['EGP']['count'] = 10;
        $courses['EGP']['iso_n'] = '818';
        $courses['EGP']['iso_s'] = 'EGP'; // **

        $courses['GEL']['name'] = 'Грузинский лари';  // добавка с 22.2.22
        $courses['GEL']['symbol'] = '₾';
        $courses['GEL']['count'] = 1;
        $courses['GEL']['iso_n'] = '981';
        $courses['GEL']['iso_s'] = 'GEL'; // **

        $courses['HKD']['name'] = 'Гонконгский доллар';  // добавка с 14.12.21
        $courses['HKD']['symbol'] = 'HK$';
        $courses['HKD']['count'] = 10;
        $courses['HKD']['iso_n'] = '344';
        $courses['HKD']['iso_s'] = 'HKD'; // **

        $courses['HUF']['name'] = 'Венгерский форинт';  // добавка с 5.12.21
        $courses['HUF']['symbol'] = 'F';
        $courses['HUF']['count'] = 100;
        $courses['HUF']['iso_n'] = '348';
        $courses['HUF']['iso_s'] = 'HUF'; // **

        $courses['IDR']['name'] = 'Индонезийская рупия';  // добавка с 19.5.22
        $courses['IDR']['symbol'] = 'Rp';
        $courses['IDR']['count'] = 10000;
        $courses['IDR']['iso_n'] = '360';
        $courses['IDR']['iso_s'] = 'IDR'; // **

        $courses['ILS']['name'] = 'Новый израильский шекель';  // добавка с 16.12.21
        $courses['ILS']['symbol'] = 'ש';
        $courses['ILS']['count'] = 1;
        $courses['ILS']['iso_n'] = '376';
        $courses['ILS']['iso_s'] = 'ILS'; // **

        $courses['INR']['name'] = 'Индийская рупия';  // добавка с 5.12.21
        $courses['INR']['symbol'] = 'Rs';
        $courses['INR']['count'] = 100;
        $courses['INR']['iso_n'] = '356';
        $courses['INR']['iso_s'] = 'INR'; // **

        $courses['KGS']['name'] = 'Киргизский сом';  // добавка с 5.12.21
        $courses['KGS']['symbol'] = 'с';
        $courses['KGS']['count'] = 100;
        $courses['KGS']['iso_n'] = '417';
        $courses['KGS']['iso_s'] = 'KGS'; // **

        $courses['KRW']['name'] = 'Южнокорейская вона';  // добавка с 10.1.22
        $courses['KRW']['symbol'] = '₩';
        $courses['KRW']['count'] = 1000;
        $courses['KRW']['iso_n'] = '410';
        $courses['KRW']['iso_s'] = 'KRW'; // **

        $courses['KZT']['name'] = 'Казахстанский тенге';  // добавка с 5.12.21
        $courses['KZT']['symbol'] = '₸';
        $courses['KZT']['count'] = 100;
        $courses['KZT']['iso_n'] = '398';
        $courses['KZT']['iso_s'] = 'KZT'; // **

        $courses['KWD']['name'] = 'Кувейтский динар';  // добавка с 28.02.23
        $courses['KWD']['symbol'] = 'KD';
        $courses['KWD']['count'] = 1;
        $courses['KWD']['iso_n'] = '414';
        $courses['KWD']['iso_s'] = 'KWD'; // **

        $courses['LKR']['name'] = 'Шри-Ланкийская рупия';  // добавка с 26.05.23
        $courses['LKR']['symbol'] = 'Rs';
        $courses['LKR']['count'] = 100;
        $courses['LKR']['iso_n'] = '144';
        $courses['LKR']['iso_s'] = 'LKR'; // **

        $courses['MAD']['name'] = 'Марокканский дирхам';  // добавка с 2.6.22
        $courses['MAD']['symbol'] = 'DH';
        $courses['MAD']['count'] = 1;
        $courses['MAD']['iso_n'] = '504';
        $courses['MAD']['iso_s'] = 'MAD'; // **

        $courses['MDL']['name'] = 'Молдавский лей';  // добавка с 14.12.21
        $courses['MDL']['symbol'] = 'L';
        $courses['MDL']['count'] = 10;
        $courses['MDL']['iso_n'] = '498';
        $courses['MDL']['iso_s'] = 'MDL'; // **

        $courses['MXN']['name'] = 'Мексиканское песо';  // добавка с 14.1.22
        $courses['MXN']['symbol'] = '$';
        $courses['MXN']['count'] = 10;
        $courses['MXN']['iso_n'] = '484';
        $courses['MXN']['iso_s'] = 'MXN'; // **

        $courses['MUR']['name'] = 'Маврикийская рупия';  // добавка с 11.10.23
        $courses['MUR']['symbol'] = 'Rs';
        $courses['MUR']['count'] = 10;
        $courses['MUR']['iso_n'] = '480';
        $courses['MUR']['iso_s'] = 'MUR'; // **

        $courses['MVR']['name'] = 'Мальдивская руфия';  // добавка с 26.05.23
        $courses['MVR']['symbol'] = 'L';
        $courses['MVR']['count'] = 10;
        $courses['MVR']['iso_n'] = '462';
        $courses['MVR']['iso_s'] = 'MVR'; // **

        $courses['MYR']['name'] = 'Малайзийский ринггит';  // добавка с 16.4.22
        $courses['MYR']['symbol'] = 'RM';
        $courses['MYR']['count'] = 1;
        $courses['MYR']['iso_n'] = '458';
        $courses['MYR']['iso_s'] = 'MYR'; // **

        $courses['NOK']['name'] = 'Норвежская крона';  // добавка с 16.4.22
        $courses['NOK']['symbol'] = 'kr';
        $courses['NOK']['count'] = 10;
        $courses['NOK']['iso_n'] = '578';
        $courses['NOK']['iso_s'] = 'NOK'; // **

        $courses['NZD']['name'] = 'Новозеландский доллар';  // добавка с 26.05.23
        $courses['NZD']['symbol'] = '$';
        $courses['NZD']['count'] = 1;
        $courses['NZD']['iso_n'] = '554';
        $courses['NZD']['iso_s'] = 'NZD'; // **

        $courses['OMR']['name'] = 'Оманский реал';  // добавка с 26.05.23
        $courses['OMR']['symbol'] = 'RO';
        $courses['OMR']['count'] = 1;
        $courses['OMR']['iso_n'] = '512';
        $courses['OMR']['iso_s'] = 'OMR'; // **

        $courses['QAR']['name'] = 'Катарский риал';  // добавка с 13.1.22
        $courses['QAR']['symbol'] = 'QR';
        $courses['QAR']['count'] = 1;
        $courses['QAR']['iso_n'] = '634';
        $courses['QAR']['iso_s'] = 'QAR'; // **

        $courses['RON']['name'] = 'Румынский лей';  // добавка с 31.01.23
        $courses['RON']['symbol'] = 'L';
        $courses['RON']['count'] = 1;
        $courses['RON']['iso_n'] = '946';
        $courses['RON']['iso_s'] = 'RON'; // **

        $courses['RSD']['name'] = 'Сербский динар';  // добавка с 20.12.21  THB
        $courses['RSD']['symbol'] = 'din';
        $courses['RSD']['count'] = 100;
        $courses['RSD']['iso_n'] = '941';
        $courses['RSD']['iso_s'] = 'RSD'; // **

        $courses['SAR']['name'] = 'Саудовский риял';  // добавка с 28.12.21
        $courses['SAR']['symbol'] = 'SR';
        $courses['SAR']['count'] = 1;
        $courses['SAR']['iso_n'] = '682';
        $courses['SAR']['iso_s'] = 'SAR'; // **

        $courses['SEK']['name'] = 'Шведская крона';  // добавка с 16.4.22
        $courses['SEK']['symbol'] = 'kr';
        $courses['SEK']['count'] = 10;
        $courses['SEK']['iso_n'] = '752';
        $courses['SEK']['iso_s'] = 'SEK'; // **

        $courses['SGD']['name'] = 'Сингапурский доллар';  // добавка с 5.12.21
        $courses['SGD']['symbol'] = '$';
        $courses['SGD']['count'] = 1;
        $courses['SGD']['iso_n'] = '702';
        $courses['SGD']['iso_s'] = 'SGD'; // **

        $courses['THB']['name'] = 'Тайский бат';  // добавка с 20.12.21
        $courses['THB']['symbol'] = '฿';
        $courses['THB']['count'] = 10;
        $courses['THB']['iso_n'] = '764';
        $courses['THB']['iso_s'] = 'THB'; // **

        $courses['TJS']['name'] = 'Таджикский сомони';  // добавка с 10.12.21
        $courses['TJS']['symbol'] = 'c';
        $courses['TJS']['count'] = 10;
        $courses['TJS']['iso_n'] = '972';
        $courses['TJS']['iso_s'] = 'TJS'; // **

        $courses['TRY']['name'] = 'Турецкая лира';
        $courses['TRY']['symbol'] = '₺';
        $courses['TRY']['count'] = 10;
        $courses['TRY']['iso_n'] = '949';
        $courses['TRY']['iso_s'] = 'TRY'; // **

        $courses['UZS']['name'] = 'Узбекский сум';  // добавка с 31.1.22
        $courses['UZS']['symbol'] = "So'm";
        $courses['UZS']['count'] = 10000;
        $courses['UZS']['iso_n'] = '860';
        $courses['UZS']['iso_s'] = 'UZS'; // **

        $courses['VND']['name'] = 'Вьетнамский донг';  // добавка с 16.4.22
        $courses['VND']['symbol'] = '₫';
        $courses['VND']['count'] = 10000;
        $courses['VND']['iso_n'] = '704';
        $courses['VND']['iso_s'] = 'VND'; // **

        $courses['ZAR']['name'] = 'Южноафриканский рэнд';  // добавка с 5.12.21
        $courses['ZAR']['symbol'] = 'R';
        $courses['ZAR']['count'] = 10;
        $courses['ZAR']['iso_n'] = '710';
        $courses['ZAR']['iso_s'] = 'ZAR'; // **

        return $courses;
    }

    /**
     * Добавляем курсы валют ЦБ РФ для динамического графика
     *
     * @param array $data Данные по курсам валют ЦБ РФ
     */
    private function addCourseForDynamic(array $data)
    {
        $el = new CIBlockElement;
        $props = [];

        foreach ($data as $key => $course) {
            $props['ATT_' . $key] = $course['course'];
        }

        $el->Add(array(
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => $this->arParams['CBR_IBLOCK_ID'],
            "PROPERTY_VALUES" => $props,
            "NAME" => date("Y-m-d", time()),
            "ACTIVE" => "Y",
            "PREVIEW_TEXT" => "",
            "DETAIL_TEXT" => ""
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

    /**
     * История курсов валюты
     * @param $json
     */
    private function add_history_rate($json)
    {
        $settings = ['10013' => ['USD', 'EUR']];
        $path = $_SERVER['DOCUMENT_ROOT'] . '/currency/history/';
        $filename = date('dmY') . '_rate.json';
        $content = file_exists($path . $filename)
            ? json_decode(file_get_contents($path . $filename), true)
            : [];

        foreach ($settings as $key => $value) {
            if (!$office = $json['tsb']['data'][$key]) {
                continue;
            }

            foreach ($value as $currency) {
                if (!$office['currency'][$currency]) {
                    continue;
                }

                $update = true;
                $output_currency = $content[$key][$currency] ? $content[$key][$currency] : [];
                $office_obj = $office['currency'][$currency][0];

                if (isset($content[$key][$currency]) && count($content[$key][$currency]) > 0) {
                    $last_history_item = end($content[$key][$currency]);
                    $update = $last_history_item['buy'] != $office_obj['buy']
                        || $last_history_item['sell'] != $office_obj['sell'];
                }

                if ($update) {
                    $output_currency[] = [
                        'date' => date('d.m.Y H:i:s'),
                        'buy' => $office_obj['buy'],
                        'sell' => $office_obj['sell']
                    ];
                }

                $content[$key][$currency] = $output_currency;
            }
        }

        file_put_contents(
            $path . $filename,
            json_encode($content)
        );
    }
}