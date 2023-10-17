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
<?php// debugg($arResult);?>
<div class="v21-section">
    <div class="rules-header">
        <h2 class="rules-header--title">Правила обмена валюты</h2>
    </div>
    <div class="rules-scheme">
        <div class="rules-scheme--block__horline horline-1"></div>
        <div class="rules-scheme--block__horline horline-2"></div>
        <ul class="rules-scheme--block">
            <div class="rules-scheme--block__verline verline-1"></div>
            <div class="rules-scheme--block__verline verline-2"></div>
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="rules-scheme--item">
                    <img
                            class="rules-scheme--item__image"
                            src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                            width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                            height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                    />
                    <div class="rules-scheme--item__text">
                        <?echo $arItem["PREVIEW_TEXT"];?>
                    </div>
                </li>
            <?endforeach;?>
        </ul>
        <div class="rules-scheme--text">
            <div class="rules-scheme--text__horline horline-1"></div>
            <div class="rules-scheme--text__verline verline-1"></div>
            <?= $arResult['~DESCRIPTION'] ?>
        </div>
    </div>
</div>
