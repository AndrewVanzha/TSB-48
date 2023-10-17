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
		<div class="wrap-content">
			<?if (!empty($arResult['DETAIL_PICTURE']['SRC'])) {?>
				<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="" class="content-area_image">
			<?}?>

			<div class="content-area_text">
				<?=$arResult['DETAIL_TEXT']?>
			</div>
		</div>
<?php if(
	$arResult['NAME'] != "World MasterCard Black Edition"
	&& $arResult['NAME'] != "MasterCard Platinum PayPass"
	&& $arResult['NAME'] != "MasterCard Gold PayPass"
) { ?>
		<a href="#vaultRequest" onclick="$('#CARD_NAME').val('<?=$arResult['NAME']?>');$('#CARD_TYPE').val('<?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?>');$('#safes_options').val('<?=$arResult['PROPERTIES']['ATT_SIZE']['VALUE']?>')" data-fancybox class="button">
			Подать заявку
		</a>
<?php } ?>
	</article>

</section>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/chastnym-klientam/bankovskie-karty/index_advantages.php"
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
