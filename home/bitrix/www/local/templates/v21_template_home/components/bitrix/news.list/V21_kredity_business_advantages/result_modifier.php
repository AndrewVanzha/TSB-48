<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
//debugg($arSection);
/*
$dbResSect = CIBlockSection::GetList(
    Array("SORT"=>"ASC"),
    Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'SECTION_ID'=>$arParams['PARENT_SECTION'])
);
//Получаем разделы и собираем в массив
while($sectRes = $dbResSect->GetNext())
{
    $arSections[$sectRes['ID']] = $sectRes;
}

foreach($arResult['ITEMS'] as $key=>$arItem) {
    $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}

$arResult['TREE'] = $arSections;
*/
$rsSection = CIBlockSection::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ID" => $arParams['PARENT_SECTION']),
    false,
    array('ID', 'NAME', 'UF_*')
);
while ($arSection = $rsSection->GetNext()) {
    $arResult['SECTION']['PATH'][0]['UFS'] = $arSection;
}

//debugg($arResult);
