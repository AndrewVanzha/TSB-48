<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!Loader::includeModule("iblock")){ return; }

if($arCurrentValues["IBLOCK_ID"] > 0){
    $arIBlock = CIBlock::GetArrayByID($arCurrentValues["IBLOCK_ID"]);
    $bWorkflowIncluded = ($arIBlock["WORKFLOW"] == "Y") && CModule::IncludeModule("workflow");
    $bBizproc = ($arIBlock["BIZPROC"] == "Y") && CModule::IncludeModule("bizproc");
}else{
    $bWorkflowIncluded = CModule::IncludeModule("workflow");
    $bBizproc = false;
}

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr = $rsIBlock->Fetch()){
    $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_TYPE" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => Loc::getMessage("SFA_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => Loc::getMessage("SFA_IBLOCK_IBLOCK"),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
        ),
        "FILTER_NAME" => array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => Loc::getMessage('SFA_FILTER_NAME'),
            "TYPE"    => "STRING",
            "DEFAULT" => ''
        ),
        "PARENT_SECTION_ID" => array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => Loc::getMessage('SFA_PARENT_SECTION_ID'),
            "TYPE"    => "STRING",
            "DEFAULT" => ''
        ),
        "PROP_CODE" => array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => Loc::getMessage('SFA_PROP_CODE'),
            "TYPE"    => "STRING",
            "DEFAULT" => ''
        ),
        "AJAX_MODE"   => array()
    ),
);	  
?>