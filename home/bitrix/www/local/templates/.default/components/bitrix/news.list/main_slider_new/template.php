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

<div class="wrapp-slider slider-corporat-clients">
    <div class="owl-carousel">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <div class="slide" id="slide_<?=$arItem['CODE']?>">
                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" class="slide-dt">
                <img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="" class="slide-mob">
                <?if(CSite::InDir('/en/')):?>
                    <div class="text-slide">
                        <div class="container">
                            <div class="title-slide"><?=$arItem["PROPERTIES"]["TEXT_SLIDE_ENG"]["VALUE"]?></div>
                            <?if($arItem["DETAIL_TEXT"] != ""):?><div class="line-title-bottom"></div><?endif;?>
                            <div class="description-slide">
                                <?=$arItem["DETAIL_TEXT"]?>
                            </div>
                            <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="link-slide"><?=$arItem["PROPERTIES"]["NAME_BTN_ENG"]["VALUE"]?></a>
                        </div>
                    </div>
                <?else:?>
                    <div class="text-slide">
                        <div class="container">
                            <div class="title-slide"><?=$arItem["PROPERTIES"]["TEXT_SLIDE"]["VALUE"]?></div>
                            <?if($arItem["PREVIEW_TEXT"] != ""):?><div class="line-title-bottom"></div><?endif;?>
                            <div class="description-slide">
                                <?=$arItem["PREVIEW_TEXT"]?>
                            </div>
                            <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="link-slide"><?=$arItem["PROPERTIES"]["NAME_BTN"]["VALUE"]?></a>
                        </div>
                    </div>
                <?endif;?>
            </div>
        <?endforeach;?>
    </div>
</div>


