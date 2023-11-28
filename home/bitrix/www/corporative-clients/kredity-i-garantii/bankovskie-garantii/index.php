<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (АО) предлагает своим клиентам воспользоваться следующими банковским гарантиями: выполнение обязательств по контракту, предложение или тендерная, в пользу таможенных органов и для туристических компаний");
$APPLICATION->SetPageProperty("keywords", "Банковские гарантии АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Банковские гарантии | КОРПОРАТИВНЫМ КЛИЕНТАМ | Трансстройбанк");
$APPLICATION->SetTitle("Банковские гарантии");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "how",
		"EDIT_TEMPLATE" => ""
	)
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"bankovskie-garantii",
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
			2 => "MAX_SUM",
			3 => "MAX_DATE",
			4 => "INTEREST_RATE",
			5 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FILE_404" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "63",
		"IBLOCK_TYPE" => "corporative-clients",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "ADD_INFO_BANK",
			1 => "ADD_INFO_SELF",
			2 => "MAX_SUM",
			3 => "MAX_DATE",
			4 => "INTEREST_RATE",
			5 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_FOLDER" => "/corporative-clients/kredity-i-garantii/bankovskie-garantii/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
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
		"COMPONENT_TEMPLATE" => "bankovskie-garantii",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
<div class="popup-form" id="guarantee">
	<?$APPLICATION->IncludeComponent(
		"webtu:feedback",
		"guarantee",
		Array(
			"ADMIN_EVENT" => "WEBTU_FEEDBACK_GUARANTEE_ADMIN",
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"IBLOCK_ID" => "36",
			"EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
			"POST_CALLBACK" => function($post){if(!empty($post['FIRST_NAME'])){$post['NAME']=$post['FIRST_NAME'];}return$post;},
            "PROPERTIES" => array("COMPANY_NAME","PHONE","EMAIL","CITY","SUM","CURRENT","DATE","PROVISION","TARGET","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
            "SITES" => array("s1"),
            "USER_EVENT" => "WEBTU_FEEDBACK_GUATANTEE_USER",
            "UTM" => "109",
		)
	);?>
</div>
 <?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true);?> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
