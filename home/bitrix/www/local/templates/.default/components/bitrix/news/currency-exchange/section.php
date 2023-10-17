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
?>
<?php
$cityID = 399; // moskva
if (!empty($_SESSION['city'])) {
    $cityID = $_SESSION['city'];
}
$cityCode = 'moskva';
$currencyCode = 'USD';
//debugg('$cityID');
//debugg($cityID);

if(isset($_GET['currency'])) {
    $currencyCode = htmlspecialchars($_GET['currency']);
}

if(CModule::IncludeModule("iblock")) {
    $rsList = CIBlockElement::GetList(
        array("SORT" => "ASC"),
        array("IBLOCK_ID" => 114, "ID" => $cityID),
        false,
        false,
        array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_ENGLISH", "PROPERTY_ATT_WHERE", "CODE")
        //array()
    );
    while ($arList = $rsList->Fetch()) {
        $cityName = $arList['NAME'];
        $cityCode = $arList['CODE'];
        $cityNameWhere = $arList['PROPERTY_ATT_WHERE_VALUE'];
    }
    //debugg($cityCode);
}
$APPLICATION->SetPageProperty("title", "Обмен валют в " . $cityNameWhere . " | АКБ «ТрансСтройБанк»");
$APPLICATION->SetTitle("Обмен валюты в " . $cityNameWhere);
?>
<section class="v21-obmen-valyut--top">
    <div class="v21-obmen-valyut--top_left">
        <h1>Обмен валюты в <?= $cityNameWhere; ?></h1>
        <? if ($cityCode == 'moskva') : ?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "page",
                    "AREA_FILE_SUFFIX" => "block_1",
                    "EDIT_TEMPLATE" => ""
                )
            );?>
        <? else: ?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "page",
                    "AREA_FILE_SUFFIX" => "block_2",
                    "EDIT_TEMPLATE" => ""
                )
            );?>
        <? endif; ?>

    </div>
    <div class="v21-obmen-valyut--top_right">
        <div class="v21-obmen-valyut--top_right__text">
            <div class="v21-obmen-valyut--top_right__horline horline1">
            </div>
            <div class="v21-obmen-valyut--top_right__horline horline2">
            </div>
            <h3>Скидка на конвертацию</h3>
            <p>Чем выше суммарный объём конвертации, тем выгоднее курс</p>
        </div>
        <div class="v21-obmen-valyut--top_right__text">
            <h3>Продаём и выкупаем</h3>
            <p>Мы не только продадим, но и купим у вас редкую иностранную валюту по лучшему курсу</p>
            <div class="v21-obmen-valyut--top_right__horline horline3">
            </div>
        </div>
    </div>
</section>

<div class="v21-section v21-section-obmen-valyut">
    <div class="currency">
        <?$APPLICATION->IncludeComponent(
            "webtu:currency.exchange",
            "new_select",
            Array(
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CITIES_IBLOCK_ID" => "114",
                "CITY_CODE" => $cityCode,
                "CURRENCY" => $currencyCode,
                "OFFICE_IBLOCK_ID" => "115"
            )
        );?>

    </div>
</div>
<div class="special-zone"></div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"table-on-city",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

		"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],

        "CITIES_IBLOCK_ID" => "114",
        "CITY_CODE" => $cityCode,
        "CURRENCY" => $currencyCode,
        "OFFICE_IBLOCK_ID" => "115"
	),
	$component
);?>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        function renderCurrencyData(data) {
            let key_string = 'currency.exchange.result';
            let arr_start = data.indexOf(key_string);
            let html_text = data.slice(0, arr_start);
            //console.log(html_text);
            let arCurObj = JSON.parse(data.slice(arr_start + key_string.length));

            const exchange_block_table = document.querySelector('.currency-table');
            //const exchange_block_table = document.querySelector('.special-zone');
            //exchange_block_table.innerHTML = html_text;
            let new_buy_fields = $(html_text).find('.v21-exchange-table__value--buy-value');
            let new_sell_fields = $(html_text).find('.v21-exchange-table__value--sell-value');
            //console.log('new_buy_fields=');
            //console.log(new_buy_fields);
            //console.log('new_sell_fields=');
            //console.log(new_sell_fields);

            let buy_fields = $('.currency-table').find('.v21-exchange-table__value--buy-value');
            let sell_fields = $('.currency-table').find('.v21-exchange-table__value--sell-value');
            //console.log('buy_fields=');
            //console.log(buy_fields);
            //console.log('sell_fields=');
            //console.log(sell_fields);

            for(let ix=0; ix<buy_fields.length; ix++) {
                //console.log(buy_fields[ix]);
                //console.log($(new_sell_fields[ix]).html());
                $(buy_fields[ix]).html($(new_buy_fields[ix]).html());
                $(sell_fields[ix]).html($(new_sell_fields[ix]).html());
            }
        }

        function displayCurrencyData () {
            let city_code = '<?=$cityCode?>';
            let currency_code = '<?=$currencyCode?>';
            //console.log('city_code='+city_code);
            //console.log('currency_code='+currency_code);

            let url = '/chastnym-klientam/currency-exchange/ajax_currency_data.php' + '?currency=' + currency_code;
            let xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    //console.log(xhr.responseText);
                    renderCurrencyData(xhr.responseText); // прорисовка таблицы
                }
            });
            xhr.send();
            xhr.error = function() {
                console.log('error with ajax_currency_table.php');
            };

        }
        //displayCurrencyData();
        //let timerCurrencyId = setInterval(() => displayCurrencyData(), 5000);
    });
</script>
<div class="v21-section v21-section--rules">
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "list-obmen-rules",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPONENT_TEMPLATE" => "list-obmen-rules",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "N",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(0=>"",1=>"",),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "209",
            "IBLOCK_TYPE" => "private_clients",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "orange",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(0=>"",1=>"",),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>
</div>
<div class="v21-section">
    <?$APPLICATION->IncludeComponent(
        "webtu:faq.block.add",
        "obmen-valyut",
        Array(
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "HIGHLOAD_IBLOCK_ID" => "5"
        )
    );?>
</div>
