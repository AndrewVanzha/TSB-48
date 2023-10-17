<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
		'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
	),
	$component
);

echo '<pre>';
    print_r($GLOBALS["arResultFieldTest"]); 
echo '</pre>';

$arResult["ITEM"] = $GLOBALS["arResultField"];
unset($GLOBALS["arResultField"]);

$price_sort_desc = 'catalog_PRICE_1-desc';
$price_sort_asc = 'catalog_PRICE_1-asc';

#варианты сортировки
$arSorts = array(
    "sort-desc"                 => "По умолчанию",
    "shows-desc"                => "По популярности",
    $price_sort_desc            => "По цене (дороже)",
    $price_sort_asc             => "По цене (дешевле)",
    "name-asc"                  => "По названию (возр.)",
    "name-desc"                 => "По названию (убыв.)",
);

$sort = array_key_exists( $_REQUEST["sort"], $arSorts ) ? $_REQUEST["sort"] : "sort-desc";
$sort_masiv = explode("-", $sort);

$arParams["SORTS"] = array();

if(count($arSorts) > 0) {
    foreach ($arSorts as $key => $value) {

        $sort_variant = array(
            "CODE" => $key,
            "NAME" => $value,
            "LABEL" => $value,
            "ACTIVE" => $key == $sort_masiv[0] . '-' . $sort_masiv[1] ? "Y" : "N"
        );
        $sort_variant["LINK"] = $APPLICATION->GetCurPageParam(
            "sort=" . $key, array("sort")
        );

        $arParams["SORTS"][] = $sort_variant;
    }
}

#получим монеты с данной коллекции
$arSelect = Array("ID", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID" => 6, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_COLLECTION" => $ElementID);

$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

$arProductsID = array();

while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProductsID[] = $arFields["ID"];
}

