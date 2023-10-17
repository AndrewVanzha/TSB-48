<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();
use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


class CalculatorExchange extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend = array();


    #Перезаписываем $this->arParams (Удаляем не нужное)
    public function onPrepareComponentParams($params)
    {
        $result = array(
            "CACHE_TIME"                => $params['CACHE_TIME'],
            "CITY_CODE"                 => $params['CITY_CODE'],
            "CITIES_IBLOCK_ID"          => $params['CITIES_IBLOCK_ID'],
            "OFFICE_IBLOCK_ID"          => $params['OFFICE_IBLOCK_ID'],
            "CURRENCY"                  => $params['CURRENCY'],
        );
        return $result;
    }

    #Проверяет подключение необходимых модулей
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')){
            throw new Main\LoaderException('Ошибка модуля iblock');
        }
    }

    protected function load_kurs_csv()
    {
		$json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/currency/currency.json");
		$json = json_decode($json, true);
        
        $officeId = $_GET["office"]; // ???
        if(!empty($officeId)){
            \GarbageStorage::set('OfficeId', $officeId);  // ???
            $office = \GarbageStorage::get('OfficeId');
        } else {
            $office = \GarbageStorage::get('OfficeId');
        }

        CModule::IncludeModule('highloadblock');
        $ID = 4; // TSBCurrencyList
        $hlData = \Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
        $hlEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlData)->getDataClass();

        $arCurrencyList = [];
        $result = $hlEntity::getList([
            'select' => ["*"],
            'filter' => [],
            "order" => array(),
        ]);
        while ($res = $result->fetch()) {
            $arCurrencyList[$res['UF_CURR_CODE']] = $res; // массив валют, с которыми оперирует ТСБ
        }
        //debugg($arCurrencyList);
        $arKeys = [];
        foreach ($json['tsb']['data'] as $key=>$item) {  // сделал массив валют, по которыми есть инфо в $json
            $arKey = array_merge($arKeys, array_keys($item['currency']));
            $arKeys = array_unique($arKey);
            //debugg($item['currency']);
        }
        //debugg('$arKeys=');
        //debugg($arKeys);
        $arCurrencyOper = [];
        foreach ($arCurrencyList as $key=>$arCurItem) { // выбираю те валюты с описанием, которые присутствуют в $json
            //debugg($key);
            //debugg($arCurItem);
            if(in_array($key, $arKeys)) {
                $arCurrencyOper[$key] = $arCurItem;
                $str = mb_strtoupper(substr($arCurrencyOper[$key]['UF_CURR_TEXT_RU'],0,2));
                $first_l = mb_substr($arCurrencyOper[$key]['UF_CURR_TEXT_RU'],0,1);
                $first_l = mb_strtoupper($first_l);
                $new_str = mb_substr($arCurrencyOper[$key]['UF_CURR_TEXT_RU'],1);
                //$arCurrencyOper[$key]['UF_CURR_TEXT_RU2'] = $first_l . $new_str . ' (' . $arCurItem['UF_CURR_CODE'] . ')';
                $arCurrencyOper[$key]['UF_CURR_TEXT_RU2'] = $first_l . $new_str;
            }
        }
        unset($arKeys);
        unset($arCurrencyList);
        uasort($arCurrencyOper, function ($a, $b) {
            return $a['UF_CURR_TEXT_RU'] <=> $b['UF_CURR_TEXT_RU']; // сортирую по полю
        });
        //debugg('$arCurrencyOper=');
        //debugg($arCurrencyOper);
        $this->arResult['TSB_CURRENCIES'] = $arCurrencyOper;


        $arKeys = [];
        $arCurrencies = [];
        $arActiveOffices = [];
        $arActiveOfficesCourse = [];
        foreach ($this->arResult["CITY"]["OFFICES_CODES"] as $officeCode) { // собираю офисы в выбранном городе
            //debugg('$officeCode=');
            //debugg($officeCode);
            if(array_key_exists($officeCode, $json['tsb']['data'])) {
                //debugg($json['tsb']['data'][$officeCode]);
                $arKey = array_merge($arKeys, array_keys($json['tsb']['data'][$officeCode]['currency']));
                $arKeys = array_unique($arKey);
                if(is_array($json['tsb']['data'][$officeCode])) {
                    //$arActiveOffices[] = $json['tsb']['data'][$officeCode];
                    $arActiveOffices[$json['tsb']['data'][$officeCode]['code']] = $json['tsb']['data'][$officeCode];
                }
            }
        }
        //debugg('$arKeys=');
        //debugg($arKeys);
        //ksort($arKeys);
        foreach ($arKeys as $currency_code) {
            $arCurrencies[$currency_code]['UF_CURR_CODE'] = $currency_code;
            $arCurrencies[$currency_code]['UF_CURR_TEXT_RU2'] = $this->arResult['TSB_CURRENCIES'][$currency_code]['UF_CURR_TEXT_RU2'];
        }
        uasort($arCurrencies, function ($a, $b) {
            return $a['UF_CURR_TEXT_RU2'] <=> $b['UF_CURR_TEXT_RU2']; // сортирую по полю
        });
        //debugg('$arCurrencies=');
        //debugg($arCurrencies);
        $this->arResult["CITY"]["CURRENCY_CODES"] = $arCurrencies;


        //debugg('$arActiveOffices=');
        //debugg($arActiveOffices);
        $tsb_curr = [];
        foreach ($arActiveOffices as $ii=>$office) {
            foreach ($arCurrencyOper as $currency_code=>$item) { // опорный массив валют банка
                foreach ($office['currency'] as $key=>$value) { // сортирую по кодам валют из опорного массива
                    if ($currency_code == $key) {
                        $tsb_curr[$ii]['code'] = $office['code'];
                        $tsb_curr[$ii]['name'] = $office['name'];
                        $tsb_curr[$ii]['date'] = $office['date'];
                        $tsb_curr[$ii]['currency'][$currency_code] = $value;
                    }
                }
            }
        }
        //debugg('$tsb_curr=');
        //debugg($tsb_curr);


        foreach ($arActiveOffices as $ii=>$arItem) {
            $arActiveOffices[$ii]['list'] = array_keys($arItem['currency']);
        }
        //debugg($arActiveOffices);
        $arActiveOfficesCourse['time'] = $json['tsb']['time'];
        $arActiveOfficesCourse['tsb_curr'] = $tsb_curr;

        if(empty($this->arParams['CURRENCY'])) {
            //debugg('empty');
            $currency_code = 'USD';
        } else {
            $currency_code = $this->arParams['CURRENCY'];
        }
        //debugg($currency_code);
        foreach ($arActiveOffices as $ii=>$arItem) { // фильтрую по имени валюты
            //debugg($arItem);
            if (array_key_exists($currency_code, $arItem['currency'])) {
                //debugg($arItem['currency'][$currency_code]);
                $arActiveOfficesCourse['tsb'][$arItem['code']]['code'] = $arItem['code'];
                $arActiveOfficesCourse['tsb'][$arItem['code']]['name'] = $arItem['name'];
                $arActiveOfficesCourse['tsb'][$arItem['code']]['date'] = $arItem['date'];
                $arActiveOfficesCourse['tsb'][$arItem['code']]['currency'][$currency_code] = $arItem['currency'][$currency_code];

                $arActiveOfficesCourse['cbr'] = $json['cbr']['data']; // - беру все курсы ЦБ
                /*if (array_key_exists($currency_code, $json['cbr']['data'])) {
                    $arActiveOfficesCourse['cbr'][$currency_code] = $json['cbr']['data'][$currency_code];
                } else {
                    $arActiveOfficesCourse['cbr'][$currency_code] = '';
                }*/
            }
        }
        //debugg('$arActiveOfficesCourse=');
        //debugg($arActiveOfficesCourse);
        if(empty($arActiveOfficesCourse)) {
            $arActiveOfficesCourse['tsb'] = $arActiveOffices;
            //$arActiveOfficesCourse['cbr'] = $json['cbr']['data'];
            $arActiveOfficesCourse['currency'] = 'absent';
            return $arActiveOfficesCourse; // возвращаю массив со всеми валютами - такой валюты нет
        } else {
            $arActiveOfficesCourse['currency'] = 'selected';
            return $arActiveOfficesCourse; // возвращаю массив с выбранной валютой
        }

    }

    protected function reform_courses_array($courses)
    {
        //debugg('$courses in=');
        //debugg($courses);
        $cbr = array_keys($courses['cbr']); // коды валют, котируемых ЦБ
        //debugg($cbr);
        $full_courses = [];
        foreach ($courses['tsb'] as $office_code=>$data) {
            //debugg($office_code);
            foreach ($data['currency'] as $currency_code=>$value) {
                //debugg($currency_code);
                //debugg($value);
                if (!in_array($currency_code, $cbr)) {      // валюта не котируется ЦБ
                    $courses['tsb'][$office_code]['currency'][$currency_code][0]['mark'] = 'cb';
                    if (isset($value[1])) {
                        $courses['tsb'][$office_code]['currency'][$currency_code][1]['mark'] = 'cb';
                    }
                    if ($value[0]['multi'] > 1) {
                        $courses['tsb'][$office_code]['currency'][$currency_code][0]['mark'] = 'both';
                        if (isset($value[1])) {
                            $courses['tsb'][$office_code]['currency'][$currency_code][1]['mark'] = 'both';
                        }
                    }
                    //debugg($full_courses);
                } else {
                    if ($value[0]['multi'] > 1) {
                        $courses['tsb'][$office_code]['currency'][$currency_code][0]['mark'] = 'multi';
                        if (isset($value[1])) {
                            $courses['tsb'][$office_code]['currency'][$currency_code][1]['mark'] = 'multi';
                        }
                        //debugg('multi');
                    }
                    //debugg('cbrf');
                    //debugg($courses['tsb'][$office_code]);
                }
                //debugg('total');
                //debugg($courses['tsb'][$office_code]);
            }
        }

        foreach ($courses['tsb_curr'] as $office_code=>$data) {
            foreach ($data['currency'] as $currency_code=>$value) {
                if (!in_array($currency_code, $cbr)) {      // валюта не котируется ЦБ
                    $courses['tsb_curr'][$office_code]['currency'][$currency_code][0]['mark'] = 'cb';
                    if (isset($value[1])) {
                        $courses['tsb_curr'][$office_code]['currency'][$currency_code][1]['mark'] = 'cb';
                    }
                    if ($value[0]['multi'] > 1) {
                        $courses['tsb_curr'][$office_code]['currency'][$currency_code][0]['mark'] = 'both';
                        if (isset($value[1])) {
                            $courses['tsb_curr'][$office_code]['currency'][$currency_code][1]['mark'] = 'both';
                        }
                    }
                } else {
                    if ($value[0]['multi'] > 1) {
                        $courses['tsb_curr'][$office_code]['currency'][$currency_code][0]['mark'] = 'multi';
                        if (isset($value[1])) {
                            $courses['tsb_curr'][$office_code]['currency'][$currency_code][1]['mark'] = 'multi';
                        }
                    }
                }
            }
        }

        return $courses;
    }

    protected function getOffice()
    {
        /*session_start();
        if (isset($_SESSION['city'])) {
            $selectCity = $_SESSION['city'];
        } else {
            $selectCity = 399;
        }*/
        //debugg($this->arParams['CITY_CODE']);
        //debugg($this->arParams['CITIES_IBLOCK_ID']);
        //debugg($this->arParams['OFFICE_IBLOCK_ID']);

        $selectCity = 399;
        $OfficeCodes = [];
        $rsElements = CIBlockElement::GetList(
            Array("SORT"=>"ASC"),
            Array("IBLOCK_ID" => $this->arParams['CITIES_IBLOCK_ID'], "CODE" => $this->arParams['CITY_CODE']),
            false,
            false,
            Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_CODE", "PROPERTY_ATT_WHERE")
            //Array()
        );

        $arOffices = array();
        while($arElement = $rsElements->Fetch()){
            //debugg($arElement);
            $arOffices["CITY"]['ID'] = $arElement['ID'];
            $arOffices["CITY"]['NAME'] = $arElement['NAME'];
            foreach ($arElement["PROPERTY_ATT_CODE_VALUE"] as $code) {
                $OfficeCodes[] = $code;
                $rsOffice = CIBlockElement::GetList(
                    Array("SORT"=>"ASC"),
                    Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "PROPERTY_ATT_CODE"=>$code, "ACTIVE"=>"Y"),
                    false,
                    false,
                    //Array()
                    Array(
                        "IBLOCK_ID",
                        "PROPERTY_EN_OFFICE_NAME",
                        "ID",
                        "NAME",
                        "PROPERTY_ATT_ADDRESS",
                        "PROPERTY_ATT_PHONE",
                        "PROPERTY_ATT_PHONE_LINK",
                        "PROPERTY_ATT_OFFICE_HOURS",
                        "PROPERTY_ATT_WORK_PAUSES",
                        "PROPERTY_ATT_YANDEX_LOCATION",
                        "PROPERTY_ATT_YANDEX_POS",
                        "PROPERTY_ATT_2GIS_LOCATION",
                        "PROPERTY_ATT_CODE",
                        "PROPERTY_ATT_NAME_WHERE",
                    )
                );
                while($arOffice = $rsOffice->Fetch()){
                    $arOffices["OFFICES"][] = $arOffice;
                }
                $arOffices["CITY"]["OFFICES_CODES"][] = $code;
            }
        }
        //debugg($arOffices);
        //debugg($OfficeCodes);

        $iSimpleCode = 10900;
        $rsOnlineOffice = CIBlockElement::GetList(
            Array("SORT"=>"ASC"),
            Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "PROPERTY_ATT_CODE"=>$iSimpleCode, "ACTIVE"=>"Y"), // iSimple
            false,
            false,
            Array(
                "IBLOCK_ID",
                "PROPERTY_EN_OFFICE_NAME",
                "ID",
                "NAME",
                "PROPERTY_ATT_ADDRESS",
                "PROPERTY_ATT_PHONE",
                "PROPERTY_ATT_PHONE_LINK",
                "PROPERTY_ATT_OFFICE_HOURS",
                "PROPERTY_ATT_WORK_PAUSES",
                "PROPERTY_ATT_YANDEX_LOCATION",
                "PROPERTY_ATT_YANDEX_POS",
                "PROPERTY_ATT_2GIS_LOCATION",
                "PROPERTY_ATT_CODE",
                "PROPERTY_ATT_NAME_WHERE",
            )
        );
        while($onlineOffice = $rsOnlineOffice->Fetch()){
            $arOffices["OFFICES"][] = $onlineOffice;
        }
        $arOffices["CITY"]["OFFICES_CODES"][] = $iSimpleCode;
        //debugg($arOffices);

        //Передаем значение дефолтного офиса
        \GarbageStorage::set('OfficeId', $arOffices["OFFICES"]['0']['ID']);
        \GarbageStorage::set('OfficeCode', $OfficeCodes[0]);
        return $arOffices;
    }



    protected function getResult()
    {
        $arOffices = $this->getOffice();
        $this->arResult['OFFICES'] = $arOffices['OFFICES'];
        $this->arResult['CITY'] = $arOffices['CITY'];
        $csv = $this->load_kurs_csv();
        //debugg($csv);
        $courses = $this->reform_courses_array($csv);
        //debugg('$courses=');
        //debugg($courses);
        //$this->arResult['COURSES'] = $csv;
        $this->arResult['COURSES'] = $courses;
    }

    protected function actionMessage()
    {
        $this->arResult["MESSAGE_ERROR"] = $this->MessageError;
        $this->arResult["MESSAGE_SEND"] = $this->MessageSend;
        foreach($this->arResult['MESSAGE_ERROR'] as $error){
            echo "<p style='color: red;'>{$error}</p>";
        }
        foreach($this->arResult['MESSAGE_SEND'] as $send){
            echo "<p style='color: green;'>{$send}</p>";
        }
    }

    public function executeComponent()
    {
		try{
            // if ($this->startResultCache()) {
                $this -> arResult["COMPONENT_ID"] = 'CE';
                $this -> checkModules();
                $this -> getResult();
                $this -> actionMessage();

                $this -> includeComponentTemplate();
            // }
		}catch (Exception $e){
			ShowError($e->getMessage());
		}
    }

};
