<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


class CitySelectForm extends CBitrixComponent
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
            "OFFICE_IBLOCK_ID"       => $params['OFFICE_IBLOCK_ID'],

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

    protected function session()
    {
        $request = Application::getInstance()->getContext()->getRequest(); 
        $selectCity = $request->getPost("select");
        // $selectOffice = $request->getPost("office-id");
        session_start();
        if(!empty($selectCity)) {
            $_SESSION['city'] = $selectCity;
            echo "<script>location.reload();</script>";
        }
        
        // $this->arResult['SELECTED'] = $_SESSION['city'];
    }


    protected function getResult()
    {
        
        $rsElements = CIBlockElement::GetList(
            Array("SORT"=>"ASC"),
            Array("IBLOCK_ID"=>$this->arParams['IBLOCK_ID']), // 114
            false,
            false,
            Array("IBLOCK_ID", "ID", "NAME", "CODE", "ACTIVE", "PROPERTY_ATT_ENGLISH", "PROPERTY_ATT_FORM", "PROPERTY_ATT_CODE", "PROPERTY_ATT_WHERE")
        );

       

        while($arElement = $rsElements->Fetch()){
            if ($arElement['ACTIVE'] == 'Y') {
                $arOffice = array();

                $id = $arElement['ID'];

                $name = $arElement['NAME'];
                $nameEnglish = $arElement['PROPERTY_ATT_ENGLISH_VALUE'];
                $nameWhere = $arElement['PROPERTY_ATT_WHERE_VALUE'] ?? $arElement['NAME'];
                $codeName = $arElement['CODE'];

                foreach ($arElement["PROPERTY_ATT_CODE_VALUE"] as $code) {
                    $rsOffices = CIBlockElement::GetList(
                        Array("SORT"=>"ASC"),
                        Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "PROPERTY_ATT_CODE"=>$code), // 115 Курсы валют банка
                        false,
                        false,
                        Array("IBLOCK_ID", "ID", "NAME")
                    );
                    while($arOffices = $rsOffices->Fetch()){
                        $arOffice[] = $arOffices;
                    }
                }

                $arCity[] = array('ID'=>$id, 'NAME'=>$name, 'CODE_NAME'=>$codeName, 'NAME_ENGLISH'=>$nameEnglish, 'NAME_WHERE'=>$nameWhere, 'FORM' => $arElement['PROPERTY_ATT_FORM_VALUE'], 'CODE' =>$arElement['PROPERTY_ATT_CODE_VALUE'], 'OFFICES' => $arOffice);
            }
        }
        
        $this->arResult['CITY'] = $arCity;

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
                $this -> arResult["COMPONENT_ID"] = 'CSF';
                $this -> checkModules();
                $this -> session();
                $this -> getResult();
                $this -> actionMessage();


                $this -> includeComponentTemplate();
            // }
		}catch (Exception $e){
			ShowError($e->getMessage());
		}
    }

};
