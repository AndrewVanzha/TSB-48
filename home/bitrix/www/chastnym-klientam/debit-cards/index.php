<?
use Bitrix\Main\Page\Asset;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Кэшбэк только рублями. Проценты на остаток. Бесплатная доставка. Пополнение карты без комиссии через сервисы Банка и другие премиальные услуги от платёжных систем.");
$APPLICATION->SetPageProperty("keywords", "Дебетовые карты | АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Дебетовые карты");
$APPLICATION->SetTitle("Дебетовые карты");
Asset::getInstance()->addCss("/chastnym-klientam/debit-cards/style.css");
?>
<h1 class="v21-h1-new v21-debitcards--header">Дебетовые карты</h1>

<div class="v21-section">
	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "intro",
			"EDIT_TEMPLATE" => ""
		)
	); ?>
</div><!-- /.v21-section -->

<div class="v21-section">
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"v21_cards",
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
				0 => "DETAIL_PICTURE",
				1 => "",
			),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "21",
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
				0 => "DESCRIPTION",
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
			"COMPONENT_TEMPLATE" => ".default",
			"UTM_SOURCE" => "no_data",
			"UTM_MEDIUM" => "no_data",
			"UTM_CAMPAIGN" => "no_data",
			"UTM_TERM" => "no_data",
			"UTM_CONTENT" => "no_data"
		),
		false
	); ?>
</div><!-- /.v21-section -->

<div class="v21-section">
	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "cash",
			"EDIT_TEMPLATE" => ""
		)
	); ?>
</div><!-- /.v21-section -->

<div class="v21-section">
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"v21_ad_units",
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
			"IBLOCK_ID" => "195",
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
				0 => "TITLE",
				1 => "IMAGE_LOCATION",
				2 => "FULL_DESCRIPTION",
				3 => "LINKS",
				4 => "ICONS_LINKS",
				5 => "ICONS_SIZE",
				6 => "",
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
			"UTM_SOURCE" => "no_data",
			"UTM_MEDIUM" => "no_data",
			"UTM_CAMPAIGN" => "no_data",
			"UTM_TERM" => "no_data",
			"UTM_CONTENT" => "no_data",

			"ADDITIONAL_IBLOCK_ID" => "194",
		),
		false
	); ?>
</div><!-- /.v21-section -->

    <script>
        $(document).ready(function () {
            $('.js-fDebitCardTariffs').on('click', function() {
                let href = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $(href).offset().top - 120
                }, {
                    duration: 800,   // по умолчанию «400»
                    easing: "linear" // по умолчанию «swing»
                });
                return false;
            });
        });
    </script>

<div id="fDebitCardTariffs" class="v21-section">
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
		"IBLOCK_ID" => "196",
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
		"COMPONENT_TEMPLATE" => ".default",
		"UTM_SOURCE" => "no_data",
		"UTM_MEDIUM" => "no_data",
		"UTM_CAMPAIGN" => "no_data",
		"UTM_TERM" => "no_data",
		"UTM_CONTENT" => "no_data",
		"DOC_OUTPUT_LINK_HTML" => "Y", // выбираю только документ с наличием "22.04.2022" в названии
		"DOC_OUTPUT_LINK_HTML_PATTERN" => "22.04.2022",
	),
	false
); ?>
</div>

<? $APPLICATION->IncludeComponent(
	"webtu:feedback",
	"v21_card",
	array(
		"ADMIN_EVENT" => "WEBTU_FEEDBACK_CARD_ADMIN",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"EVENT_CALLBACK" => function ($post) {
			if ($post['SEX'] == 'Мужской') {
				$post['RECOURSE'] = 'Уважаемый';
			} else {
				$post['RECOURSE'] = 'Уважаемая';
			}
			return $post;
		},
		"IBLOCK_ID" => "11",
		"POST_CALLBACK" => function ($post) {
			if (!isset($post['DELIVERYCARD'])) {
				$post['DELIVERYCARD'] = 'Нет';
			} else {
				$post['DELIVERYCARD'] = 'Да';
			}
			if (!isset($post['CITYZENSHIP'])) {
				$post['CITYZENSHIP'] = 'Нет';
			} else {
				$post['CITYZENSHIP'] = 'Да';
			}
			if (!empty($post['PASS_ADDR_S'])) {
				$post['PASS_ADDR_F'] = $post['PASS_ADDR_R'];
			}
			if (!empty($post['TYPE_INOY'])) {
				$post['TYPE_PASS'] = $post['TYPE_INOY'];
			}
			if (!empty($post['FIRST_NAME'])) {
				$post['NAME'] = $post['LAST_NAME'] . ' ' . $post['FIRST_NAME'] . ' ' . $post['SECOND_NAME'];
			}
			return $post;
		},
        "PROPERTIES" => array(
            "BIRTHDATE",
            "SEX",
            "PHONE",
            "EMAIL",
            "CITY",
            "CITYZENSHIP",
            "TYPE",
            "TRANSLIT",
            "CARD_SUMM",
            "CARD_CURRENCY",
            //"DELIVERYCARD",
            "DELIVERY",
            "DELIVERY_ADDRESS",
            "TYPE_PASS",
            "TYPE_INOY",
            "PASS_SERIYA",
            "PASS_NUMBER",
            "PASS_KEM",
            "PASS_DATA",
            "PASS_COD",
            "PASS_MESTO",
            "PASS_ADDR_R",
            "PASS_ADDR_F",
            "PASS_ADDR_S",
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
		"USER_EVENT" => "WEBTU_FEEDBACK_CARD_USER",
		"SHOW_DEBETS_CARDS" => "Y",
        "UTM" => "86",
	)
); ?>
<?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true);
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>