?>
<div class="content-block-2">
    <script>
        $('h1').remove();
    </script>
    <div class="filter-wrap">
        <div class="block clearfix">
            <div class="title">
                <h1 class="aligner">Коллекция "<?=$arResult["ITEM"]["NAME"]?>"</h1>
                <? if (count($arProductsID) > 0) { ?>
                    <div class="number aligner">Монет в коллекции: <?=count($arProductsID)?></div>
                <? } ?>
            </div>
            <div class="controls-wrap clearfix">
                <? if(count($arParams["SORTS"]) > 0) { ?>
                    <div class="size size-1">
                        <select name="sort-product" id="sort-product">
                            <? foreach ($arParams["SORTS"] as $key => $sort) {
                                if ($sort["ACTIVE"] == 'Y') $selected = " selected";
                                else $selected = "";
                                ?>
                                <option value="<?=$sort["LINK"]?>" <?=$selected?>><?=$sort["LABEL"]?></option>
                            <? } ?>
                        </select>
                    </div>
                    <script>
                        $( "#sort-product" ).change(function() {
                            window.location = $(this).val();
                        });
                    </script>
                <? } ?>
                <div class="controls-view-wrap">
                    <div class="controls-view list <?= ( ($_COOKIE['view'] == "list") ? 'active' : '')?>"></div>
                    <div class="controls-view table <?= ( ($_COOKIE['view'] == "table" || empty($_COOKIE['view'])) ? 'active' : '')?>"></div>
                </div>
            </div>
        </div>
        <div class="mobile-filter">Фильтр</div>
        <div class="filter-toggle">
            <div class="block clearfix">
                <div class="left">
                    <div class="filter-btn">
                        <a href="<?=$arResult["ITEM"]["DETAIL_PAGE_URL"]?>" <?=( ($_GET["sort-link"] == "") ? 'class="is-active"' : '') ?>>Все</a>
                        <a href="<?=$APPLICATION->GetCurPageParam("sort-link=is_expected",array("sort-link"))?>" <?=( ($_GET["sort-link"] == "is_expected") ? 'class="is-active"' : '') ?>>Ожидаемые</a>
                        <a href="<?=$APPLICATION->GetCurPageParam("sort-link=is_new",array("sort-link"))?>" <?=( ($_GET["sort-link"] == "is_new") ? 'class="is-active"' : '') ?>>Новинки</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? if (count($arProductsID) > 0) {
        $GLOBALS["arrFilterCatalog"]["ID"] = $arProductsID;

        #Получаем GET параметры для фильтрации (все, ожидаемые, новинки)
        if ($_GET["sort-link"] == "is_expected") {
            $GLOBALS["arrFilterCatalog"]["<=catalog_PRICE_1"] = 0;
        }
        if ($_GET["sort-link"] == "is_new") {
            $GLOBALS["arrFilterCatalog"]["=PROPERTY_NEW_PRODUCT_VALUE"] = 1;
        }
        ?>
        <?/*--- Товары из коллекции ---*/ ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "products_collection",
            Array(
                "ACTION_VARIABLE" => "action",
                "ADD_PICT_PROP" => "MORE_PHOTO",
                "ADD_PROPERTIES_TO_BASKET" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BACKGROUND_IMAGE" => "-",
                "BASKET_URL" => "/personal/cart/",
                "BROWSER_TITLE" => "-",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "N",
                "COMPATIBLE_MODE" => "Y",
                "CONVERT_CURRENCY" => "N",
                "CUSTOM_FILTER" => "",
                "DETAIL_URL" => "/katalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_COMPARE" => "N",
                "DISPLAY_TOP_PAGER" => "N",

                "ELEMENT_SORT_FIELD" => !empty($sort_masiv[0]) ? $sort_masiv[0] : "sort",
                "ELEMENT_SORT_ORDER" => count($sort_masiv) > 1 ? $sort_masiv[1] : "desc",
                "SORTS_SHOW_ELEMENTS" => $arSorts,

                "ELEMENT_SORT_FIELD2" => "",
                "ELEMENT_SORT_ORDER2" => "",
                "ENLARGE_PRODUCT" => "STRICT",
                "FILTER_NAME" => "arrFilterCatalog",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "6",
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_SUBSECTIONS" => "Y",
                "LABEL_PROP" => array(),
                "LAZY_LOAD" => "N",
                "LINE_ELEMENT_COUNT" => "3",
                "LOAD_ON_SCROLL" => "N",
                "MESSAGE_404" => "",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "OFFERS_LIMIT" => "5",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Товары",
                "PAGE_ELEMENT_COUNT" => "8",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array("BASE"),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPERTIES" => array(""),
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quant",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "PROPERTY_CODE" => array(
                    0 => "RELEASE_YEAR",
                    1 => "METAL",
                    2 => "PROBA",
                    3 => "QUALITY",
                    4 => "",
                ),
                "PROPERTY_CODE_MOBILE" => array(),
                "RCM_PROD_ID" => "",
                "RCM_TYPE" => "personal",
                "SECTION_CODE" => "",
                "SECTION_CODE_PATH" => "",
                "SECTION_ID" => "",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "/katalog/#SECTION_CODE_PATH#/",
                "SECTION_USER_FIELDS" => array("", ""),
                "SEF_MODE" => "Y",
                "SEF_RULE" => "",
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SHOW_ALL_WO_SECTION" => "Y",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_FROM_SECTION" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "Y",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "Y"
            )
        ); ?>
    <? } ?>
</div>
<? if (strlen($arResult["ITEM"]["DETAIL_TEXT"]) > 0) { ?>
    <div class="content-block-2">
        <div class="heading heading-2">Коллекция "<?=$arResult["ITEM"]["NAME"]?>"</div>
        <p><?=$arResult["ITEM"]["DETAIL_TEXT"]?></p>
    </div>
<? } ?>

