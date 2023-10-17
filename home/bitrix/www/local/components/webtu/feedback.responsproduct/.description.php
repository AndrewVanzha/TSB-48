<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME"        => Loc::getMessage("FRP_NAME"),
	"DESCRIPTION" => Loc::getMessage("FRP_DESCRIPTION"),
	"ICON" => "/images/sale_account.gif",
	"SORT" => 50,
	"PATH" => array(
		"ID"   => "WEBTU",
		"NAME" => Loc::getMessage("WEBTU_PATH_ADDITIONAL"),
		"CHILD" => array(
			"ID" => "fb",
			"NAME" => GetMessage("FB_PATH_ADDITIONAL"),
			"SORT" => 10,
   			"CHILD" => array(
				"ID" => "fb_cmpx",
			),
		),
	)
); 
?>