<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentParameters = array(
    "PARAMETERS" => array(
        "PRODUCT_ID" => Array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => Loc::getMessage('AMS_PRODUCT_ID'),
            "TYPE"    => "STRING",
            "DEFAULT" => '',
        ),
        "MIN_STEP" => Array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => Loc::getMessage('AMS_MIN_STEP'),
            "TYPE"    => "STRING",
            "DEFAULT" => '',
        ),
        "CAN_AUCTION_STEP" => Array(
            "PARENT"  => "DATA_SOURCE",
            "NAME"    => Loc::getMessage('AMS_CAN_AUCTION_STEP'),
            "TYPE"    => "STRING",
            "DEFAULT" => '',
        ),
        "AJAX_MODE"   => array()
    )
);	  
?>