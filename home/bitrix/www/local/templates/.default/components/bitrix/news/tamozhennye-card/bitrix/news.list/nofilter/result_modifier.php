<?
$arLimit = array();
$arPaySystem = array();
$arType = array();
foreach ($arResult['ITEMS'] as $arItem) {
    array_push($arLimit, $arItem['PROPERTIES']['LIMIT']['VALUE']);
    array_push($arType, $arItem['PROPERTIES']['TYPE']['VALUE']);
    array_push($arPaySystem, $arItem['PROPERTIES']['PAY_SYSTEM']['VALUE']);
}
$arLimit = array_unique($arLimit);
$arType = array_unique($arType);
$arPaySystem = array_unique($arPaySystem);

$arResult['FILTER']['LIMIT'] = $arLimit;
$arResult['FILTER']['TYPE'] = $arType;
$arResult['FILTER']['PAY_SYSTEM'] = $arPaySystem;
?>
