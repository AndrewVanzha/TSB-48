<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arInfo = array(); 
foreach ($arResult['ITEMS'] as $key => $arItem) {
    if (strtolower(trim($arItem["ITEMS"][0]["PROPERTY_ATT_CATEGORY_VALUE"])) == strtolower('РАСКРЫТИЕ РЕГУЛЯТОРНОЙ ИНФОРМАЦИИ')) {
        $arInfo["Regular"]["NAME"] = "Раскрытие регуляторной информации";
        $arInfo["Regular"]["ITEMS"][$key] = $arItem;
        unset($arResult['ITEMS'][$key]);
    } elseif (strtolower(trim($arItem["ITEMS"][0]["PROPERTY_ATT_CATEGORY_VALUE"])) == strtolower('Годовая бухгалтерская (финансовая) отчетность')) {
        $arInfo["Year"]["NAME"] = "Годовая бухгалтерская (финансовая) отчетность";
        $arInfo["Year"]["ITEMS"][$key] = $arItem;
        unset($arResult['ITEMS'][$key]);
    } elseif (strtolower(trim($arItem["ITEMS"][0]["PROPERTY_ATT_CATEGORY_VALUE"])) == strtolower('Ежемесячная финансовая отчетность по российским стандартам')) {
        $arInfo["Month"]["NAME"] = "Ежемесячная финансовая отчетность по российским стандартам";
        $arInfo["Month"]["ITEMS"][$key] = $arItem;
        unset($arResult['ITEMS'][$key]);
    } elseif (strtolower(trim($arItem["ITEMS"][0]["PROPERTY_ATT_CATEGORY_VALUE"])) == strtolower('Промежуточная бухгалтерская (финансовая) отчетность')) {
        $arInfo["Session"]["NAME"] = "Промежуточная бухгалтерская (финансовая) отчетность";
        $arInfo["Session"]["ITEMS"][$key] = $arItem;
        unset($arResult['ITEMS'][$key]);
    } elseif (strtolower(trim($arItem["ITEMS"][0]["PROPERTY_ATT_CATEGORY_VALUE"])) == strtolower('Раскрытие информации о принимаемых рисках, процедурах их оценки, управления рисками и капиталом')) {
        $arInfo["Trouble"]["NAME"] = "Раскрытие информации о принимаемых рисках, процедурах их оценки, управления рисками и капиталом";
        $arInfo["Trouble"]["ITEMS"][$key] = $arItem;
        unset($arResult['ITEMS'][$key]);
    } elseif (strtolower(trim($arItem["ITEMS"][0]["PROPERTY_ATT_CATEGORY_VALUE"])) == strtolower('Финансовая отчетность по международным стандартам')) {
        $arInfo["Report"]["NAME"] = "Финансовая отчетность по международным стандартам";
        $arInfo["Report"]["ITEMS"][$key] = $arItem;
        unset($arResult['ITEMS'][$key]);
    }
}

$arResult['GROUP_ITEMS'] = $arInfo;
unset($arInfo);
