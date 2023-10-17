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
<? if (!empty($arResult["ITEMS"])) { ?>
    <div class="slider-main-wrap">
        <div class="slider-main">
            <? foreach($arResult["ITEMS"] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="slide" style="background-image: url('<?=$arItem["DETAIL_PICTURE"]["SRC"]?>')"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="container">
                        <div class="table">
                            <? if (is_array($arItem["PREVIEW_PICTURE"])) {?>
                                <div class="table-cell">
                                    <div class="img">
                                        <? if (!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])) { ?>
                                            <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                                        <? } ?>
                                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
                                        <? if (!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])) { ?>
                                            </a>
                                        <? } ?>
                                    </div>
                                </div>
                            <? } ?>
                            <div class="table-cell">
                                <div class="title"><?=$arItem["NAME"]?></div>

                                <? if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]) { ?>
                                    <div class="text"><?=$arItem["PREVIEW_TEXT"]?></div>
                                <? } ?>

                                <? if(!empty($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"])) { ?>
                                    <div class="slider-main-thumbs">
                                        <? foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $img) { ?>
                                            <div class="item">
                                                <div class="item-inner">
                                                    <img src="<?=CFile::GetPath($img)?>" alt="<?=$arItem["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>">
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                <? } ?>

                                <? if (!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])) { ?>
                                    <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="link icon">Подробнее</a>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
        <div class="nav_slider"></div>
    </div>
<? } ?>
