<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


class CalculatorCredit extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend = array();

    #Перезаписываем $this->arParams (Удаляем не нужное)
    public function onPrepareComponentParams($params)
    {
        $result = array(
            "AJAX_MODE"              => $params['AJAX_MODE']              ? $params['AJAX_MODE']              : '',
            "AJAX_OPTION_ADDITIONAL" => $params['AJAX_OPTION_ADDITIONAL'] ? $params['AJAX_OPTION_ADDITIONAL'] : '',
            "AJAX_OPTION_HISTORY"    => $params['AJAX_OPTION_HISTORY']    ? $params['AJAX_OPTION_HISTORY']    : '',
            "AJAX_OPTION_JUMP"       => $params['AJAX_OPTION_JUMP']       ? $params['AJAX_OPTION_JUMP']       : '',
            "AJAX_OPTION_STYLE"      => $params['AJAX_OPTION_STYLE']      ? $params['AJAX_OPTION_STYLE']      : '',
            "CACHE_TIME"             => $params['CACHE_TIME'],

            "IBLOCK_ID"              => $params['IBLOCK_ID'],
            "ELEMENT_ID"             => $params['ELEMENT_ID'],
            "PERCENT_RUB"            => $params['PERCENT_RUB'],
            "PERCENT_USD"            => $params['PERCENT_USD'],
            "PERCENT_EUR"            => $params['PERCENT_EUR'],
            "CREDIT_NAME"            => $params['CREDIT_NAME'],

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
        //получаем настройки
        $rsParams = CIBlockElement::GetProperty(
            $this->arParams['IBLOCK_ID'],
            $this->arParams['ELEMENT_ID'],
            array(),
            array()
        );
        while($arParams = $rsParams->Fetch()){
            $arSettings[$arParams['CODE']] = $arParams;
        }

        // echo '<pre>';
        // print_r($this->arParams);
        // print_r($arSettings);
        // echo '</pre>';

        $this->arResult['SETTINGS']['DIFFERENTIATED'] = $arSettings['DIFFERENTIATED']['VALUE_ENUM'];
        $this->arResult['SETTINGS']['STEPS_SUMM'] = $arSettings['AVERAGE_SUMM']['VALUE'];
        $this->arResult['SETTINGS']['STEPS_DATE'] = $arSettings['AVERAGE_DATE']['VALUE'];
        $this->arResult['SETTINGS']['CURRENCY']['EURO'] = $arSettings['CURRENCY_EURO']['VALUE'];
        $this->arResult['SETTINGS']['CURRENCY']['DOLLAR'] = $arSettings['CURRENCY_DOLLAR']['VALUE'];
        $this->arResult['SETTINGS']['CURRENCY']['RUB'] = $arSettings['CURRENCY_RUB']['VALUE'];
        $this->arResult['SETTINGS']['PERCENT_RUB'] = $this->arParams['PERCENT_RUB'];
        $this->arResult['SETTINGS']['PERCENT_USD'] = $this->arParams['PERCENT_USD'];
        $this->arResult['SETTINGS']['PERCENT_EUR'] = $this->arParams['PERCENT_EUR'];
        $this->arResult['SETTINGS']['CREDIT_NAME'] = $this->arParams['CREDIT_NAME'];



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
                $this -> arResult["COMPONENT_ID"] = 'CC';
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