<?
#получим список просмотренных товаров с помощью API
$arViewed = array();
$basketUserId = (int)CSaleBasket::GetBasketUserID(false);
if ( $basketUserId > 0 ) {
    $viewedIterator = \Bitrix\Catalog\CatalogViewedProductTable::getList(array(
        'select' => array('PRODUCT_ID'),
        'filter' => array('=FUSER_ID' => $basketUserId, '=SITE_ID' => SITE_ID),
        'order' => array('DATE_VISIT' => 'DESC'),
        'limit' => 15
    ));

    while ($arFields = $viewedIterator->fetch()){
        $arViewed[] = $arFields['PRODUCT_ID'];
    }
}


if (count($arViewed) > 0) {
    $GLOBALS["arViewedFilter"] = array("ID" => $arViewed);
    ?>
    <?/*--- Просмотренные товары ---*/?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "products_viewed",
        Array(
            "ACTION_VARIABLE" => "action",
            "ADD_PICT_PROP" => "MORE_PHOTO",
            "ADD_PROPERTIES_TO_BASKET" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "ADD_TO_BASKET_ACTION" => "ADD",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "BACKGROUND_IMAGE" => "-",
            "BASKET_URL" => "/personal/cart/",
            "BROWSER_TITLE" => "-",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COMPATIBLE_MODE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "CUSTOM_FILTER" => "",
            "DETAIL_URL" => "/katalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "DISCOUNT_PERCENT_POSITION" => "bottom-right",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_COMPARE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "ELEMENT_SORT_FIELD" => "",
            "ELEMENT_SORT_FIELD2" => "",
            "ELEMENT_SORT_ORDER" => "",
            "ELEMENT_SORT_ORDER2" => "",
            "ENLARGE_PRODUCT" => "STRICT",
            "FILTER_NAME" => "arViewedFilter",
            "HIDE_NOT_AVAILABLE" => "N",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "IBLOCK_ID" =>  6,
            "IBLOCK_TYPE" => "catalog",
            "INCLUDE_SUBSECTIONS" => "Y",
            "LABEL_PROP" => array(),
            "LAZY_LOAD" => "N",
            "LINE_ELEMENT_COUNT" => "3",
            "LOAD_ON_SCROLL" => "N",
            "MESSAGE_404" => "",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "OFFERS_LIMIT" => "5",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Товары",
            "PAGE_ELEMENT_COUNT" => "20",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRICE_CODE" => array("BASE"),
            "PRICE_VAT_INCLUDE" => "Y",
            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_PROPERTIES" => array(""),
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PRODUCT_QUANTITY_VARIABLE" => "quant",
            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "PRODUCT_SUBSCRIPTION" => "Y",
            "PROPERTY_CODE" => array(
                0 => "RELEASE_YEAR",
                1 => "METAL",
                2 => "PROBA",
                3 => "QUALITY",
                4 => "",
            ),
            "PROPERTY_CODE_MOBILE" => array(
            ),
            "RCM_PROD_ID" => "",
            "RCM_TYPE" => "personal",
            "SECTION_CODE" => "",
            "SECTION_CODE_PATH" => "",
            "SECTION_ID" => "",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "SECTION_URL" => "/katalog/#SECTION_CODE_PATH#/",
            "SECTION_USER_FIELDS" => array("", ""),
            "SEF_MODE" => "Y",
            "SEF_RULE" => "",
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SHOW_ALL_WO_SECTION" => "Y",
            "SHOW_CLOSE_POPUP" => "N",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_FROM_SECTION" => "N",
            "SHOW_MAX_QUANTITY" => "N",
            "SHOW_OLD_PRICE" => "Y",
            "SHOW_PRICE_COUNT" => "1",
            "SHOW_SLIDER" => "Y",
            "SLIDER_INTERVAL" => "3000",
            "SLIDER_PROGRESS" => "N",
            "TEMPLATE_THEME" => "blue",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "USE_PRICE_COUNT" => "N",
            "USE_PRODUCT_QUANTITY" => "Y"
        )
    );?>
<? } ?>
