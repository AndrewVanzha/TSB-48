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
//debugg($arParams);
//debugg($arResult);

$main_items = [];
$dop_items = [];
$icon_items = [];

foreach ($arResult["ITEMS"] as $arItem) {
    //debugg($arParams['SERVICES_BLOCK'][0]);
    if ($arItem['ID'] == $arParams['SERVICES_BLOCK'][0]) {
        //debugg($arItem);
        $arResult['PROPERTY_HEADER'] = $arItem['~NAME'];
        if ($arItem['PROPERTIES']['ATT_SERVICES']['VALUE']) {
            foreach ($arItem['PROPERTIES']['ATT_SERVICES']['VALUE'] as $item) {
                $main_items[] = $item;
            }
        }
        if ($arItem['PROPERTIES']['ATT_SERVICES']['DESCRIPTION']) {
            foreach ($arItem['PROPERTIES']['ATT_SERVICES']['DESCRIPTION'] as $item) {
                $dop_items[] = $item;
            }
        }
        if ($arItem['PROPERTIES']['ATT_SERVICES_ICONS']['VALUE']) {
            foreach ($arItem['PROPERTIES']['ATT_SERVICES_ICONS']['VALUE'] as $item) {
                $icon_items[] = $item;
            }
        }
        $arResult['NOTES'][$arParams['SERVICES_BLOCK'][0]] = $arItem['PROPERTIES']['ATT_NOTES']['VALUE'];
    }
}
//debugg($main_items);
//debugg($dop_items);
//debugg($icon_items);
define("N_icons", 5);   // рссчитываю только на 5 элементов одного размера
$icon_items_cycles = (int)count($icon_items) / N_icons;   // рссчитываю только на 15 элементов 3х размеров

if (!empty($main_items) && !empty($icon_items)) {
    for ($ii=0; $ii<count($main_items); $ii++) {
        $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['main'] = $main_items[$ii];
        /*if ($dop_items[$ii]) {
            $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['dop'] = $dop_items[$ii];
        } else {
            $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['dop'] = '';
        }*/
        if ($icon_items[$ii]) {
            $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['icon']['size_1'] = $icon_items[$ii];
        } else {
            $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['icon']['size_1'] = '';
        }
        if ($icon_items_cycles >= 2) {
            if ($icon_items[$ii+N_icons]) {
                $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['icon']['size_2'] = $icon_items[$ii+N_icons];
            } else {
                $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['icon']['size_2'] = '';
            }
        }
        if ($icon_items_cycles >= 3) {
            if ($icon_items[$ii+N_icons*2]) {
                $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['icon']['size_3'] = $icon_items[$ii+N_icons*2];
            }else {
                $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['icon']['size_3'] = '';
            }
        }
        $arResult['NOTES'][$arParams['SERVICES_BLOCK'][0]] = $arItem['PROPERTIES']['ATT_NOTES']['VALUE'];
    }
}

//debugg($arResult['PROPERTIES']);
