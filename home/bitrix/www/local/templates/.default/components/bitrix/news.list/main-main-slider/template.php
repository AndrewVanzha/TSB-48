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
IncludeTemplateLangFile(__FILE__);
$this->setFrameMode(true);
$page_counter = 1;
?>
<div class="mainslider-window">
    <div class="mainpage-halfwindow"></div>
    <div class="v21-container">
        <div class="mainpage-slider">
            <div class="owl-carousel" id="imgSlider">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                    <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
                    <div class="slide" id="slide_<?=$arItem['CODE']?>" data-dot="<?=$page_counter?>">
                        <div class="img-slide">
                            <div class="img-slide--box">
                                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="картинка слайдера" class="slide-dt" width="495" height="260">
                                <img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="картинка слайдера" class="slide-mob" width="495">
                                <?
                                if ($arItem["PROPERTIES"]["BIG_PICTURE"]) :
                                    $arResizePicture = CFile::ResizeImageGet(
                                        $arItem["PROPERTIES"]["BIG_PICTURE"]["VALUE"],
                                        array("width" => 600, 'height' => 261),
                                        BX_RESIZE_IMAGE_PROPORTIONAL,
                                        true
                                    );
                                ?>
                                    <img src="<?=$arResizePicture['src']?>" alt="картинка слайдера" class="slide-dt-big" width="600" height="261">
                                <?
                                endif;
                                ?>
                            </div>
                        </div>

                        <?if(CSite::InDir('/en/')):?>
                            <div class="text-slide">
                                <div class="container">
                                    <h2 class="title-slide"><?=$arItem["PROPERTIES"]["TEXT_SLIDE_ENG"]["VALUE"]?></h2>
                                    <?/*if($arItem["DETAIL_TEXT"] != ""):?>
                                        <p class="line-title-bottom"></p>
                                    <?endif;*/?>
                                    <? if (!empty($arItem["DETAIL_TEXT"])): ?>
                                        <div class="description-slide"><?=$arItem["~DETAIL_TEXT"]?></div>
                                    <? endif; ?>
                                    <? if (!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])): ?>
                                        <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="link-slide"><?=$arItem["PROPERTIES"]["NAME_BTN_ENG"]["~VALUE"]?></a>
                                    <? endif; ?>
                                </div>
                            </div>
                        <?else:?>
                            <div class="text-slide">
                                <div class="container">
                                    <h2 class="title-slide"><?=$arItem["PROPERTIES"]["TEXT_SLIDE"]["VALUE"]?></h2>
                                    <?/*if($arItem["PREVIEW_TEXT"] != ""):?>
                                        <p class="line-title-bottom"></p>
                                    <?endif;*/?>
                                    <? if (!empty($arItem["PREVIEW_TEXT"])): ?>
                                        <div class="description-slide"><?=$arItem["~PREVIEW_TEXT"]?></div>
                                    <? endif; ?>
                                    <? if (!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])): ?>
                                        <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="link-slide"><?=$arItem["PROPERTIES"]["NAME_BTN"]["~VALUE"]?></a>
                                    <? endif; ?>
                                </div>
                            </div>
                        <?endif;?>
                    </div>
                    <? $page_counter += 1; ?>
                <? endforeach; ?>
            </div>
        </div>

    </div>
</div>
<script>
    $(window).on('load', function() {
        $('#imgSlider').owlCarousel({
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            autoHeight: false,
            autoplay: true,
            loop: true,
            autoplaySpeed: 720,
            autoplayTimeout: 10000,
            smartSpeed: 1500,
            dots: true,
            dotsClass: 'owl-dots',
            dotsData: true,
            //dotsContainer: '#mainSliderPager',
            items: 1,
            nav: false,
            //navText: ['<', '>'],
            navText: [
                '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="16" viewBox="0 0 21 16" fill="none"><path d="M1.29094 8.70711C0.900415 8.31658 0.900415 7.68342 1.29094 7.29289L7.6549 0.928932C8.04543 0.538408 8.67859 0.538408 9.06911 0.928932C9.45964 1.31946 9.45964 1.95262 9.06911 2.34315L3.41226 8L9.06911 13.6569C9.45964 14.0474 9.45964 14.6805 9.06911 15.0711C8.67859 15.4616 8.04543 15.4616 7.6549 15.0711L1.29094 8.70711ZM20.002 9L1.99805 9V7L20.002 7V9Z" fill="white"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="16" viewBox="0 0 21 16" fill="none"><path d="M19.7091 8.70711C20.0996 8.31658 20.0996 7.68342 19.7091 7.29289L13.3451 0.928932C12.9546 0.538408 12.3214 0.538408 11.9309 0.928932C11.5404 1.31946 11.5404 1.95262 11.9309 2.34315L17.5877 8L11.9309 13.6569C11.5404 14.0474 11.5404 14.6805 11.9309 15.0711C12.3214 15.4616 12.9546 15.4616 13.3451 15.0711L19.7091 8.70711ZM0.998047 9L19.002 9V7L0.998047 7V9Z" fill="white"/></svg>'
            ],
            mouseDrag: true,
            touchDrag: true,
            resposive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                1100: {
                    items: 1,
                },
            }
        });
    });
</script>