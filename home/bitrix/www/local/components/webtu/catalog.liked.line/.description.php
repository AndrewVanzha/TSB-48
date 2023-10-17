<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME"        => Loc::getMessage("CLL_NAME"),
	"DESCRIPTION" => Loc::getMessage("CLL_DESCRIPTION"),
	"ICON" => "/images/sale_account.gif",
	"SORT" => 10,
	"PATH" => array(
		"ID"   => "WEBTU",
		"NAME" => Loc::getMessage("WEBTU_PATH_ADDITIONAL"),
		"CHILD" => array(
			"ID" => "liked",
			"NAME" => GetMessage("LIKED_PATH_ADDITIONAL"),
			"SORT" => 10,
   			"CHILD" => array(
				"ID" => "liked_cmpx",
			),
		),
	)
); 
?>