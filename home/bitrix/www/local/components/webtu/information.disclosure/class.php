<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


class InformationDisclosure extends CBitrixComponent
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
		$request = Application::getInstance()->getContext()->getRequest();
		
        $arCategory = array();
        $arYears = array();
        $rsSect = CIBlockSection::GetList(
            array("SORT"=>"ASC"),
            array("IBLOCK_ID"=>$this->arParams['IBLOCK_ID']),
            false,
            array("ID", "NAME", "CODE", "DESCRIPTION"),
            false
        );
        while ($arSect = $rsSect->GetNext()){
            $rsElem = CIBlockElement::GetList(
                array("SORT"=>"ASC"),
                array("IBLOCK_ID"=>$this->arParams['IBLOCK_ID'], "SECTION_ID"=>$arSect['ID']),
                false,
                false,
                array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_ATT_CATEGORY", "PROPERTY_ATT_FILE", "PROPERTY_ATT_YEAR", "DETAIL_TEXT")
            );
            while ($arElem = $rsElem->GetNext()){

                if ($arElem['PROPERTY_ATT_CATEGORY_VALUE']) $arCategory[] = $arElem['PROPERTY_ATT_CATEGORY_VALUE'];
                if ($arElem['PROPERTY_ATT_YEAR_VALUE']) {
                    $arYears[] = $arElem['PROPERTY_ATT_YEAR_VALUE'];
                    $arElem['YEAR'] = $arElem['PROPERTY_ATT_YEAR_VALUE'];
                } else {
                    if ($arElem['DATE_ACTIVE_FROM']){
                        $arDate = explode(".", $arElem['DATE_ACTIVE_FROM']);
                        if (count($arDate) == 3) {
                            $arYears[] = explode(".", $arElem['DATE_ACTIVE_FROM'])['2'];
                            $arElem['YEAR'] = explode(".", $arElem['DATE_ACTIVE_FROM'])['2'];
                        }
                    }
                }
                if ($arElem['PROPERTY_ATT_FILE_VALUE']){
                    $arElem['FILE'] = CFile::GetPath($arElem['PROPERTY_ATT_FILE_VALUE']);
                }
                $this->arResult['ITEMS'][$arSect['ID']]['ITEMS'][] = $arElem;
            }
            $this->arResult['ITEMS'][$arSect['ID']]['NAME'] = $arSect['NAME'];
            $this->arResult['ITEMS'][$arSect['ID']]['CODE'] = $arSect['CODE'];
            $this->arResult['ITEMS'][$arSect['ID']]['DESCRIPTION'] = $arSect['DESCRIPTION'];

        }

        sort($arYears);
        sort($arCategory);
        $this->arResult['FILTER']['YEARS'] = array_unique($arYears);
        $this->arResult['FILTER']['CATEGORY'] = array_unique($arCategory);
		
		if(!empty($request->getQuery("it-security"))){
			$this->arResult['FILTER']['CURRENT'] = 'Информационная безопасность';
		}
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
                $this -> arResult["COMPONENT_ID"] = 'ID';
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
