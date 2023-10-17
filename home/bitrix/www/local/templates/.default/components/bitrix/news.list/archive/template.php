<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$block_code = $arParams['DETAIL_DOCS_CODE'] ? $arParams['DETAIL_DOCS_CODE'] : $arResult["ITEMS"][0]['CODE'];
?>
<div class="all-archive">
	<div class="row">
		<div class="all-archive__nav col-md-3">
			<ul class="all-archive__menu">
				<? foreach($arResult["ITEMS"] as $arItem): ?>
					<li class="all-archive__item all-archive__item_active">
						<? if($arItem['CODE'] == $block_code): ?>
						<?=$arItem['NAME']?>
						<? else: ?>
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
						<? endif; ?>
					</li>
				<? endforeach; ?>
			</ul>
		</div>
		<section class="all-archive__wrapper offset-md-1 col-md-8">
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.detail", 
				"archive", 
				array(
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
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"ELEMENT_CODE" => $block_code,
					"ELEMENT_ID" => "",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"IBLOCK_ID" => "190",
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
					"PROPERTY_CODE" => array(
						0 => "SECTION_DOCS_ID",
						1 => "",
					),
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
					"USE_SHARE" => "N",
					"COMPONENT_TEMPLATE" => "archive"
				),
				false
			);?>
 		</section>
	</div>
</div>