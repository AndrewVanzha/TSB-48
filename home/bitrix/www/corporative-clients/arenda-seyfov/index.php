<?
use Bitrix\Main\Page\Asset;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (АО) предоставляет в аренду юридическим лицам и корпоративным клиентам банковские сейфы различных размеров для хранения ценных бумаг, документов, ювелирных изделий, произведений искусства и других ценностей, а также для проведения расчетов по сделкам купли-продажи недвижимости.");
$APPLICATION->SetPageProperty("keywords", "Аренда сейфов для корпоративных клиентов");
$APPLICATION->SetPageProperty("title", "Аренда индивидуальных сейфов | Корпоративным клиентам | Трансстройбанк");
$APPLICATION->SetTitle("Аренда банковской ячейки для бизнеса");
Asset::getInstance()->addCss("/corporative-clients/arenda-seyfov/style.css");
?>
<??>
    <style>
        .v21 {
            overflow: hidden;
        }
        /*.v21 .v21-container.v21-container--header {
            position: relative;
            z-index: 0;
        }*/
        .v21 .v21-wide-container {
            overflow: visible;
        }
    </style>
<??>
<div class="safes-page__background-blue safes-page__background-time"></div>

<h1 class="v21-safes-page--header">Аренда сейфов в банке для бизнеса</h1>

<? $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "top",
		"EDIT_TEMPLATE" => ""
	)
); ?>

<div class="v21-section">
	<h2 class="v21-safes-page--subheader">Стоимость аренды банковских ячеек</h2>
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"v21_safes",
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
			"IBLOCK_ID" => "121",
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
			"PAGER_TITLE" => "Сейфы",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "ATT_SIZE",
				1 => "HIDE_PRICE",
				2 => "PRICE_TO_30",
				3 => "PRICE_TO_365",
				4 => "PRICE_TO_60",
				5 => "PRICE_TO_90",
				6 => "PRICE_TO_180",
				7 => "",
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
			"COMPONENT_TEMPLATE" => ".default",
			//"UTM_SOURCE" => "no_data",
			//"UTM_MEDIUM" => "no_data",
			//"UTM_CAMPAIGN" => "no_data",
			//"UTM_TERM" => "no_data",
			//"UTM_CONTENT" => "no_data"
		),
		false
	); ?>

	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "info",
			"EDIT_TEMPLATE" => ""
		)
	); ?>
</div><!-- /.v21-section -->

<div class="v21-safes-wide-container">
    <div class="v21-card-application" id="fSafesForm">
        <? $APPLICATION->IncludeComponent(
            "webtu:feedback",
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
                /*"POST_CALLBACK" => function ($post) {
                    if (!isset($post['CITYZENSHIP'])) {
                        $post['CITYZENSHIP'] = 'Нет';
                    } else {
                        $post['CITYZENSHIP'] = 'Да';
                    }
                    return $post;
                },*/
                "PROPERTIES" => array(
                    "ORGANIZATION",
                    "PHONE",
                    "EMAIL",
                    //"CITY",
                    "TYPE",
                    //"CITYZENSHIP",
                    "FROM_WHERE",
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

        ); ?>
    </div>
</div>

<? $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "advantages",
		"EDIT_TEMPLATE" => ""
	)
); ?>

<div class="v21-section-safes-consult">
        <? $APPLICATION->IncludeComponent(
            "webtu:feedback",
            "v21_consult_fiz",
            array(
                "AJAX_MODE" => "Y",
                "COMPONENT_TEMPLATE" => "v21_consult_fiz",
                "IBLOCK_ID" => "5",
                "PROPERTIES" => array(
                    "PHONE",
                    "EMAIL",
                    "FOLDER",
                    "NAME",
                    "REQ_URI",
                    "UTM_SOURCE",
                    "UTM_MEDIUM",
                    "UTM_CAMPAIGN",
                    "UTM_TERM",
                    "UTM_CONTENT"
                ),
                "ADMIN_EVENT" => "WEBTU_FEEDBACK_QUESTION",
                "USER_EVENT" => "NONE",
                "SITES" => array(
                    0 => "s1",
                ),
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "FOLDER" => $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"],
                "HEADER" => "Получите бесплатную консультацию по аренде сейфа в Трансстройбанке",
                "SUBHEADER" => "Если у Вас возникли вопросы, заполните форму, мы перезвоним и проконсультируем Вас",
                "UTM" => "82",  //  Остались вопросы?
            ),
            false,
            array(
                "ACTIVE_COMPONENT" => "Y"
            )
        ); ?>
</div>

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
		"IBLOCK_ID" => "119",
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
		"UTM_SOURCE" => "no_data",
		"UTM_MEDIUM" => "no_data",
		"UTM_CAMPAIGN" => "no_data",
		"UTM_TERM" => "no_data",
		"UTM_CONTENT" => "no_data"
	),
	false
); ?>
<?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true);
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>