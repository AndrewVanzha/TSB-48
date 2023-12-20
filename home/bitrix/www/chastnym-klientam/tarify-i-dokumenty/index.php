<?
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тарифы и документы");
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (АО), в соответствии с требованиями законодательства РФ, осуществляет банковскую деятельность. В Банке работают опытные, квалифицированные специалисты, которые помогут быстро решить все проблемы, связанные с проведением платежей.");
$APPLICATION->SetPageProperty("keywords", "тарифы, документы, клиенты, ТрансСтройБанк");
Asset::getInstance()->addCss("/chastnym-klientam/tarify-i-dokumenty/style.css");
?>
<section class="v21-section v21-tarifdok">
    <div class="v21-container">
        <h1 class="v21-tarifdok-page--header">Тарифы и документы для физических лиц</h1>
        <div class="row">
            <div class="rko-doc__block rko-doc__rate col-md-4">
                <header class="rko-doc__header">
                    <div class="rko-doc__title">Тарифы</div>
                </header>
                <div class="rko-doc__items">
                    <?$iblock_id = "189";  // По страницам ?>
                    <?$element_id = "12293";  // Тарифы ?>
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
                            "ELEMENT_ID" => $element_id,
                            "FIELD_CODE" => array("", ""),
                            "IBLOCK_ID" => $iblock_id,
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
            </div>
            <div class="rko-doc__block rko-doc__contract offset-md-1 col-md-4">
                <header class="rko-doc__header">
                    <div class="rko-doc__title">Договоры</div>
                </header>
                <div class="rko-doc__items">
                    <?$element_id = "12294";  // Договоры ?>
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
                            "ELEMENT_ID" => $element_id,
                            "FIELD_CODE" => array("", ""),
                            "IBLOCK_ID" => $iblock_id,
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
            </div>

        </div>
        <div class="rko-doc__all">
            <a href="/chastnym-klientam/arkhiv-tarifov-i-dokumentov-individual/" class="rko-doc__all--link-button">
                <span>Архив тарифов и документов</span>
            </a>
            <a href="/chastnym-klientam/arkhiv-tarifov-i-dokumentov-individual/" target="_blank" class="rko-doc__all--link-details">
                <!--span>Подробнее </span-->
                <svg class="rko-doc__all--link-arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                    <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                </svg>
            </a>
        </div>
    </div><!-- v21-container -->
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>