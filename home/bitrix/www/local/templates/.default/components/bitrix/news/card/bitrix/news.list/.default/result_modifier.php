<?
$arView = array();
$arPaySystem = array();
$arType = array();
foreach ($arResult['ITEMS'] as $arItem) {
    if($arItem['PROPERTIES']['VIEW']['VALUE']) {
        array_push($arView, $arItem['PROPERTIES']['VIEW']['VALUE']);
    }
    //array_push($arType, $arItem['PROPERTIES']['TYPE']['VALUE']);
    $arType = array_merge($arType, $arItem['PROPERTIES']['TYPE']['VALUE']);
    array_push($arPaySystem, $arItem['PROPERTIES']['PAY_SYSTEM']['VALUE']);
}
$arView = array_unique($arView);
$arType = array_unique($arType);
$arPaySystem = array_unique($arPaySystem);

$arResult['FILTER']['VIEW'] = $arView;
$arResult['FILTER']['TYPE'] = $arType;
$arResult['FILTER']['PAY_SYSTEM'] = $arPaySystem;
?>
