<?
use Bitrix\Main\Page\Asset;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Таможенные карты АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("description", "Устали от долгих и изнурительных процессов оплаты таможенных платежей?   Услуга «Таможенная карта» избавит вас от проблем! С таможенной картой процедура таможенного оформления становится простой и удобной");
$APPLICATION->SetPageProperty("title", "Таможенная карта | Карточные продукты | КОРПОРАТИВНЫМ КЛИЕНТАМ | Трансстройбанк");
$APPLICATION->SetTitle("Таможенные карты МИР");
Asset::getInstance()->addCss("/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/tamozhennaya-karta-mir/style.css");
?>
<??>
    <style>
        .v21 {
            overflow: hidden;
        }
        .v21 .v21-wide-container {
            overflow: visible;
        }
        .v21 .js-color-switch .v21-block-interests--left,
        .v21 .js-color-switch .v21-block-interests--right {
            background-color: transparent;
            box-shadow: none;
        }
        .v21 .js-color-switch .v21-block-interests--right::before,
        .v21 .js-color-switch .v21-block-interests--left::before {
            content: none;
        }
    </style>
<??>
<div class="corpcards-page__background-blue corpcards-page__background-time"></div>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "block_top",
        "EDIT_TEMPLATE" => ""
    )
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "block_1",
        "EDIT_TEMPLATE" => ""
    )
);?>
<div class="v21-section v21-block-advantages">
    <?$APPLICATION->IncludeComponent(
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
</div>
<!--/div-->
<div class="v21-corpcards-wide-container">
    <div class="v21-card-application" id="fCustomsCardForm">
        <?$APPLICATION->IncludeComponent(
            "webtu:feedback",
            "card_ul_new",
            Array(
                "ADMIN_EVENT" => "WEBTU_FEEDBACK_CARD_UL_ADMIN",
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "EVENT_CALLBACK" => function($post){ $post['RECOURSE']='Уважаемый(ая)'; return $post; },
                "IBLOCK_ID" => "142",
                "PROPERTIES" => array(
                    "ORGANIZATION",
                    "COMPANY_INN",
                    "FIO",
                    "NAME",
                    "PHONE",
                    "EMAIL",
                    "CITY",
                    "TYPE",
                    "FOLDER",
                    "REQ_URI",
                    "FROM_WHERE",
                    "UTM_SOURCE",
                    "UTM_MEDIUM",
                    "UTM_CAMPAIGN",
                    "UTM_TERM",
                    "UTM_CONTENT"
                ),
                "SITES" => array("s1"),
                "USER_EVENT" => "WEBTU_FEEDBACK_CARD_UL_USER",
                "CARD_OPTION" => "Таможенная карта МИР",
                "UTM" => "121",
            )
        );?>

        <?/* $APPLICATION->IncludeComponent(
        "webtu:feedback",
        //"safes_fl",
        "safes_bus",
        array(
            "ADMIN_EVENT" => "WEBTU_FEEDBACK_SAFES_UL_ADMIN",
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "COMPONENT_TEMPLATE" => "safes_bus",
            //"EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
            "EVENT_CALLBACK" => function ($post) {
                if ($post['SEX'] == 'Мужской') {
                    $post['RECOURSE'] = 'Уважаемый';
                } else {
                    $post['RECOURSE'] = 'Уважаемый(ая)';
                }
                if (!empty($post['TIME'])) {
                    if ($post['TIME'] > 1) {
                        $post['MONTH'] = 'месяцев';
                    } else {
                        $post['MONTH'] = 'месяц';
                    }
                }
                return $post;
            },
            "IBLOCK_ID" => "143",
            "PROPERTIES" => array(
                "ORGANIZATION",
                "PHONE",
                "EMAIL",
                //"CITY",
                "TYPE",
                //"CITYZENSHIP",
                //"PRICE",
                "TIME",
                "OPTIONS",
                "FIO",
                "NAME",
                "FOLDER",
                "REQ_URI",
                "UTM_SOURCE",
                "UTM_MEDIUM",
                "UTM_CAMPAIGN",
                "UTM_TERM",
                "UTM_CONTENT"
            ),
            "SITES" => array(0 => "s1",),
            "USER_EVENT" => "WEBTU_FEEDBACK_SAFES_UL_USER",
            "UTM" => "122",
        )

    );*/ ?>

    </div>
</div>

<div class="v21-corpcards-popproducts--top">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "page",
            "AREA_FILE_SUFFIX" => "block_bottom",
            "EDIT_TEMPLATE" => ""
        )
    );?>
</div>

<!--div class="v21-section v21-scheta-section-documents">
    <div class="v21-container"-->

<div id="fBusinessCardTariffs" class="v21-corpcards--tariffs js-fCustomsCardTariffs">
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "v21_safes_docs",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
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
            "IBLOCK_ID" => "81",
            "IBLOCK_TYPE" => "-",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Документы",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "FILE",
                1 => "",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "v21_safes_docs",
        ),
        false
    ); ?>
</div>

<?/*?>
<?$APPLICATION->IncludeComponent(
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
	\GarbageStorage::set('feedback', true);?> <br>
<?*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>