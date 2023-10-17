<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

if (count($arResult["ITEMS"]) > 0) {
?>
	<? foreach ($arResult["ITEMS"] as $arItem) : ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="v21-transfer-item v21-grid__item v21-grid__item--1x3@lg" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
			<div class="v21-transfer-item__image">
				<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>">
			</div><!-- /.v21-transfer-item__item -->
			<div class="v21-transfer-item__text">
				<h3 class="v21-h5"><?= $arItem["NAME"] ?></h3>
				<div class="v21-content">
					<?= $arItem["PREVIEW_TEXT"] ?>
				</div>
			</div><!-- /.v21-transfer-item__text-->
		</div><!-- /.v21-transfer-item -->
	<? endforeach; ?>
<? } ?>