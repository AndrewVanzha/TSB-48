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
            "OFFICE_IBLOCK_ID"          => $params['OFFICE_IBLOCK_ID']
        );
        return $result;
    }

    #Проверяет подключение необходиимых модулей 
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
        
        //$request = Application::getInstance()->getContext()->getRequest();
        $officeId = $_GET["office"];

        if(!empty($officeId)){
            \GarbageStorage::set('OfficeId', $officeId);
            $office = \GarbageStorage::get('OfficeId');
        } else {
            $office = \GarbageStorage::get('OfficeId');
        }

		$rsOffices = CIBlockElement::GetList(
			Array("SORT"=>"ASC"),
			Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "ID"=>$office, "ACTIVE"=>"Y"),
			false,
			false,
			Array("IBLOCK_ID", "ID", "EN_NAME", "NAME", "PROPERTY_ATT_CODE", "PROPERTY_ATT_ADDRESS", "PROPERTY_ATT_PHONE")
		);
        while($arOffice = $rsOffices->Fetch()){
			$res = $json['tsb']['data'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'];
			
			$res['name'] = $arOffice['NAME'];
			$res['address'] = $arOffice['PROPERTY_ATT_ADDRESS_VALUE'];
			$res['phone'] = $arOffice['PROPERTY_ATT_PHONE_VALUE'];
			$res['en_name'] = $arOffice['PROPERTY_EN_OFFICE_NAME_VALUE'];
			
			return $res;
        }  
        
    }

    protected function getOffice()
    {
        session_start();
        if (isset($_SESSION['city'])) {
            $selectCity = $_SESSION['city'];
        } else {
            $selectCity = 399;
        }


        $rsElements = CIBlockElement::GetList(
            Array("SORT"=>"ASC"),
            Array("IBLOCK_ID"=> "114"/*$this->arParams['IBLOCK_ID']*/, "ID"=>$selectCity),
            false,
            false,
            Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_CODE")
        );

        while($arElement = $rsElements->Fetch()){
            $arOffice = array();
            foreach ($arElement["PROPERTY_ATT_CODE_VALUE"] as $code) {
                $rsOffices = CIBlockElement::GetList(
                    Array("SORT"=>"ASC"),
                    Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "PROPERTY_ATT_CODE"=>$code, "ACTIVE"=>"Y"),
                    false,
                    false,
                    Array("IBLOCK_ID","PROPERTY_EN_OFFICE_NAME", "ID", "NAME", "PROPERTY_ATT_ADDRESS", "PROPERTY_ATT_PHONE")
                );
                while($arOffices = $rsOffices->Fetch()){
                    $arOffice[] = $arOffices;
                }
            }
        }

        $rsOnlineOffice = CIBlockElement::GetList(
            Array("SORT"=>"ASC"),
            Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "PROPERTY_ATT_CODE"=>10900, "ACTIVE"=>"Y"),
            false,
            false,
            Array("IBLOCK_ID", "PROPERTY_EN_OFFICE_NAME","ID", "NAME", "PROPERTY_ATT_ADDRESS", "PROPERTY_ATT_PHONE")
        );
        while($onlineOffice = $rsOnlineOffice->Fetch()){
            $arOffice[] = $onlineOffice;
        }

        //Передаем значение дефолтного офиса
        \GarbageStorage::set('OfficeId', $arOffice['0']['ID']); 
        return $arOffice;
    }



    protected function getResult()
    {
        $this->arResult['OFFICE'] = $this->getOffice();
        $csv = $this->load_kurs_csv();
        debugg('$csv=');
        debugg($csv);
        $this->arResult['NAME_OFFICE'] = $csv['name'];
        $this->arResult['ADDRESS_OFFICE'] = $csv['address'];
        $this->arResult['PHONE_OFFICE'] = $csv['phone'];
        $this->arResult['CUR']['USD'] = array("NAME"=>'USD', "BUY"=>$csv['USD']['buy'], "SELL"=>$csv['USD']['sell'], "DATE"=>$csv['USD']['date']);
        $this->arResult['CUR']['EUR'] = array("NAME"=>'EUR', "BUY"=>$csv['EUR']['buy'], "SELL"=>$csv['EUR']['sell'], "DATE"=>$csv['EUR']['date']);
        $this->arResult['CUR']['GBP'] = array("NAME"=>'GBP', "BUY"=>$csv['GBP']['buy'], "SELL"=>$csv['GBP']['sell'], "DATE"=>$csv['GBP']['date']);
        $this->arResult['CUR']['CHF'] = array("NAME"=>'CHF', "BUY"=>$csv['CHF']['buy'], "SELL"=>$csv['CHF']['sell'], "DATE"=>$csv['CHF']['date']);
        $this->arResult['CUR']['JPY'] = array("NAME"=>'JPY', "BUY"=>$csv['JPY']['buy'], "SELL"=>$csv['JPY']['sell'], "DATE"=>$csv['JPY']['date']);
        $this->arResult['CUR']['CNY'] = array("NAME"=>'CNY', "BUY"=>$csv['CNY']['buy'], "SELL"=>$csv['CNY']['sell'], "DATE"=>$csv['CNY']['date']);
        $this->arResult['CUR']['PLN'] = array("NAME"=>'PLN', "BUY"=>$csv['PLN']['buy'], "SELL"=>$csv['PLN']['sell'], "DATE"=>$csv['PLN']['date']);

        $this->arResult['CUR']['AUD'] = array("NAME"=>'AUD', "BUY"=>$csv['AUD']['buy'], "SELL"=>$csv['AUD']['sell'], "DATE"=>$csv['AUD']['date']);
        $this->arResult['CUR']['AZN'] = array("NAME"=>'AZN', "BUY"=>$csv['AZN']['buy'], "SELL"=>$csv['AZN']['sell'], "DATE"=>$csv['AZN']['date']);
        $this->arResult['CUR']['AMD'] = array("NAME"=>'AMD', "BUY"=>$csv['AMD']['buy'], "SELL"=>$csv['AMD']['sell'], "DATE"=>$csv['AMD']['date']);
        $this->arResult['CUR']['BYN'] = array("NAME"=>'BYN', "BUY"=>$csv['BYN']['buy'], "SELL"=>$csv['BYN']['sell'], "DATE"=>$csv['BYN']['date']);
        $this->arResult['CUR']['BGN'] = array("NAME"=>'BGN', "BUY"=>$csv['BGN']['buy'], "SELL"=>$csv['BGN']['sell'], "DATE"=>$csv['BGN']['date']);
        $this->arResult['CUR']['HUF'] = array("NAME"=>'HUF', "BUY"=>$csv['HUF']['buy'], "SELL"=>$csv['HUF']['sell'], "DATE"=>$csv['HUF']['date']);
        $this->arResult['CUR']['HKD'] = array("NAME"=>'HKD', "BUY"=>$csv['HKD']['buy'], "SELL"=>$csv['HKD']['sell'], "DATE"=>$csv['HKD']['date']);
        $this->arResult['CUR']['DKK'] = array("NAME"=>'DKK', "BUY"=>$csv['DKK']['buy'], "SELL"=>$csv['DKK']['sell'], "DATE"=>$csv['DKK']['date']);
        $this->arResult['CUR']['INR'] = array("NAME"=>'INR', "BUY"=>$csv['INR']['buy'], "SELL"=>$csv['INR']['sell'], "DATE"=>$csv['INR']['date']);
        $this->arResult['CUR']['KZT'] = array("NAME"=>'KZT', "BUY"=>$csv['KZT']['buy'], "SELL"=>$csv['KZT']['sell'], "DATE"=>$csv['KZT']['date']);
        $this->arResult['CUR']['CAD'] = array("NAME"=>'CAD', "BUY"=>$csv['CAD']['buy'], "SELL"=>$csv['CAD']['sell'], "DATE"=>$csv['CAD']['date']);
        $this->arResult['CUR']['KGS'] = array("NAME"=>'KGS', "BUY"=>$csv['KGS']['buy'], "SELL"=>$csv['KGS']['sell'], "DATE"=>$csv['KGS']['date']);
        $this->arResult['CUR']['MDL'] = array("NAME"=>'MDL', "BUY"=>$csv['MDL']['buy'], "SELL"=>$csv['MDL']['sell'], "DATE"=>$csv['MDL']['date']);
        $this->arResult['CUR']['SGD'] = array("NAME"=>'SGD', "BUY"=>$csv['SGD']['buy'], "SELL"=>$csv['SGD']['sell'], "DATE"=>$csv['SGD']['date']);
        $this->arResult['CUR']['TJS'] = array("NAME"=>'TJS', "BUY"=>$csv['TJS']['buy'], "SELL"=>$csv['TJS']['sell'], "DATE"=>$csv['TJS']['date']);
        $this->arResult['CUR']['TRY'] = array("NAME"=>'TRY', "BUY"=>$csv['TRY']['buy'], "SELL"=>$csv['TRY']['sell'], "DATE"=>$csv['TRY']['date']);
        $this->arResult['CUR']['CZK'] = array("NAME"=>'CZK', "BUY"=>$csv['CZK']['buy'], "SELL"=>$csv['CZK']['sell'], "DATE"=>$csv['CZK']['date']);
        $this->arResult['CUR']['ZAR'] = array("NAME"=>'ZAR', "BUY"=>$csv['ZAR']['buy'], "SELL"=>$csv['ZAR']['sell'], "DATE"=>$csv['ZAR']['date']);
        $this->arResult['CUR']['KRW'] = array("NAME"=>'KRW', "BUY"=>$csv['KRW']['buy'], "SELL"=>$csv['KRW']['sell'], "DATE"=>$csv['KRW']['date']);

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
