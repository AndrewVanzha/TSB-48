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
<article class="hq-entry page-section content-area">

	<div class="clearfix">
		
		<? if ($arResult['DETAIL_PICTURE']) { ?>
			<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>" class="content-area_image">
		<? } ?>

		<div class="content-area_text">

			<div class="hq-entry_heading single">

				<div class="title">

					<?=$arResult['PROPERTIES']['POSITION']['VALUE']?>

					<h3 class="page-title--4 page-title">
						<?=$arResult['NAME']?>
					</h3>

                    <?=GetMessage("WEBTU_GOVERMENT_BIRTHDATE")?> <?=$arResult['PROPERTIES']['BIRTHDATE']['VALUE']?>

				</div>

			</div>

			<?=$arResult['DETAIL_TEXT']?>

		</div>

	</div>

</article>