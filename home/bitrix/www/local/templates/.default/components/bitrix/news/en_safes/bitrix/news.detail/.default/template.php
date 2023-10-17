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
<section class="page-section hide-on-mobile">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "page",
            "AREA_FILE_SUFFIX" => "how",
            "EDIT_TEMPLATE" => ""
        )
    );?>
</section>
<section class="page-section">

	<article class="content-area clearfix">

		<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>" class="content-area_image">

		<div class="content-area_text">

			<?=$arResult['DETAIL_TEXT']?>

			<a href="#vaultRequest" onclick="$('#safes_name').val('<?=$arResult['NAME']?>');$('#safes_price').val('<?=$arResult['PROPERTIES']['ATT_PRICE']['VALUE']?>');$('#safes_options').val('<?=$arResult['PROPERTIES']['ATT_SIZE']['VALUE']?>')" data-fancybox class="button">
				Send application
			</a>

		</div>

	</article>

</section>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "advantages",
		"EDIT_TEMPLATE" => ""
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
