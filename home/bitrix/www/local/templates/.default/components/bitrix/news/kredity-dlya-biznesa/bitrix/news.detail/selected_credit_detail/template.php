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

<div class="v21-section v21-section-kredity-business--header">
    <h1 class="v21-h1-new"><?=$arResult['~NAME']?></h1>
</div>

<section class="page-section">

	<article class="content-area clearfix">

		<? if (!empty($arResult['DETAIL_PICTURE']['SRC'])) { ?>
			<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="" class="content-area_image">
		<? } ?>

		<div class="content-area_text">

			<?=$arResult['DETAIL_TEXT']?>

            <div class="creditlist-item__buttons-ask js-creditname__ask">
                <a href="#businessCreditRequest" data-creditbox="<?=$arResult['~NAME']?>" class="button">
                    Оставить заявку
                </a>
            </div>

		</div>

	</article>

</section>
<?$elementId = $arResult["ID"];?>
<?$GLOBALS['arrFilter'] = array("PROPERTY_RECOMMEND_VALUE"=>"Да", "!ID"=>$elementId);?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "credit_recommend_en", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Date display format
		"ADD_SECTIONS_CHAIN" => "N",	// Add Section name to breadcrumb navigation
		"AJAX_MODE" => "N",	// Enable AJAX mode
		"AJAX_OPTION_ADDITIONAL" => "",	// Additional ID
		"AJAX_OPTION_HISTORY" => "N",	// Emulate browser navigation
		"AJAX_OPTION_JUMP" => "N",	// Enable scrolling to component's top
		"AJAX_OPTION_STYLE" => "Y",	// Enable styles loading
		"CACHE_FILTER" => "N",	// Cache if the filter is active
		"CACHE_GROUPS" => "Y",	// Respect Access Permissions
		"CACHE_TIME" => "36000000",	// Cache time (sec.)
		"CACHE_TYPE" => "A",	// Cache type
		"CHECK_DATES" => "Y",	// Show only currently active elements
		"DETAIL_URL" => "",	// Detail page URL (from information block settings by default)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Display at the bottom of the list
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",	// Display at the top of the list
		"FIELD_CODE" => array(	// Fields
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",	// Filter
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Hide link to the details page if no detailed description provided
		"IBLOCK_ID" => "170",	// Information block code
		"IBLOCK_TYPE" => "en",	// Type of information block (used for verification only)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Include information block into navigation chain
		"INCLUDE_SUBSECTIONS" => "Y",	// Show elements from subsections
		"MESSAGE_404" => "",	// Show this message (a component provided message is used by default)
		"NEWS_COUNT" => "20",	// News per page
		"PAGER_BASE_LINK_ENABLE" => "N",	// Enable link processing
		"PAGER_DESC_NUMBERING" => "N",	// Use reverse page navigation
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Cache time for pages with reverse page navigation
		"PAGER_SHOW_ALL" => "N",	// Show the ALL link
		"PAGER_SHOW_ALWAYS" => "N",	// Always show the pager
		"PAGER_TEMPLATE" => ".default",	// Breadcrumb navigation template
		"PAGER_TITLE" => "Новости",	// Category name
		"PARENT_SECTION" => "",	// Section ID
		"PARENT_SECTION_CODE" => "",	// Section code
		"PREVIEW_TRUNCATE_LEN" => "",	// Maximum preview text length (for Text type only)
		"PROPERTY_CODE" => array(	// Properties
			0 => "MAX_SUM",
			1 => "MAX_DATE",
			2 => "INTEREST_RATE",
			3 => "RECOMMEND",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Set browser window title
		"SET_LAST_MODIFIED" => "N",	// Set page last modified date to response header
		"SET_META_DESCRIPTION" => "N",	// Set page description
		"SET_META_KEYWORDS" => "N",	// Set page keywords
		"SET_STATUS_404" => "N",	// Set status 404
		"SET_TITLE" => "N",	// Set page title
		"SHOW_404" => "N",	// Show page
		"SORT_BY1" => "",	// Field for the news first sorting pass
		"SORT_BY2" => "SORT",	// Field for the news second sorting pass
		"SORT_ORDER1" => "DESC",	// Direction for the news first sorting pass
		"SORT_ORDER2" => "ASC",	// Direction for the news second sorting pass
		"STRICT_SECTION_CHECK" => "N",	// Check parent section when showing list
		"COMPONENT_TEMPLATE" => "credit_recommend"
	),
	false
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

<script>
    $(document).ready(function () {
        $('.js-creditname__ask a').on('click', function() {
            let href = $(this).attr('href');
            let credit_type = $(this).data('creditbox');
            $('#credit_name').val(credit_type);
            $('html, body').animate({
                scrollTop: $(href).offset().top - 120
            }, {
                duration: 800,   // по умолчанию «400»
                easing: "linear" // по умолчанию «swing»
            });
            return false;
        });
    });
</script>