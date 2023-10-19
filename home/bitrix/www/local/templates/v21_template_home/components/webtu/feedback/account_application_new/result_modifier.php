<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

$arSelect = ["ID", "IBLOCK_ID", "NAME", "CODE", "VALUE"];
//$arSelect = [];
$arFilter = ["IBLOCK_ID" => "114", "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"];

$cities = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($city = $cities->Fetch()) {
    //$arFields = $ob->GetFields();
    //$arProps = $ob->GetProperties();
    $arResult["CITIES"][] = $city['NAME'];
    //$arResult["CREDIT_LIMITS"] = [
    //    $arFields,
    //    $arProps
    //];
}
array_unshift($arResult["CITIES"], "Город");

$arResult['ACCOUNT_CURRENCY'] = [
    'Валюта',
    'RUB',
    'CNY',
    'USD',
    'EUR',
];
