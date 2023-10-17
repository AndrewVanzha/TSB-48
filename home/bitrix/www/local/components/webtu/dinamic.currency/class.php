<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


class DinamicCurrency extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend = array();

    #Перезаписываем $this->arParams (Удаляем не нужное)
    public function onPrepareComponentParams($params)
    {
        $result = array(
            "CACHE_TIME"             => $params['CACHE_TIME'],
            "CBR_IBLOCK_ID"          => $params['CBR_IBLOCK_ID'],

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


    protected function getResult()
    {
        #Получаем данные о шаблоне
        $this->InitComponentTemplate();
        //инициализируем шаблон, а затем получаем название и расположение
        $template = & $this->GetTemplate();
        $this->arResult["TEMPLATE_FILE"] = $template->GetFile();
        $this->arResult["TEMPLATE_FOLDER"] = $template->GetFolder();
        $arCur = array();
        $rsElements = CIBlockElement::GetList(
            Array("NAME"=>"ASC"),
            Array("IBLOCK_ID"=>$this->arParams['CBR_IBLOCK_ID'], "ACTIVE"=>'Y'),
            false,
            Array("nPageSize"=>900),
            Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_USD", "PROPERTY_ATT_EUR", "PROPERTY_ATT_JPY", "PROPERTY_ATT_CNY", "PROPERTY_ATT_GBP", "PROPERTY_ATT_CHF")
        );
        while($arElements = $rsElements->Fetch()){
            $arrDate = explode('-', $arElements['NAME']);
            $date = $arrDate[2].'.'.$arrDate[1].'.'.$arrDate[0][2].$arrDate[0][3];
            $arCur[] = array(
                'date'=>$date,
                'USD'=>$arElements['PROPERTY_ATT_USD_VALUE'],
                'EUR'=>$arElements['PROPERTY_ATT_EUR_VALUE'],
                'JPY'=>$arElements['PROPERTY_ATT_JPY_VALUE'],
                'CNY'=>$arElements['PROPERTY_ATT_CNY_VALUE'],
                'GBP'=>$arElements['PROPERTY_ATT_GBP_VALUE'],
                'CHF'=>$arElements['PROPERTY_ATT_CHF_VALUE']
            );
        }
        $this->arResult['ITEMS'] = $arCur;

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
            if ($this->startResultCache()) {
                $this -> arResult["COMPONENT_ID"] = 'DC';
                $this -> checkModules();
                $this -> getResult();
                $this -> actionMessage();


                $this -> includeComponentTemplate();
            }
		}catch (Exception $e){
			ShowError($e->getMessage());
		}
    }

};
