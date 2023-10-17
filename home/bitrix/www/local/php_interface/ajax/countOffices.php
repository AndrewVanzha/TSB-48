<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblockId = 92; //Инфоблок с офисами

$arFilter = array("IBLOCK_ID"=>$iblockId);
$iCount = CIBlockElement::GetList(false, $arFilter, array());
echo $iCount;
