<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


class CalculatorDeposit extends CBitrixComponent
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
            if ($arParams['CODE'] == 'ATT_PROPERTIES' || $arParams['CODE'] == 'ATT_CURRENTY'){
                $arSettings[$arParams['CODE']][] = array('VALUE' => $arParams['VALUE'], 'DESCRIPTION' => $arParams['DESCRIPTION']);
            } else {
                $arSettings[$arParams['CODE']] = $arParams;
            }
        }

        $this->arResult['SETTINGS']['STEPS_SUMM'] = $arSettings['AVERAGE_SUMM']['VALUE'];
        $this->arResult['SETTINGS']['STEPS_SUMM_CUR'] = $arSettings['AVERAGE_SUMM_CUR']['VALUE'];
        $this->arResult['SETTINGS']['STEPS_DATE'] = $arSettings['AVERAGE_DATE']['VALUE'];
        $this->arResult['SETTINGS']['STEPS_MONTH'] = $arSettings['AVERAGE_MONTH']['VALUE'];

        $this->arResult['SETTINGS']['DEFAULT_SUMM'] = $arSettings['DEFAULT_SUMM']['VALUE'];
        $this->arResult['SETTINGS']['DEFAULT_SUMM_CUR'] = $arSettings['DEFAULT_SUMM_CUR']['VALUE'];
        $this->arResult['SETTINGS']['DEFAULT_DATE'] = $arSettings['DEFAULT_DATE']['VALUE'];
        $this->arResult['SETTINGS']['DEFAULT_MONTH'] = $arSettings['DEFAULT_MONTH']['VALUE'];


        $this->arResult['SETTINGS']['ATT_CURRENTY'] = $arSettings['ATT_CURRENTY'];
        $this->arResult['SETTINGS']['PROPERTIES'] = $arSettings['ATT_PROPERTIES'];



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
            $this -> arResult["COMPONENT_ID"] = 'CC';
            $this -> checkModules();
            $this -> getResult();
            $this -> actionMessage();


            $this -> includeComponentTemplate();
		}catch (Exception $e){
			ShowError($e->getMessage());
		}
    }

};
