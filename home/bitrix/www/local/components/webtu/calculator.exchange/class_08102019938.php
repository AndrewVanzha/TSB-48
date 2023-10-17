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
            Array("IBLOCK_ID", "ID","EN_NAME", "NAME", "PROPERTY_ATT_BUY_GBP", "PROPERTY_ATT_BUY_USD", "PROPERTY_ATT_BUY_EUR", "PROPERTY_ATT_BUY_CHF", "PROPERTY_ATT_BUY_JPY", "PROPERTY_ATT_BUY_CNY", "PROPERTY_ATT_SELL_USD", "PROPERTY_ATT_SELL_EUR", "PROPERTY_ATT_SELL_GBP", "PROPERTY_ATT_SELL_CHF", "PROPERTY_ATT_SELL_JPY", "PROPERTY_ATT_SELL_CNY", "TIMESTAMP_X", "PROPERTY_ATT_ADDRESS", "PROPERTY_ATT_PHONE")
        );
        while($arOffice = $rsOffices->Fetch()){
            return array('NAME'=>$arOffice['NAME'],
                         'ADDRESS'=>$arOffice['PROPERTY_ATT_ADDRESS_VALUE'],
                         'PHONE'=>$arOffice['PROPERTY_ATT_PHONE_VALUE'],
			 'EN_NAME'=>$arOffice['PROPERTY_EN_OFFICE_NAME_VALUE'],
                         'USD'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_USD_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_USD_VALUE'],'DATE'=>$arOffice['TIMESTAMP_X']),
                         'EUR'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_EUR_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_EUR_VALUE'],'DATE'=>$arOffice['TIMESTAMP_X']),
                         'GBP'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_GBP_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_GBP_VALUE'],'DATE'=>$arOffice['TIMESTAMP_X']),
                         'CHF'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_CHF_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_CHF_VALUE'],'DATE'=>$arOffice['TIMESTAMP_X']),
                         'JPY'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_JPY_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_JPY_VALUE'],'DATE'=>$arOffice['TIMESTAMP_X']),
                         'CNY'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_CNY_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_CNY_VALUE'],'DATE'=>$arOffice['TIMESTAMP_X']),
                        );
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
        $this->arResult['NAME_OFFICE'] = $csv['NAME'];
        $this->arResult['ADDRESS_OFFICE'] = $csv['ADDRESS'];
        $this->arResult['PHONE_OFFICE'] = $csv['PHONE'];
        $this->arResult['CUR']['USD'] = array("NAME"=>'USD', "BUY"=>$csv['USD']['BUY'], "SELL"=>$csv['USD']['SELL'], "DATE"=>$csv['USD']['DATE']);
        $this->arResult['CUR']['EUR'] = array("NAME"=>'EUR', "BUY"=>$csv['EUR']['BUY'], "SELL"=>$csv['EUR']['SELL'], "DATE"=>$csv['EUR']['DATE']);
        $this->arResult['CUR']['GBP'] = array("NAME"=>'GBP', "BUY"=>$csv['GBP']['BUY'], "SELL"=>$csv['GBP']['SELL'], "DATE"=>$csv['GBP']['DATE']);
        $this->arResult['CUR']['CHF'] = array("NAME"=>'CHF', "BUY"=>$csv['CHF']['BUY'], "SELL"=>$csv['CHF']['SELL'], "DATE"=>$csv['CHF']['DATE']);
        $this->arResult['CUR']['JPY'] = array("NAME"=>'JPY', "BUY"=>$csv['JPY']['BUY'], "SELL"=>$csv['JPY']['SELL'], "DATE"=>$csv['JPY']['DATE']);
        $this->arResult['CUR']['CNY'] = array("NAME"=>'CNY', "BUY"=>$csv['CNY']['BUY'], "SELL"=>$csv['CNY']['SELL'], "DATE"=>$csv['CNY']['DATE']);
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
