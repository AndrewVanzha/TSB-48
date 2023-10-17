<?
$arSections = [];
$ar_filter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE'=>'Y');
$ar_select = Array('ID', 'NAME', 'CODE', 'PICTURE', 'DESCRIPTION');

$rsSection = \Bitrix\Iblock\SectionTable::getList(array(
    'order' => array('LEFT_MARGIN'=>'ASC'),
    'filter' => $ar_filter,
    'select' => $ar_select,
));
while ($ar_section=$rsSection->fetch()) {
    $arSections[$ar_section['ID']] = $ar_section;
}

$arResult['SECTIONS'] = $arSections;
for ($ii=0; $ii<count($arResult['ITEMS']); $ii++) {
    $arResult['ITEMS'][$ii]['SECTION'] = $arSections[$arResult['ITEMS'][$ii]['IBLOCK_SECTION_ID']];
}
//debugg($arResult);
unset($arSections);
?>
