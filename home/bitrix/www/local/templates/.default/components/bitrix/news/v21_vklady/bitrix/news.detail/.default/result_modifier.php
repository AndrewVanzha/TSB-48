<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arFilter = ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE' => 'Y'];
$db_list = CIBlockSection::GetList(["SORT" => "ASC"], $arFilter, true);
$arResult["SECTIONS"] = [];
while ($ar_result = $db_list->GetNext()) {
    $arResult["SECTIONS"][$ar_result['ID']] = [
        "NAME" => $ar_result['NAME']
    ];
}

$arSelect = ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL"];
$arFilter = [$arParams['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "NAME" => $arResult['NAME']];
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    if ($arResult["SECTIONS"][$arFields["IBLOCK_SECTION_ID"]]) {
        $arResult["SECTIONS"][$arFields["IBLOCK_SECTION_ID"]]["SRC"] = $arFields["DETAIL_PAGE_URL"];
    }
}

foreach ($arResult["SECTIONS"] as $key => $section) {
    if (!$section["SRC"]) {
        unset($arResult["SECTIONS"][$key]);
    }
}

//Общие документы
$arResult["GENERAL_DOCS"] = [];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*"];
$arFilter = ["IBLOCK_ID" => "197", "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $arResult["PROPERTIES"]["GENERAL_DOCS"]["VALUE"]];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {    
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $arResult["GENERAL_DOCS"][] = [
        "NAME" => $arFields["NAME"],
        "SRC" => CFile::GetPath($arProps["FILE"]["VALUE"])
    ];
}
