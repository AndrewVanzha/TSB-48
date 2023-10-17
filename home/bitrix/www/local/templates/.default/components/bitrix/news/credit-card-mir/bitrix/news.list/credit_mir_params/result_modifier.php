<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/*
debugg($arParams['PARENT_SECTION']);
debugg($arParams["IBLOCK_ID"]);

$arSelect = array(
    'NAME',
    'DESCRIPTION',
    'PICTURE',
    'UF_*' // все пользовательские поля, можно перечислять конкретные
);
$secRes = CIBlockSection::GetList(
    false,
    array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ID" => $arParams["PARENT_SECTION"]
    ),
    false,
    $arSelect
);
while ($sectionProp = $secRes->GetNext()) {
    $arSection[] = $sectionProp;
}

debugg($arSection);
*/
//debugg($arResult["SECTION"]["PATH"][0]);
//debugg($arResult["SECTION"]["PATH"][0]["~DESCRIPTION"]);
//debugg($arResult["SECTION"]["PATH"][0]["PICTURE"]);

//debugg($arParams["CREDIT_CARD_PARAMS"]);

//debugg($arResult["ITEMS"]);
/*
debugg($arResult["ITEMS"][0]["~NAME"]);
debugg($arResult["ITEMS"][0]["PREVIEW_PICTURE"]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_CREDIT_LIMIT"]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_CREDIT_LIMIT"]["ID"]); // 759
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_CREDIT_LIMIT"]["~NAME"]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_CREDIT_LIMIT"]["~VALUE"][0]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_CREDIT_LIMIT"]["~DESCRIPTION"][0]);

debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_GRACE_PERIOD"]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_RATE"]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_SERVICE"]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_SMS"]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_CASHBACK"]); // ID = 764
*/
/*
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_GRACE_SCHEME"]); // ID = 765
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_GRACE_SCHEME"]["~NAME"]);
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_GRACE_SCHEME"]["VALUE"]);

debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_LEFT_PARAM"]); // ID = 766
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_LEFT_PARAM"]["~VALUE"]);

debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_LEFT_TEXT"]); // ID = 767
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_LEFT_TEXT"]["~VALUE"]); // cycle

debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_RIGHT_PARAM"]); // ID = 768
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_RIGHT_PARAM"]["~VALUE"]);

debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_RIGHT_TEXT"]); // ID = 769
debugg($arResult["ITEMS"][0]["PROPERTIES"]["ATT_CCM_RIGHT_TEXT"]["~VALUE"]); // cycle
*/
