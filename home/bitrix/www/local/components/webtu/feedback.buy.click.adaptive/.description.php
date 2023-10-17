<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME"        => Loc::getMessage("FBKA_NAME"),
	"DESCRIPTION" => Loc::getMessage("FBKA_DESCRIPTION"),
	"ICON" => "/images/sale_account.gif",
	"SORT" => 20,
	"PATH" => array(
		"ID"   => "WEBTU",
		"NAME" => Loc::getMessage("WEBTU_PATH_ADDITIONAL"),
		"CHILD" => array(
			"ID" => "fba",
			"NAME" => GetMessage("FBA_PATH_ADDITIONAL"),
			"SORT" => 10,
   			"CHILD" => array(
				"ID" => "fba_cmpx",
			),
		),
	)
); 
?>