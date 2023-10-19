<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ОМС для бизнеса");
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "top",
        "EDIT_TEMPLATE" => ""
    )
);?>

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
            "HEADER" => "Получите бесплатную консультацию по инвестированиям в драгоценные металлы",
            "SUBHEADER" => "Если у Вас возникли вопросы, заполните форму, мы перезвоним и проконсультируем Вас.",
            "UTM" => "82",  //  Остались вопросы?
        ),
        false,
        array(
            "ACTIVE_COMPONENT" => "Y"
        )
    ); ?>
</div>

<div class="v21-section">
    <div class="v21-oms-container">
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
                "IBLOCK_ID" => "208",
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
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>