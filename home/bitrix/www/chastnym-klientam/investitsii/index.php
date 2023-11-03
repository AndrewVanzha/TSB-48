<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Персонально работаем с каждым клиентом, оцениваем риски и доходность вложения инвестиций в ценные бумаги и металлы. Ведём счета депо, ИИС, помогаем с налогами.");
$APPLICATION->SetPageProperty("keywords", "Котировки, Золотые, слитки, драгоценных, металлов, ЗОЛОТО.");
$APPLICATION->SetPageProperty("title", "Личные инвестиции | Трансстройбанк");
$APPLICATION->SetTitle("Инвестиции");
?>

<h1 class="v21-h1-new">Инвестиции для физических лиц</h1>

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
</div>

<div class="v21-section">
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"v21_invest",
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
				0 => "DETAIL_TEXT",
				1 => "",
			),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "49",
			"IBLOCK_TYPE" => "-",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "1000",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Программы ипотеки",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "INTEREST_RATE",
				1 => "DEPOSIT_TERM",
				2 => "MIN_SUMM",
				3 => "DOCS",
				4 => "",
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

<? $APPLICATION->IncludeComponent(
	"webtu:feedback",
	"v21_deposit_fiz",
	array(
		"ADMIN_EVENT" => "WEBTU_FEEDBACK_DEPOSIT_ADMINISTRATOR",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"IBLOCK_ID" => "32",
        "PROPERTIES" => array("BIRTHDATE", "SEX", "PHONE", "EMAIL", "CITY", "CITYZENSHIP", "CURRENCY", "SUM", "CREDIT_NAME","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
		"SITES" => array("s1"),
		"USER_EVENT" => "WEBTU_FEEDBACK_DEPOSIT_USER",
		"EVENT_CALLBACK" => function ($post) {
			if ($post['SEX'] == 'Мужской') {
				$post['RECOURSE'] = 'Уважаемый';
			} else {
				$post['RECOURSE'] = 'Уважаемая';
			}
			return $post;
		},
		"POST_CALLBACK" => function ($post) {
			if (!isset($post['CITYZENSHIP'])) {
				$post['CITYZENSHIP'] = 'Нет';
			} else {
				$post['CITYZENSHIP'] = 'Да';
			}
			if (!empty($post['FIRST_NAME'])) {
				$post['NAME'] = $post['LAST_NAME'] . ' ' . $post['FIRST_NAME'] . ' ' . $post['SECOND_NAME'];
			}
			return $post;
		},
        "UTM" => "100",

	)
); ?>
<?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>