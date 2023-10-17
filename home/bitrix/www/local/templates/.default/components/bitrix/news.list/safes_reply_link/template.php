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
<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?$arName = explode('-', $arResult['NAME']);?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="page-content page-container">
        <section class="page-section">
            <h2 class="section-title page-title--1 page-title">
               <?=($arName['1']) ? $arName['1'] : GetMessage("WEBTU_SPOILER_HEADER"); ?>
            </h2>
            <?foreach ($arResult['ITEMS'] as $key => $item) { ?>
                <p><a href="<?=$item['PROPERTIES']['LINK']['VALUE']?>" target="_blank"><?=$item['NAME']?></a></p>
            <?} ?>
        </section>
    </div>
<?} ?>

