<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$use_captcha = array(
	"Y"=>Loc::getMessage("CAG_USE_CAPTCHA_YES"),
	"N"=>Loc::getMessage("CAG_USE_CAPTCHA_NONE"),
);

$arComponentParameters = array(
    "PARAMETERS" => array(
		"USE_CAPTCHA"=>Array(
			"PARENT" => "DATA_SOURCE",
			"NAME"   => Loc::getMessage("CAG_USE_CAPTCHA"),
			"TYPE"=>"LIST",
            "VALUES" => $use_captcha,
			"DEFAULT" => "",
		),
        "AJAX_MODE"   => array()
    )
);	  
?>