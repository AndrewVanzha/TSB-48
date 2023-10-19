<?
use Bitrix\Main\Page\Asset;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "АКБ «ТрансСтройБанк» предлагает своим клиентам услуги по подключению и выпуску корпоративных карт. Все операции с использованием корпоративных карт Вы можете проводить везде, где принимаются платежные карты VISA, в режиме 24х7х365. Оплата осуществляется непосредственно со счета Вашей организации.");
$APPLICATION->SetPageProperty("keywords", "Корпоративные карты АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Корпоративные карты | Карточные продукты | КОРПОРАТИВНЫМ КЛИЕНТАМ | Трансстройбанк");
$APPLICATION->SetTitle("Corporate Cards");
Asset::getInstance()->addCss("/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/karty-dlya-biznesa/style.css");
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

<div class="corporative-card">
    <h1 class="corporative-card__header">Корпоративная карта</h1>
    <h3 class="corporative-card__content">Банковская карта, привязанная к счету компании</h3>
</div>

<div class="v21-section">
    <?$APPLICATION->IncludeComponent(
        "bitrix:news",
        "corporative_card_new",
        array(
            "ADD_ELEMENT_CHAIN" => "N",  // Включать название элемента в цепочку навигации
            "ADD_SECTIONS_CHAIN" => "N", // Включать раздел в цепочку навигации
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
                2 => "LIMIT",
                3 => "PAY_SYSTEM",
                4 => "PRICE",
                5 => "TYPE",
                6 => "",
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
            "IBLOCK_ID" => "24",
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
                2 => "LIMIT",
                3 => "PAY_SYSTEM",
                4 => "PRICE",
                5 => "TYPE",
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
            "SEF_FOLDER" => "/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/karty-dlya-biznesa/",
            "SEF_MODE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_STATUS_404" => "Y",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
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
            "COMPONENT_TEMPLATE" => "corporative_card",
            "SEF_URL_TEMPLATES" => array(
                "news" => "",
                "section" => "",
                "detail" => "#ELEMENT_CODE#/",
            )
        ),
        false
    );?>
<!--/div-->

<div class="v21-corpcards-wide-container">
    <div class="v21-card-application" id="fBusinessCardForm">
        <?$APPLICATION->IncludeComponent(
            "webtu:feedback",
            //"card_ul",
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
                "CARD_OPTION" => "Корпоративная карта",
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

<div id="fBusinessCardTariffs" class="v21-corpcards--tariffs js-fBusinessCardTariffs">
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
            "IBLOCK_ID" => "25",
            /*"IBLOCK_ID" => "119",*/
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
<div class="popup-form" id="cardUlRequest">
</div>
 <?
	//Отображаем форму в футере
	\GarbageStorage::set('feedback', true);?> <br>
<?*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
