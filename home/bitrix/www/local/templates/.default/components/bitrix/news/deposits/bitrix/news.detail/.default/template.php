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
if(CSite::InDir('/chastnym-klientam/vklady-i-investitsii/vklady/vklad-ezhemesyachnyy-onlayn/')){
	$how = 'how2';
} else {
	$how = 'how';
}
?>
<div class="page-content page-container">
	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => $how,
		"EDIT_TEMPLATE" => ""
	)
);?>
</div>
<section class="page-section">

	<article class="content-area clearfix">

		<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="" class="content-area_image">

		<div class="content-area_text">

			<?=$arResult['PREVIEW_TEXT']?>

			</br></br>
			<a href="#depositFiz" onclick="$('#CREDIT_NAME').val('<?=$arResult['NAME']?>')" data-fancybox="" class="button">
        				Открыть вклад </a>

		</div>

	</article>

</section>
<section class="page-section">

	<h2 class="section-title page-title--2 page-title">
		Процентные ставки по вкладу
	</h2>

	<?=$arResult['DETAIL_TEXT']?>

</section>
<div class="page-content page-container">
	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "advantages",
		"EDIT_TEMPLATE" => ""
	)
);?>
</div>

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
