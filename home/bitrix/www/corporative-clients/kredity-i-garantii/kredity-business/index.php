<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "овердрафт с залогом, кредиты для бизнеса, покрытие кассовых разрывов, обеспечение кредита, поручительство, залог, процентная ставка, комиссия за выдачу кредита, Трансстройбанк"); ?>
<?
$APPLICATION->SetPageProperty("description", "Кредиты для бизнеса: овердрафт с залогом на покрытие кассовых разрывов в Трансстройбанке. Получите до 30% от кредитного оборота по расчетным счетам за последние 6 месяцев под индивидуальную процентную ставку. Обеспечение кредита - залог или поручительство. Комиссия за открытие лимита - 1%.");
$APPLICATION->SetPageProperty("title", "Овердрафт с залогом на покрытие кассовых разрывов: условия кредита и обеспечение | Трансстройбанк (АО)");
$APPLICATION->SetTitle("Кредиты для бизнеса");
?>
<?
use Bitrix\Main\Application;
$context = Application::getInstance()->getContext();
$request = $context->getRequest();
$request2 = Application::getInstance()->getContext()->getRequest();
$requestUri = $request->getRequestUri();
//$requestPage = $request2->getRequestedPage();
//debugg($requestPage);
?>
<?// debugg(1); ?>
<?// debugg($_REQUEST); ?>
<?// debugg($_REQUEST["SMART_FILTER_PATH"]); ?>

<?php/*?>
<div class="v21-section v21-section-kredity-business--header">
    <h1 class="v21-h1-new">Кредиты для бизнеса</h1>
</div>
<?php*/?>

<? global $USER;
//if ($USER->IsAdmin()):?> 

<? $APPLICATION->IncludeComponent(
	"bitrix:news", 
	"kredity-dlya-biznesa",
	//"",
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
			0 => "ID",
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
		"IBLOCK_ID" => "60",
		"IBLOCK_TYPE" => "corporative_clients",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "ID",
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
		"SEF_FOLDER" => "/corporative-clients/kredity-i-garantii/kredity-business/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
        "SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "kredity-dlya-biznesa",
		//"COMPONENT_TEMPLATE" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);
// URL страницы информационного блока: #SITE_DIR#/corporative-clients/kredity-i-garantii/kredity-dlya-biznesa/
// URL страницы раздела: #SITE_DIR#/corporative-clients/kredity-i-garantii/kredity-dlya-biznesa/#SECTION_CODE#/
// URL страницы детального просмотра: #SITE_DIR#/corporative-clients/kredity-i-garantii/kredity-dlya-biznesa/#ELEMENT_CODE#/
?>
<div class="v21-section v21-credit-application" id="businessCreditRequest">
    <?$APPLICATION->IncludeComponent(
        "webtu:feedback",
        //"credit_ul",
        "kredity_business",
        Array(
            "ADMIN_EVENT" => "WEBTU_FEEDBACK_CREDIT_UL",
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "COMPONENT_TEMPLATE" => "credit_ul",
            "EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
            "IBLOCK_ID" => "141",
            "PROPERTIES" => array("PHONE","CREDIT_SUMM","CREDIT_CURRENCY","NAME","EMAIL","ORGANIZATION","CREDIT_NAME","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
            //"PROPERTIES" => array("PHONE","CREDIT_SUMM","CREDIT_CURRENCY","FIO","EMAIL","ORGANIZATION","CREDIT_NAME"),
            "SITES" => array(0=>"s1",),
            "USER_EVENT" => "WEBTU_FEEDBACK_CREDIT_UL_USER",
            "UTM" => "118",
        )
    );?>
</div>

<?/* нет ответов?>
<div class="v21-section">
    <?$APPLICATION->IncludeComponent(
        "webtu:faq.block.add",
        "kredity-biznes",
        Array(
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "HIGHLOAD_IBLOCK_ID" => "3"
        )
    );?>
</div>
<?*/?>
<?/* else: ?> 
<h2>Страница в разработке</h2>
<? endif; */?> 

<?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true);?> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>