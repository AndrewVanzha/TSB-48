<?
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Система быстрых платежей АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("description", "Система быстрых платежей - Быстрые платежи!");
$APPLICATION->SetPageProperty("title", "СБП | Система быстрых платежей | КОРПОРАТИВНЫМ КЛИЕНТАМ | Трансстройбанк");
$APPLICATION->SetTitle("Прием СБП-платежей");
Asset::getInstance()->addCss("/corporative-clients/priem-sbp-platezhey/style.css");
?>
<??>
    <style>
        .v21 {
            overflow: hidden;
        }
        .v21 .v21-container.v21-container--header {
            position: relative;
            z-index: 0;
        }
        .v21 .v21-wide-container {
            overflow: visible;
        }
        .v21 .js-color-switch .v21-block-interests--left,
        .v21 .js-color-switch .v21-block-interests--right {
            background-color: transparent;
            box-shadow: none;
        }
        .v21 .js-color-switch .v21-sbp-interests--right::before,
        .v21 .js-color-switch .v21-sbp-interests--left::before {
            content: none;
        }
    </style>
<??>
    <div class="sbp-page__background-blue sbp-page__background-time"></div>

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
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "block_2",
        "EDIT_TEMPLATE" => ""
    )
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "block_3",
        "EDIT_TEMPLATE" => ""
    )
);?>

        </div><!-- v21-container -->
    </div><!-- v21-section -->

    <div class="v21-wide-container v21-sbp-wide-container">
        <div class="v21-card-application" id="fSBPForm">
            <div class="v21-container">
                <?$APPLICATION->IncludeComponent(
                    "webtu:feedback",
                    //"acquiring",
                    "qr_podkluch",
                    Array(
                        "ADMIN_EVENT" => "WEBTU_FEEDBACK_SBP_ADMIN",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "COMPONENT_TEMPLATE" => "qr_podkluch",
                        "EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
                        "IBLOCK_ID" => "217",  // Заявка на подключение приема платежей по QR кодам
                        "PROPERTIES" => array("PHONE","ORGANIZATION","COMPANY_NAME","COMPANY_INN","FIO","EMAIL","CITY","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
                        "SITES" => array(0=>"s1",),
                        "USER_EVENT" => "WEBTU_FEEDBACK_SBP_USER",
                        "UTM" => "158",
                    )
                );?>
            </div>
        </div>
    </div>

    <div class="v21-section v21-sbp-popproducts--top">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "page",
                "AREA_FILE_SUFFIX" => "block_bottom",
                "EDIT_TEMPLATE" => ""
            )
        );?>
    <div class="v21-section v21-sbp-section-documents">
    <div class="v21-container">
        <section class="eq-docs">
            <h2 class="eq-docs__title page-title">Документы</h2>
            <div class="eq-docs__list">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.detail",
                        "documents-type-1",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_ELEMENT_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BROWSER_TITLE" => "-",
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
                            "ELEMENT_CODE" => "",
                            "ELEMENT_ID" => "10674", // Документы по СБП
                            "FIELD_CODE" => array("", ""),
                            "IBLOCK_ID" => "189",
                            "IBLOCK_TYPE" => "ls_documents",
                            "IBLOCK_URL" => "",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "MESSAGE_404" => "",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Страница",
                            "PROPERTY_CODE" => array("", "DOCUMENTS", "CLASSES"),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_CANONICAL_URL" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "STRICT_SECTION_CHECK" => "N",
                            "USE_PERMISSIONS" => "N",
                            "USE_SHARE" => "N"
                        )
                    );?>
            </div>
            <div class="v21-more v21-more--side">
                <a href="/arkhiv-tarifov-i-dokumentov/sbp/" class="archive-section" target="_blank">
                    <span>Архив документов </span>
                    <svg class="archive-section__arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                        <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                    </svg>
                </a>
            </div>
        </section>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

