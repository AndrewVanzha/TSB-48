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
	<table class="v21-table">
		<tr class="v21-table__heading">
			<td class="v21-table__cell-2b" rowspan="2">
				<div class="v21-table__title v21-table__title--2">Виды и размеры<br> сейфовых ячеек</div>
				<div class="v21-table__note">Ширина х Высота х Глубина</div>
			</td>
			<td class="v21-table__cell-2a" colspan="5">
				<div class="v21-table__title v21-table__title--1">Цена и сроки хранения в&nbsp;сейфовой ячейке</div>
			</td>
		</tr>

		<tr class="v21-table__heading">
			<td class="v21-table__cell-2a">
				<div class="v21-table__note">1–30 дней</div>
			</td>
			<td class="v21-table__cell-2a">
				<div class="v21-table__note">31–60 дней</div>
			</td>
			<td class="v21-table__cell-2a">
				<div class="v21-table__note">61–90 дней</div>
			</td>
			<td class="v21-table__cell-2a">
				<div class="v21-table__note">91–180 дней</div>
			</td>
			<td class="v21-table__cell-2a">
				<div class="v21-table__note">181–365/366 дней</div>
			</td>
		</tr>
		<? foreach ($arResult["ITEMS"] as $arItem) : ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

			<tr id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
				<td class="v21-table__cell-2b">
                    <a href="#fSafesForm" class="js-goto-application__button" data-safe="<?=$arItem['NAME']?>">
                        <div class="v21-table__value"><?= $arItem["NAME"] ?></div>
                        <div class="v21-table__note"><?= $arItem["DISPLAY_PROPERTIES"]["ATT_SIZE"]["VALUE"] ?></div>
                    </a>
				</td>
				<? if ($arItem["DISPLAY_PROPERTIES"]["HIDE_PRICE"]["VALUE_XML_ID"] === "Y") { ?>
					<td class="v21-table__cell-1a" colspan="5">
						<div class="v21-table__caption v21-table__title">Цена и сроки хранения в&nbsp;сейфовой ячейке</div>
						<div class="v21-table__value v21-table__value--span">По соглашению сторон</div>
					</td>
				<?
					continue;
				}
				?>
				<td class="v21-table__cell-1a">
					<div class="v21-table__caption v21-table__title">Цена и сроки хранения в&nbsp;сейфовой ячейке</div>
					<div class="v21-table__content">
						<div class="v21-table__caption v21-table__note">1–30 дней</div>
						<div class="v21-table__value"><?= $arItem["DISPLAY_PROPERTIES"]["PRICE_TO_30"]["VALUE"] ?> ₽</div>
					</div>
				</td>
				<td class="v21-table__cell-1a">
					<div class="v21-table__content">
						<div class="v21-table__caption v21-table__note">31–60 дней</div>
						<div class="v21-table__value"><?= $arItem["DISPLAY_PROPERTIES"]["PRICE_TO_60"]["VALUE"] ?> ₽</div>
					</div>
				</td>
				<td class="v21-table__cell-1a">
					<div class="v21-table__content">
						<div class="v21-table__caption v21-table__note">61–90 дней</div>
						<div class="v21-table__value"><?= $arItem["DISPLAY_PROPERTIES"]["PRICE_TO_90"]["VALUE"] ?> ₽</div>
					</div>
				</td>
				<td class="v21-table__cell-1a">
					<div class="v21-table__content">
						<div class="v21-table__caption v21-table__note">91–180 дней</div>
						<div class="v21-table__value"><?= $arItem["DISPLAY_PROPERTIES"]["PRICE_TO_180"]["VALUE"] ?> ₽</div>
					</div>
				</td>
				<td class="v21-table__cell-1a">
					<div class="v21-table__content">
						<div class="v21-table__caption v21-table__note">181–365/366 дней</div>
						<div class="v21-table__value"><?= $arItem["DISPLAY_PROPERTIES"]["PRICE_TO_365"]["VALUE"] ?> ₽</div>
					</div>
				</td>
			</tr>
		<? endforeach; ?>
	</table>
<? } ?>

<script>
    $(document).ready(function () {
        $('.js-goto-application__button').on('click', function() {
            let href = $(this).attr('href');
            //console.log(this.dataset.safe);
            $('#safeType').val(this.dataset.safe);
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

