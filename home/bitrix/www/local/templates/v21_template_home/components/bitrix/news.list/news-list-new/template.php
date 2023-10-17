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
?>
<h2 class="v21-mainpage-news--header">Новости банка</h2>
<div class="v21-grid">

    <? foreach ($arResult["ITEMS"] as $arItem) : ?>
        <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
        <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
        <div class="v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x4@lg" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="v21-news-card">
                <time datetime="<?= FormatDate("Y-m-d", MakeTimeStamp($arItem['DISPLAY_ACTIVE_FROM'])) ?>" class="v21-news-card__date">
                    <?= strtolower(FormatDate("d F Y", MakeTimeStamp($arItem['DISPLAY_ACTIVE_FROM']))) ?>
                </time>
                <h2 class="v21-news-card__title v21-h6"><?= TruncateText($arItem['NAME'], 40) ?></h2>
                <div class="v21-news-card__brief v21-p"><?= TruncateText($arItem['PREVIEW_TEXT'], 115) ?></div>
            </a><!-- /.v21-news-card -->
        </div><!-- /.v21-grid__item -->
    <? endforeach; ?>

</div><!-- /.v21-grid -->
<div class="v21-more">
    <a href="<?= $arResult['LIST_PAGE_URL'] ?>" class="v21-button v21-button--border">Все новости</a>
</div>
