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
$officeCode = $arResult['VARIABLES']['ELEMENT_CODE'];
$cityCode = 'moskva';
$currencyCode = 'USD';
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
        //debugg($arList);
        $cityName = $arList['NAME'];
        $cityCode = $arList['CODE'];
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_menu.json', json_encode($arList));
    }
}
//debugg($cityName);
\GarbageStorage::set('name', $cityName);
//debugg(\GarbageStorage::get('name'));
?>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"office-table",
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

        "CITIES_IBLOCK_ID" => "114",
        "CITY_CODE" => $cityCode,
        "CURRENCY" => $currencyCode,
        "OFFICE_IBLOCK_ID" => "115",
        "BACK_PATH_URI" => $arResult['FOLDER'].$arResult['VARIABLES']['SECTION_CODE_PATH'].'/',
	),
	$component
);?>

<script>
	window.addEventListener('DOMContentLoaded', function () {
		function renderCurrencyTable(data) {
			let key_string = 'currency.exchange.result';
			let arr_start = data.indexOf(key_string);
			let html_text = data.slice(0, arr_start);
			//console.log(html_text);
			let arCurObj = JSON.parse(data.slice(arr_start + key_string.length));

			let new_buy_fields = $(html_text).find('.exchange-table__value--buy-val');
			let new_sell_fields = $(html_text).find('.exchange-table__value--sell-val');
			//console.log('new_buy_fields=');
			//console.log(new_buy_fields);
			//console.log('new_sell_fields=');
			//console.log(new_sell_fields);

			let buy_fields = $('.currency-table').find('.exchange-table__value--buy-val');
			let sell_fields = $('.currency-table').find('.exchange-table__value--sell-val');
			//console.log('buy_fields=');
			//console.log(buy_fields);
			//console.log('sell_fields=');
			//console.log(sell_fields);

			for(let ix=0; ix<buy_fields.length; ix++) {
				//console.log(buy_fields[ix]);
				//console.log(sell_fields[ix]);
				//console.log($(new_sell_fields[ix]).html());
				$(buy_fields[ix]).html($(new_buy_fields[ix]).html());
				$(sell_fields[ix]).html($(new_sell_fields[ix]).html());
			}
		}

		function displayCurrencyTable () {
			let office_code = '<?=$officeCode?>';
			let city_code = '<?=$cityCode?>';
			let currency_code = '<?=$currencyCode?>';
			//console.log('office_code='+office_code);
			//console.log('city_code='+city_code);
			//console.log('currency_code='+currency_code);

			let url = '/chastnym-klientam/currency-exchange/ajax_currency_table.php' + '?currency=' + currency_code;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.addEventListener("readystatechange", () => {
				if (xhr.readyState === 4 && xhr.status === 200) {
					//console.log(xhr.responseText);
					renderCurrencyTable(xhr.responseText); // прорисовка таблицы
				}
			});
			xhr.send();
			xhr.onerror = function() {
				console.log('error with ajax_currency_table.php');
			};

		}
		//displayCurrencyTable();
		//let timerCurrencyId = setInterval(() => displayCurrencyTable(), 5000);
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
