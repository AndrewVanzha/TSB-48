<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arParams["OPTIONS"] = [];
$arParams["OPTIONS"]["IBLOCK_ID"] = $arParams["IBLOCK_ID"];
$arParams["OPTIONS"]["PROPERTIES"] = $arParams["PROPERTIES"];
$arParams["OPTIONS"]["ADMIN_EVENT"] = $arParams["ADMIN_EVENT"];
$arParams["OPTIONS"]["USER_EVENT"] = $arParams["USER_EVENT"];
$arParams["OPTIONS"]["SITES"] = $arParams["SITES"];

$arOffices = [];
$arCities = [];
$arCitiesMod = [];
if(CModule::IncludeModule("iblock")) {
    $rsList = CIblockElement::GetList(
        array("SORT" => "ASC"),
        array("IBLOCK_ID" => 114, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"),
        false,
        false,
        array("IBLOCK_ID", "ID", "NAME", "CODE")
        //array()
    );
    while ($city = $rsList->Fetch()) {
        $arCities[] = $city;
    }

    $arResult['SPECIAL_CITY'] = 'Не выбрано';
    $arCitiesMod[0]['NAME'] = $arResult['SPECIAL_CITY'];   // Исключаем Санкт-Петербург
    $arCitiesMod[0]['ID'] = '400';
    for ($ii=0, $key=1; $ii<count($arCities); $ii++) {
        if ($arCities[$ii]['ID'] != '400') {
            $arCitiesMod[$key] = $arCities[$ii];
            $key += 1;
        }
    }
    $arResult['CITIES'] = $arCities;
    $arResult['CITIES_MOD'] = $arCitiesMod;

    /*
    $rsList = CIBlockElement::GetList(  // массив офисов с названиями, городами и адресами
        array("SORT" => "ASC"),
        array("IBLOCK_ID" => 115, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"),
        false,
        false,
        array("IBLOCK_ID", "ID", "NAME", "CODE", "PROPERTY_ATT_ADDRESS", "PROPERTY_ATT_CITY")
    );
    while ($arList = $rsList->Fetch()) {
        $ar_office['NAME'] = $arList['NAME'];
        $ar_office['ADDRESS'] = $arList['PROPERTY_ATT_ADDRESS_VALUE'];
        $ar_office['CITY'] = $arList['PROPERTY_ATT_CITY_VALUE'];
        $ar_office['SORT'] = $arList['SORT'];
        $arOffices[] = $ar_office;
    }
    //debugg($arOffices);
    $arResult['OFFICES_LIST'] = $arOffices;
    */

    $offices = \Bitrix\Iblock\Elements\ElementOfficesTable::getList([
        'select' => ['ID', 'NAME', 'CODE', 'ATT_TYPE', 'ATT_ADDRESS_CITY', 'ATT_ADDRESS', 'ATT_CARD_ISSUE', 'ATT_NAME_WHERE', 'SORT'],
        //'select' => [],
        'order' => ['SORT' => 'ASC'],
        'filter' => [
            '=ACTIVE' => 'Y',
            '=IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_TYPE_VALUE' => 42, // офисы, не банкоматы
            '=IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_CARD_ISSUE_VALUE' => 159 // выдача карт = Да
        ],
    ])->fetchAll();
    //debugg($offices);
    foreach ($offices as $office) {
        $ar_office['NAME'] = $office['NAME'];
        $ar_office['ADDRESS'] = $office['IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_ADDRESS_VALUE'];
        $ar_office['CITY'] = $office['IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_ADDRESS_CITY_VALUE'];
        $ar_office['CODE'] = $office['CODE'];
        $ar_office['SORT'] = $office['SORT'];
        $ar_office['WHERE'] = $office['IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_NAME_WHERE_VALUE'];
        $arOffices[] = $ar_office;
    }
    //debugg($arOffices);
    $arResult['OFFICES_LIST'] = $arOffices;

    foreach ($arCities as $city) {
        foreach ($arOffices as $office) {
            if ($city['NAME'] == $office['CITY']) {
                $arResult['OFFICES'][$city['CODE']][] = $office;
            }
        }
    }
}
unset($arOffices);
unset($arCities);
unset($arCitiesMod);
