<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");  // 301 redirect
$APPLICATION->SetPageProperty("description", "Карточные продукты корпоративным клиентам от АКБ «ТрансСтройБанк» — идеальное средство организации и контроля оплаты командировочных, представительских и хозяйственных расходов сотрудников Вашей компании, а также удобный и законный способ подтверждения расходов, связанных с коммерческой деятельностью, для индивидуальных предпринимателей.");
$APPLICATION->SetPageProperty("keywords", "Карточные продукты корпоративным клиентам");
$APPLICATION->SetPageProperty("title", "Карточные продукты | КОРПОРАТИВНЫМ КЛИЕНТАМ | Трансстройбанк");
$APPLICATION->SetTitle("Cards for Business");
?>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "top",
		"EDIT_TEMPLATE" => ""
	)
);*/?>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"corp-karty", 
	array(
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
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "169",
		"IBLOCK_TYPE" => "en",
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
		"PROPERTY_CODE" => array(
			0 => "ATT_URL",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "corp-karty"
	),
	false
);*/?>
<?/*?>
<div class="popup-form" id="vaultRequest">
	 <?$APPLICATION->IncludeComponent(
	"webtu:feedback",
	"card",
	Array(
		"ADMIN_EVENT" => "WEBTU_FEEDBACK_CARD_ADMIN",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
		"IBLOCK_ID" => "11",
		"POST_CALLBACK" => function($post){if(!isset($post['CITYZENSHIP'])){$post['CITYZENSHIP']='Нет';}else{$post['CITYZENSHIP']='Да';}if(!empty($post['FIRST_NAME'])){$post['NAME']=$post['LAST_NAME'].' '.$post['FIRST_NAME'].' '.$post['SECOND_NAME'];}return$post;},
		"PROPERTIES" => array("BIRTHDATE","SEX","PHONE","EMAIL","CITY","CITYZENSHIP","TYPE","CARD_SUMM","CARD_CURRENCY"),
		"SITES" => array("s1"),
		"USER_EVENT" => "WEBTU_FEEDBACK_CARD_USER"
	)
);?>
</div>
<?*/?>
<?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
