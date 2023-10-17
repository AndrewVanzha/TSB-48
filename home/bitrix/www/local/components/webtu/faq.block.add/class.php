<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();
use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


class FAQList extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend = array();


    #Перезаписываем $this->arParams (Удаляем не нужное)
    public function onPrepareComponentParams($params)
    {
        $result = array(
            "CACHE_TIME"                => $params['CACHE_TIME'],
            "HIGHLOAD_IBLOCK_ID"        => $params['HIGHLOAD_IBLOCK_ID']
        );
        return $result;
    }

    #Проверяет подключение необходиимых модулей 
    protected function checkModules()
    {
        //if (!Loader::includeModule('iblock')){
        //    throw new Main\LoaderException('Ошибка модуля iblock');
        //}
        if (!Loader::includeModule("highloadblock")){
            throw new Main\LoaderException('Ошибка модуля highloadblock');
        }
    }

    protected function load_highloadblock()
    {
        $hlBlock = Bitrix\Highloadblock\HighloadBlockTable::getById($this->arParams['HIGHLOAD_IBLOCK_ID'])->fetch();

        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlBlock);
        $hlEntity = $entity->getDataClass();

        $arListData = [];
        $result = $hlEntity::getList([
            'select' => ["*"],
            //"select" => array("ID", "UF_NAME", "UF_XML_ID"), // Поля для выборки
            'filter' => [],
            "order" => array(),
            //"order" => array("UF_SORT" => "ASC"),
        ]);
        while ($res = $result->fetch()) {
            $arListData[] = $res;
        }
        //debugg($arListData);
        return $arListData;
    }

    protected function getResult()
    {
        $this->arResult['FAQ_LIST'] = $this->load_highloadblock();
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
                $this -> arResult["COMPONENT_ID"] = 'HL';
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
