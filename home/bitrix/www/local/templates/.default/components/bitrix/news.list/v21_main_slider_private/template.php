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
$this->setFrameMode(true); ?>

<? if (count($arResult["ITEMS"]) > 0) { ?>
    <div class="v21-welcome v21-section js-v21-welcome">
        <div class="v21-welcome__pager">
            <div class="v21-welcome__pager-container v21-container">
                <div class="v21-welcome__count js-v21-welcome-current"></div>
                <div class="v21-welcome__progress js-v21-welcome-progress"></div>
                <div class="v21-welcome__count js-v21-welcome-total"></div>
            </div>
        </div><!-- /.v21-welcome__pager -->

        <button class="v21-welcome__nav v21-welcome__nav--prev js-v21-welcome-prev">
            <svg width="75" height="19">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowLeft"></use>
            </svg>
        </button>

        <button class="v21-welcome__nav v21-welcome__nav--next js-v21-welcome-next">
            <svg width="75" height="19">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowRight"></use>
            </svg>
        </button>

        <div class="v21-welcome__slider js-v21-welcome-slider">
            <? foreach ($arResult["ITEMS"] as $arItem) : ?>
                <div class="v21-welcome__slide" style="background-image: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>);">
                    <div class="v21-container">
                        <? if ($arItem["DETAIL_PICTURE"]["SRC"]) { ?>
                            <div class="v21-welcome__image">
                                <img src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>">
                            </div>
                        <? } ?>
                        <div class="v21-welcome__text">
                            <? if (CSite::InDir('/en/')) : ?>
                                <h2 class="v21-welcome__title v21-h1"><?= $arItem["PROPERTIES"]["TEXT_SLIDE_ENG"]["VALUE"] ?></h2>
                                <div class="v21-welcome__brief v21-p"><?= $arItem["DETAIL_TEXT"] ?></div>
                                <?/* if ($arItem["PROPERTIES"]["LINK"]["VALUE"]) { ?>
                                    <a href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>" class="v21-welcome__button v21-button v21-button--solid"><?= $arItem["PROPERTIES"]["NAME_BTN_ENG"]["VALUE"] ?></a>
                                <? } */ ?>
                            <? else : ?>
                                <h2 class="v21-welcome__title v21-h1"><?= $arItem["PROPERTIES"]["TEXT_SLIDE"]["VALUE"] ?></h2>
                                <div class="v21-welcome__brief v21-p"><?= $arItem["PREVIEW_TEXT"] ?></div>
                                <? if ($arItem["PROPERTIES"]["LINK"]["VALUE"]) { ?>
                                    <a href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>" class="v21-welcome__button v21-button v21-button--solid"><?= $arItem["PROPERTIES"]["NAME_BTN"]["VALUE"] ?></a>
                                <? } ?>
                            <? endif; ?>
                        </div>
                    </div>
                </div><!-- /.v21-welcome__slide -->
            <? endforeach; ?>
        </div><!-- /.v21-welcome__slider -->
    </div><!-- /.v21-welcome -->
<? } ?>