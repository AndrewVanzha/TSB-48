<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$aMenuLinksExt = array();

if(CModule::IncludeModule('iblock')) {
    $IBLOCK_ID = 218;  //  Валюты с условиями
    $arOrder = Array("SORT"=>"ASC");
    //$arSelect = Array("ID", "CODE", "SECTION_PAGE_URL");
    $arSelect = Array();
    $arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y");
    $res = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);

    while($arSect = $res->GetNext())
    {
        if ($arSect['ID'] != 590) { // раздел 590 = Москва, учтено в базовом меню
            $aMenuLinksExt[] = array(
                $arSect['NAME'],
                $arSect['SECTION_PAGE_URL'],
                [],
                [],
            );
        }
    }
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
