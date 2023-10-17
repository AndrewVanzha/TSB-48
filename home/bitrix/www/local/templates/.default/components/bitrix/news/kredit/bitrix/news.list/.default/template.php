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
$this->setFrameMode(true); ?>

<section class="page-section">
    <div class="product-items items-list clearfix">
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

        	<div class="product-item">
        		<div class="page-title--4 page-title">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner CREDIT_NAME"><?=$arItem['NAME']?></a> 
                </div>
        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
        					<p>
        						 Процентная ставка: <br>
                                 <span class="credit_percent" data-value="<?=$arItem['PROPERTIES']['INTEREST_RATE_RUB']['VALUE']?>">
			                       <?=$arItem['PROPERTIES']['INTEREST_RATE_RUB']['VALUE']?>
                                </span>
        					</p>
        					<p>
        						 Максимальная сумма: <br>
                                 <span class="credit_summ" data-value="<?=$arItem['PROPERTIES']['MAX_SUM']['VALUE']?>">
			                       <?=number_format($arItem['PROPERTIES']['MAX_SUM']['VALUE'], 0, ',', ' ');?> Рублей
                                </span>
        					</p>
                            <p>
        						 Срок кредитования:  <br>
                                 <span class="credit_time" data-value="<?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?>">
			                       <?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?> 
                                </span>
        					</p>
        				</div>
         <a href="#creditRequest" onclick="$('#CREDIT_NAME').val('<?=$arItem['NAME']?>');$('#CREDIT_TIME').val('<?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?>')" data-fancybox="" class="button">
        				Оформить заявку</a>
        				<div class="more">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					Узнать больше </a>
        				</div>
        			</div>
        		</div>
        	</div>

        <? } ?>
    </div>
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
        "PERCENT_RUB" => $arResult["ITEMS"][0]['PROPERTIES']['INTEREST_RATE_RUB']['VALUE'],
        "PERCENT_USD" => $arResult["ITEMS"][0]['PROPERTIES']['INTEREST_RATE_USD']['VALUE'],
        "PERCENT_EUR" => $arResult["ITEMS"][0]['PROPERTIES']['INTEREST_RATE_EUR']['VALUE'],
		"CREDIT_NAME" => $arResult['NAME'],
	)
);*/?>

<div id="list">
	<?/*$GLOBALS['arrFilter'] = array("PROPERTY_RECOMMEND_VALUE"=>"Да");?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"credit_recommend",
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
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array("", ""),
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
			"PROPERTY_CODE" => array("", "MAX_SUM", "MAX_DATE", "RECOMMEND", "ATT_RECOMMEND",  "INTEREST_RATE", ""),
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
			"STRICT_SECTION_CHECK" => "N"
		)
	);*/?>
</div>

<?=$arResult["NAV_STRING"]?>

<script type="text/javascript">
	window.onload=function(){
		$('.check-box').click(function(){
			calculation();
		})
		calculation();
	}
</script>
