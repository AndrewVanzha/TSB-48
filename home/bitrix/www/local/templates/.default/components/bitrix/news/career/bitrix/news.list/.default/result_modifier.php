<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult['ITEMS'] as $key => $value) {
    $res = CIBlockElement::GetByID($value['ID']);
    if($ar_res = $res->GetNext());
    $res = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);
    if($ar_res = $res->GetNext());
    $arResult['SECTION'][$ar_res['ID']]['ITEMS'][] = $value;
    $arResult['SECTION'][$ar_res['ID']]['NAME'] = $ar_res['NAME'];
    $arResult['SECTION'][$ar_res['ID']]['DESCRIPTION'] = $ar_res['DESCRIPTION'];

}
if(!empty($arResult['SECTION'])) unset($arResult['ITEMS']);
?>
