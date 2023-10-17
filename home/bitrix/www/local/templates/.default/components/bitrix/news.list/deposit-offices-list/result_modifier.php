<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arDepositOffices = [];
$arActiveSections = [];
$arSections = [];
//debugg($arResult['ITEMS']);

$arOffices = [];
$arSelect = ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "LIST_PAGE_URL", "CODE", "DETAIL_PAGE_URL", "SECTION_ID ", "PREVIEW_PICTURE", "PROPERTY_*"];
$arFilter = ["IBLOCK_ID" => "92", "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $arResult["ITEMS"][0]["PROPERTIES"]["ADD_OFFICES"]["VALUE"]];

$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $arDepositOffices[] = [ "FIELDS" => $arFields, "PROPS" => $arProps];
    $arActiveSections[] = $arFields["IBLOCK_SECTION_ID"];
}
//debugg($arDepositOffices);

$filter = ["IBLOCK_ID" => "92", "ID" => $arActiveSections, "ACTIVE" => "Y", "IBLOCK_ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y"];
$arSelect = ["ID", "NAME", "SORT", "SECTION_PAGE_URL", "CODE"];
//$arSelect = [];
$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), $filter, false, $arSelect);
while ($arParam = $rsResult->Fetch()) {
    $arSections[$arParam["ID"]] = $arParam;
}
//debugg($arSections);

for ($ii = 0; $ii < count($arDepositOffices); $ii++) {
    $ix = $arDepositOffices[$ii]["FIELDS"]["IBLOCK_SECTION_ID"];
    $arDepositOffices[$ii]["FIELDS"]["SECTION"] = $arSections[$ix];
}

for ($ii = 0; $ii < count($arDepositOffices); $ii++) { // заполняю пустые ссылки на Москву
    if(empty($arDepositOffices[$ii]["PROPS"]["ATT_YANDEX_LOCATION"]["VALUE"])) {
        $arDepositOffices[$ii]["PROPS"]["ATT_YANDEX_LOCATION"]["VALUE"] = 'https://yandex.ru/maps/213/moscow/house/dubininskaya_ulitsa_94/Z04YcARiTU0DQFtvfXtwdXViZQ==/?ll=37.633483%2C55.714044&z=15';
    }
    if(empty($arDepositOffices[$ii]["PROPS"]["ATT_2GIS_LOCATION"]["VALUE"])) {
        $arDepositOffices[$ii]["PROPS"]["ATT_2GIS_LOCATION"]["VALUE"] = 'https://2gis.ru/moscow/search/%D0%B3.%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%2C%20%D1%83%D0%BB.%20%D0%94%D1%83%D0%B1%D0%B8%D0%BD%D0%B8%D0%BD%D1%81%D0%BA%D0%B0%D1%8F%2C%20%D0%B4.%2094?m=37.632315%2C55.714965%2F14.92';
    }
}

function office_sort($a, $b) {
    if($a['FIELDS']['SECTION']['SORT'] == $b['FIELDS']['SECTION']['SORT'])
        return 0;
    if($a['FIELDS']['SECTION']['SORT'] < $b['FIELDS']['SECTION']['SORT'])
        return -1;
    else
        return 1;
}

usort($arDepositOffices, 'office_sort');

$arResult["DEPOSIT_OFFICES"] = $arDepositOffices;
//debugg($arResult["DEPOSIT_OFFICES"]);

unset($arDepositOffices);
unset($arActiveSections);
unset($arSections);
