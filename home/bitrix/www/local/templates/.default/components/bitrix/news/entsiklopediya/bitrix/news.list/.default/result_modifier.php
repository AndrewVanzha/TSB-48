<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule('iblock')) return false;

$arResult["SECTIONS"][] = array(
    "ID" => "",
    "NAME" => "Все статьи",
    "SECTION_PAGE_URL" => $arResult["LIST_PAGE_URL"]
);

$arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y");

$rsSect = CIBlockSection::GetList(Array("SORT" => "ASC"), $arFilter, true);

while ($arSect = $rsSect->GetNext()) {

    if ($arSect["ELEMENT_CNT"] > 0) {
        $arResult["SECTIONS"][] = $arSect;
    }

    
}


?>