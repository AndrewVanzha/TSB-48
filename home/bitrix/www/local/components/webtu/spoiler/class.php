<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

IncludeTemplateLangFile(__FILE__);

class WebtuSpoiler extends CBitrixComponent
{
    public $errors  = array();
    public $success = array();

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        CModule::IncludeModule('iblock');

        if (empty($this->arParams['ADD_INFO_SELF']) && empty($this->arParams['ADD_INFO_BANK'])) {
            return false;
        }

        $elementSelf = CIblockElement::GetList(array(), array("ID" => $this->arParams['ADD_INFO_SELF'][0]));
        $elementSelf = $elementSelf->Fetch();

        $elementBank = CIblockElement::GetList(array(), array("ID" => $this->arParams['ADD_INFO_BANK'][0]));
        $elementBank = $elementBank->Fetch();

        $elementsSelf = array();
        $elementsSelfPre = CIblockElement::GetList(
            array("SORT"=>"ASC"),
            array(
                "ID" => $this->arParams['ADD_INFO_SELF'],
                "IBLOCK_ID" => $elementSelf['IBLOCK_ID']
            ),
            false,
            false,
            array(
                "ID",
                "NAME",
                "PREVIEW_TEXT",
                "PROPERTY_FILE",
                "TIMESTAMP_X",
                "DATE_ACTIVE_FROM",
            )
        );

        $elementsBank = array();
        $elementsBankPre = CIblockElement::GetList(
            array("SORT"=>"ASC"),
            array(
                "ID" => $this->arParams['ADD_INFO_BANK'],
                "IBLOCK_ID" => $elementBank['IBLOCK_ID']
            ),
            false,
            false,
            array(
                "ID",
                "NAME",
                "SORT",
                "TIMESTAMP_X",
                "PREVIEW_TEXT",
                "PROPERTY_FILE",
                "DATE_ACTIVE_FROM",
            )
        );

        while ($selfRow = $elementsSelfPre->Fetch()) {
            $elementsSelf[$selfRow['ID']]['ID'] = $selfRow['ID'];
            $elementsSelf[$selfRow['ID']]['TIMESTAMP_X'] = (!empty($selfRow['DATE_ACTIVE_FROM']))?$selfRow['DATE_ACTIVE_FROM']:$selfRow['TIMESTAMP_X'];
            $elementsSelf[$selfRow['ID']]['NAME'] = $selfRow['NAME'];
            $elementsSelf[$selfRow['ID']]['PREVIEW_TEXT'] = $selfRow['PREVIEW_TEXT'];
            $elementsSelf[$selfRow['ID']]['PROPERTY_FILE_VALUE'][] = $selfRow['PROPERTY_FILE_VALUE'];
            $elementsSelf[$selfRow['ID']]['PREVIEW_TEXT_TYPE'] = $selfRow['PREVIEW_TEXT_TYPE'];
        }
        while ($bankRow = $elementsBankPre->Fetch()) {
            $elementsBank[$bankRow['ID']]['ID'] = $bankRow['ID'];
            $elementsBank[$bankRow['ID']]['TIMESTAMP_X'] = (!empty($bankRow['DATE_ACTIVE_FROM']))?$bankRow['DATE_ACTIVE_FROM']:$bankRow['TIMESTAMP_X'];
            $elementsBank[$bankRow['ID']]['NAME'] = $bankRow['NAME'];
            $elementsBank[$bankRow['ID']]['PREVIEW_TEXT'] = $bankRow['PREVIEW_TEXT'];
            $elementsBank[$bankRow['ID']]['PROPERTY_FILE_VALUE'][] = $bankRow['PROPERTY_FILE_VALUE'];
            $elementsBank[$bankRow['ID']]['PREVIEW_TEXT_TYPE'] = $bankRow['PREVIEW_TEXT_TYPE'];

        }

        $items = array_merge($elementsSelf, $elementsBank);

        // usort(
        //     $items,
        //     function($a, $b) {

        //         $a['SORT'] = (int)$a['SORT'];
        //         $b['SORT'] = (int)$b['SORT'];

        //         if ($a["SORT"] > $b["SORT"]) {
        //             return -1;
        //         }

        //         if ($a["SORT"] < $b["SORT"]) {
        //             return 1;
        //         }

        //         return 0;
        //     }
        // );


        $this->arResult['ITEMS'] = $items;

        $this->arResult['ERRORS']  = $this->getErrors();
        $this->arResult['SUCCESS'] = $this->getSuccess();

        $this->includeComponentTemplate();
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addSuccess($success)
    {
        $this->success[] = $success;
    }

    public function getSuccess()
    {
        return $this->success;
    }
}
