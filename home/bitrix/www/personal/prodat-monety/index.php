<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Продать монеты");

global $USER;
if (!$USER->IsAuthorized()) {
    LocalRedirect('/login/');
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personal_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "personal_menu",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "personal_menu",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "personal_menu"
	),
	false
);?>
<? /*--- Форма добавления монеты ---*/ ?> <?$APPLICATION->IncludeComponent(
	"webtu:catalog.add.good",
	"",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"USE_CAPTCHA" => "N"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>