<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (АО) предлагает Вам воспользоваться современным и удобным платежным средством - банковской картой, заменяющей наличные денежные расчеты и открывающей дополнительные возможности по приобретению товаров и услуг.");
$APPLICATION->SetPageProperty("keywords", "Банковские карты | АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Банковские карты | ЧАСТНЫМ ЛИЦАМ | Трансстройбанк");
$APPLICATION->SetTitle("Банковские карты");
?><?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"card", 
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
			2 => "PAY_SYSTEM",
			3 => "PRICE",
			4 => "TYPE",
			5 => "LIMIT",
			6 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "21",
		"IBLOCK_TYPE" => "private_clients",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "ADD_INFO_BANK",
			1 => "ADD_INFO_SELF",
			2 => "PAY_SYSTEM",
			3 => "PRICE",
			4 => "TYPE",
			5 => "LIMIT",
			6 => "",
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
		"SEF_FOLDER" => "/chastnym-klientam/bankovskie-karty/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
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
		"COMPONENT_TEMPLATE" => "card",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>

<?/*$APPLICATION->IncludeComponent(
    "webtu:subscribe",
    ".default",
    array(
        "AJAX_MODE" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "RUBRIC" => array(
            0 => "1",
        ),
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);*/?>

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
            "EVENT_CALLBACK" => function($post){if($post['SEX']=='Мужской'){$post['RECOURSE']='Уважаемый';}else{$post['RECOURSE']='Уважаемая';}return$post;},
            "IBLOCK_ID" => "11",
            "POST_CALLBACK" => function($post){if(!isset($post['DELIVERYCARD'])){$post['DELIVERYCARD']='Нет';}else{$post['DELIVERYCARD']='Да';}if(!isset($post['CITYZENSHIP'])){$post['CITYZENSHIP']='Нет';}else{$post['CITYZENSHIP']='Да';}if(!empty($post['PASS_ADDR_S'])){$post['PASS_ADDR_F']=$post['PASS_ADDR_R'];}if(!empty($post['TYPE_INOY'])){$post['TYPE_PASS']=$post['TYPE_INOY'];}if(!empty($post['FIRST_NAME'])){$post['NAME']=$post['LAST_NAME'].' '.$post['FIRST_NAME'].' '.$post['SECOND_NAME'];}return$post;},
            "PROPERTIES" => array("BIRTHDATE","SEX","PHONE","EMAIL","CITY","CITYZENSHIP","TYPE","TRANSLIT","CARD_SUMM","CARD_CURRENCY", "DELIVERYCARD", "TYPE_PASS", "TYPE_INOY", "PASS_SERIYA", "PASS_NUMBER", "PASS_KEM", "PASS_DATA", "PASS_COD", "PASS_MESTO", "PASS_ADDR_R", "PASS_ADDR_F", "PASS_ADDR_S"),
            "SITES" => array("s1"),
            "USER_EVENT" => "WEBTU_FEEDBACK_CARD_USER"
        )
    );?>
</div>
<?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true);
?>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
