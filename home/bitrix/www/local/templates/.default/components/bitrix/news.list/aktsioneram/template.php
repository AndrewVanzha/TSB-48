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
$this->setFrameMode(true); ?>

<?foreach($arResult['ITEMS'] as $arItem){?>
    <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
    <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>


    <a href="<?=CFile::GetPath($arItem['PROPERTIES']['ATT_FILE']['VALUE'])?>" class="download-item mi--download-1 mi">
        <span class="name">
            <?=$arItem['NAME']?>
        </span>
        <time class="page-date mi--calendar mi">
            Дата публикации: <?=$arItem['ACTIVE_FROM']?>
        </time>
    </a>

<?}?>
