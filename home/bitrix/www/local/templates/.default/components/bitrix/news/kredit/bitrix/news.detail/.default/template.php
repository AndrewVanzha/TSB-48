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
<section class="page-section">

	<article class="content-area clearfix">

		<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="" class="content-area_image">

		<div class="content-area_text">

			<?=$arResult['DETAIL_TEXT']?>

			<!--<a href="#creditRequest" onclick="$('#CREDIT_NAME').val('<?=$arResult['NAME']?>');$('#CREDIT_TIME').val('<?=$arResult['PROPERTIES']['MAX_DATE']['VALUE']?>')" data-fancybox="" class="button">
				Оформить заявку
			</a>-->

		</div>

	</article>

</section>


<?/*$APPLICATION->IncludeComponent(
	"webtu:calculator.credit",
	"credit",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"ELEMENT_ID" => "197",
		"IBLOCK_ID" => "45",
		"PERCENT_RUB" => $arResult['PROPERTIES']['INTEREST_RATE_RUB']['VALUE'],
        "PERCENT_USD" => $arResult['PROPERTIES']['INTEREST_RATE_USD']['VALUE'],
        "PERCENT_EUR" => $arResult['PROPERTIES']['INTEREST_RATE_EUR']['VALUE'],
		"CREDIT_NAME" => $arResult['NAME'],
	)
);*/?>

<div id="list">
	<?/*$GLOBALS['arrFilter'] = array("PROPERTY_RECOMMEND_VALUE"=>"Да");?>
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"credit_recommend", 
	array(
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
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "42",
		"IBLOCK_TYPE" => "private_clients",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "MAX_SUM",
			1 => "MAX_DATE",
			2 => "INTEREST_RATE",
			3 => "RECOMMEND",
			4 => "ATT_RECOMMEND",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "credit_recommend"
	),
	false
);*/?>
</div>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
	"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "advantages",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>

<?$APPLICATION->IncludeComponent(
    "webtu:spoiler",
    ".default",
    array(
        "AJAX_MODE" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "ADD_INFO_BANK" => $arResult['PROPERTIES']['ADD_INFO_BANK']['VALUE'],
        "ADD_INFO_SELF" => $arResult['PROPERTIES']['ADD_INFO_SELF']['VALUE'],
        "NAME" => $arResult['NAME'],
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
    ),
    false
);?>
<script type="text/javascript">
	window.onload=function(){
		$('.check-box').click(function(){
			calculation();
		})
		calculation();
	}
</script>
