<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//debugg($arParams);
//debugg($arResult);

//$arResult['PROPERTIES'] = [];
$main_items = [];
$dop_items = [];
$icon_items = [];

foreach ($arResult["ITEMS"] as $arItem) {
    if ($arItem['ID'] == $arParams['SERVICES_BLOCK'][0]) {
        //debugg($arParams['SERVICES_BLOCK'][0]);
        //debugg($arItem);
        $arResult['PROPERTY_HEADER'] = $arItem['~NAME'];
        if ($arItem['PROPERTIES']['ATT_SERVICES']['VALUE']) {
            foreach ($arItem['PROPERTIES']['ATT_SERVICES']['~VALUE'] as $item) {
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

if (!empty($main_items)) {
    for ($ii=0; $ii<count($main_items); $ii++) {
        $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['main'] = $main_items[$ii];
        if ($dop_items[$ii]) {
            $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['dop'] = $dop_items[$ii];
        } else {
            $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['dop'] = '';
        }
        if ($icon_items[$ii]) {
            $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['icon'] = $icon_items[$ii];
        } else {
            $arResult['PROPERTIES'][$arParams['SERVICES_BLOCK'][0]][$ii]['icon'] = '';
        }
    }
}

//debugg($arResult['PROPERTIES']);
unset($main_items);
unset($dop_items);
unset($icon_items);
