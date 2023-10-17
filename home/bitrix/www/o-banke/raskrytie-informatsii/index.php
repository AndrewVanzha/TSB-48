<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Раскрытие регуляторной информации состава и характеристики инструментов собственных средств (капитала), представляющих структуру основного и дополнительного капитала АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("keywords", "Раскрытие информации АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Раскрытие регуляторной информации | Раскрытие информации | О БАНКЕ | Трансстройбанк");
$APPLICATION->SetTitle("Раскрытие информации для регулятивных целей");
?>
<?
//global $USER;
//$temp = "";
//if($USER->GetID() == 6) {
	$temp = "czgroup";
//}
?>
<?$APPLICATION->IncludeComponent(
	"webtu:information.disclosure",
	$temp,
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "26"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>