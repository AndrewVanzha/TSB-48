<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblockId = 92; //Инфоблок с офисами

if ($_POST['CITY']){
    $arFilter = array("IBLOCK_ID"=>$iblockId, "IBLOCK_SECTION_ID"=>$_POST['CITY']);
} else {
    $arFilter = array("IBLOCK_ID"=>$iblockId);
}

$rsList = CIBlockElement::GetList(
    Array("SORT"=>"ASC"),
    $arFilter,
    false,
    false,
    Array("ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_ATT_COORDINATES", "DETAIL_PAGE_URL", "PROPERTY_ATT_ADDRESS", "PROPERTY_ATT_PHONE", "PROPERTY_ATT_METRO", "PROPERTY_ATT_SERVICE", "PROPERTY_ATT_MODE", "PREVIEW_PICTURE")
);
while($arList = $rsList->Fetch()){
    $img = !empty($arList['PREVIEW_PICTURE']) ? $arList['PREVIEW_PICTURE']['SRC'] : '/local/templates/.default/img/logo_office.jpg';
    $res = CIBlockSection::GetByID($arList['IBLOCK_SECTION_ID']);
    if($ar_res = $res->GetNext());
//    $latLng = implode(",", $arList['PROPERTY_ATT_COORDINATES_VALUE']);
    $arrList[] = array('ID'=>$arList['ID'], 'NAME'=>$arList['NAME'], 'COORDINATES'=>$arList['PROPERTY_ATT_COORDINATES_VALUE'], 'CITY'=>$ar_res['NAME'], 'URL'=>$arList['DETAIL_PAGE_URL'], 'ADDRESS'=>$arList['PROPERTY_ATT_ADDRESS_VALUE'], 'PHONE'=>$arList['PROPERTY_ATT_PHONE_VALUE'], 'METRO'=>$arList['PROPERTY_ATT_METRO_VALUE'], 'SERVICES'=>$arList['PROPERTY_ATT_SERVICE_VALUE'], 'MODE'=>$arList['PROPERTY_ATT_MODE_VALUE'], 'IMG'=>$img);
//    $arrList[] = $arList;
}
echo json_encode($arrList);

