<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Loader;
if (!Loader::includeModule("iblock")){ return; }
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

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_ID" => array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => "Инфоблок",
            "TYPE"    => "LIST",
            "VALUES"  => $iblocks,
        ),
        "CACHE_TIME"   => array("DEFAULT"=>36000000),
        "AJAX_MODE"   => array(),
    ),
);
