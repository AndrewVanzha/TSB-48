<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if(in_array('Залог или поручитель', $_REQUEST['PROPERTIES'])) $GLOBALS['arrFilter']["PROPERTY_ATT_DEPOSIT_VALUE"]='Да';
if(in_array('Готов застраховаться', $_REQUEST['PROPERTIES'])) $GLOBALS['arrFilter']["PROPERTY_ATT_INSURE_VALUE"]='Да';
if(in_array('Зарплатный клиент', $_REQUEST['PROPERTIES'])) $GLOBALS['arrFilter']["PROPERTY_ATT_SALARY_VALUE"]='Да';


$GLOBALS['arrFilter'][">PROPERTY_MAX_SUM"]=$_REQUEST['SUM'];
$GLOBALS['arrFilter'][">PROPERTY_MAX_DATE"]=$_REQUEST['DATE'];

$GLOBALS['arrFilter']["PROPERTY_ATT_CURRENCY_VALUE"]=$_REQUEST['CURRENCY'];


?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"credit_recommend",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("", ""),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "42",
		"IBLOCK_TYPE" => "private_clients",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("", "MAX_SUM", "MAX_DATE", "RECOMMEND", "ATT_RECOMMEND", "INTEREST_RATE", ""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
