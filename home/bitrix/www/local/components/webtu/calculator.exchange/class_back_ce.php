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
			$res = $json[$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'];
			
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
