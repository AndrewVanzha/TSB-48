<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE' => 'Y');
$db_list = CIBlockSection::GetList(array("SORT" => "ASC"), $arFilter, true);
$arResult["SECTIONS"] = [];
while ($ar_result = $db_list->GetNext()) {
    $arResult["SECTIONS"][$ar_result['ID']] = $ar_result['NAME'];
}

$arResult["ELEMENTS"] = [];
foreach ($arResult["ITEMS"] as $arItem) {
    $arResult["ELEMENTS"][$arItem["IBLOCK_SECTION_ID"]][] = $arItem;
}
