<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Таможенные карты АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("description", "Устали от долгих и изнурительных процессов оплаты таможенных платежей?   Услуга «Таможенная карта» избавит вас от проблем! С таможенной картой процедура таможенного оформления становится простой и удобной");
$APPLICATION->SetPageProperty("title", "Таможенная карта | Карточные продукты | КОРПОРАТИВНЫМ КЛИЕНТАМ | Трансстройбанк");
$APPLICATION->SetTitle("Таможенные карты МИР");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "how",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"tamozhennye-card", 
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "ADD_INFO_BANK",
			1 => "ADD_INFO_SELF",
			2 => "PRICE",
			3 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "82",
		"IBLOCK_TYPE" => "corporative_clients",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "ADD_INFO_BANK",
			1 => "ADD_INFO_SELF",
			2 => "PRICE",
			3 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "200",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
        //"SEF_FOLDER" => "/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/tamozhennye-karty/",
        "SEF_FOLDER" => "/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/tamozhennaya-karta-mir/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "tamozhennye-card",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
<div class="popup-form" id="cardUlRequest">
	 <?$APPLICATION->IncludeComponent(
	"webtu:feedback",
	"card_ul",
	Array(
		"ADMIN_EVENT" => "WEBTU_FEEDBACK_CARD_UL_ADMIN",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
		"IBLOCK_ID" => "142",
		"PROPERTIES" => array("ORGANIZATION","NAME","PHONE","EMAIL","CITY", "TYPE"),
		"SITES" => array("s1"),
		"USER_EVENT" => "WEBTU_FEEDBACK_CARD_UL_USER",
        "CARD_OPTION" => "Таможенная карта МИР"
	)
);?>
</div>
 <?
	//Отображаем форму в футере
	\GarbageStorage::set('feedback', true);?> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>