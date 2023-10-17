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

<?
if ($arResult["ID"] !== "264") {
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "page",
            "AREA_FILE_SUFFIX" => "how",
            "EDIT_TEMPLATE" => ""
        )
    );
}
?>

<section class="page-section">

	<article class="content-area clearfix">

        <? if (!empty($arResult['DETAIL_PICTURE']['SRC'])) { ?>
		    <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="" class="content-area_image">
        <? } ?>

		<div class="content-area_text">

			<?=$arResult['DETAIL_TEXT']?>

		</div>

	</article>

</section>
<?$APPLICATION->IncludeComponent(
    "webtu:spoiler",
    ".default",
    array(
        "AJAX_MODE" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "ADD_INFO_SELF" => array(9103),
        "ADD_INFO_BANK" => array(0),
        "NAME" => $arResult['NAME'],
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
    ),
    false
);?>
