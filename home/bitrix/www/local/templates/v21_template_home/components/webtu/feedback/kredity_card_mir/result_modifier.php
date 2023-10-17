<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

$arSelect = ["ID", "IBLOCK_ID", "NAME", "CODE", "VALUE", "PROPERTY_*"];
//$arSelect = [];
$arFilter = ["IBLOCK_ID" => "205", "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arProps = $ob->GetProperties();
    $arResult["CREDIT_LIMITS"] = $arProps;
}
//debugg($arResult["CREDIT_LIMITS"]);
