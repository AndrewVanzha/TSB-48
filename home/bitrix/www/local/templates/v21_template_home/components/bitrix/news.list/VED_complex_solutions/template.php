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
<div class="solutions-block">
    <h2 class="v21-h2 solutions-block--header"><?= $arResult['SECTION']['PATH'][0]['~NAME'] ?></h2>
    <div class="solutions-block--wrap">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="solutions-block--item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="solutions-item--image">
                    <img
                            class="solutions-item--image_picture"
                            src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                    />
                </div>
                <div class="solutions-item--text">
                    <h6 class="v21-h6 solutions-item--header"><?= $arItem['~NAME'] ?></h6>
                    <p class="solutions-item--description">
                        <?= $arItem['~DETAIL_TEXT'] ?>
                    </p>
                </div>
            </div>
        <?endforeach;?>
    </div>

    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
</div>
