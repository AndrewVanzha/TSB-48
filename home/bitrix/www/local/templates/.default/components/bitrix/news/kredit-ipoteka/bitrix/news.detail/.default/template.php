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
        
        <?if (!empty($arResult['DETAIL_PICTURE']['SRC'])) {?>
		  <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="" class="content-area_image">
        <?}?>

		<div class="content-area_text">

			<?=$arResult['DETAIL_TEXT']?>

            <a href="#hypothec"  data-fancybox="" onclick="$('#CREDIT_NAME').val('<?=$arResult['NAME']?>');$('#DATE').val('<?=$arResult['PROPERTIES']['ATT_DATE']['VALUE']?>');" class="button">
                Оформить заявку
            </a>

		</div>

	</article>

</section>

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
