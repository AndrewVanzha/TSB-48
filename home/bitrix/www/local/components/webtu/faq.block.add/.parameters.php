<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Loader;

if (!Loader::includeModule("iblock")){ return; }
if (!Loader::includeModule("highloadblock")){ return; }

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

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
        /*"OFFICE_IBLOCK_ID" => array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => "Инфоблок с офисами",
            "TYPE"    => "LIST",
            "VALUES"  => $iblocks,
            "REFRESH" => "Y",
        ),*/
        "HIGHLOAD_IBLOCK_ID" => array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => "highload-блоки с вопросами-ответами",
            "TYPE"    => "LIST",
            "VALUES"  => array("4", "5"),
            "REFRESH" => "Y",
        ),
        "CACHE_TIME"   => array("DEFAULT"=>36000000),
    ),
);
