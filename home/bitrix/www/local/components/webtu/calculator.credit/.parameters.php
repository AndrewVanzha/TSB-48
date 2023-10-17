<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Loader;
if (!Loader::includeModule("iblock")){ return; }
CModule::IncludeModule("iblock");
CMedialib::Init();
$arSection = array();

$iblocks = array();

$iblocksPre = CIBlock::GetList(
    array(
        "SORT" => "ASC"
    ),
    array(
        "ACTIVE"=>"Y"
    )
);

while ($iblock = $iblocksPre->Fetch()) {
    $iblocks[$iblock['ID']] = $iblock['NAME'];
}

if (0 < intval($arCurrentValues['IBLOCK_ID']))
{
    $rsElements = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'])
    );
    $element = array();
    while ($element = $rsElements->Fetch()) {
        $arElements[$element['ID']] = $element['NAME'];
    }
};

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_ID" => array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => "Инфоблок с настройками калькулятора",
            "TYPE"    => "LIST",
            "VALUES"  => $iblocks,
            "REFRESH" => "Y",
        ),
        "ELEMENT_ID" => array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => "Элемент с настройками калькулятора",
            "TYPE"    => "LIST",
            "VALUES"  => $arElements,
        ),
        "CACHE_TIME"   => array("DEFAULT"=>36000000),
        "AJAX_MODE"   => array(),
    ),
);
