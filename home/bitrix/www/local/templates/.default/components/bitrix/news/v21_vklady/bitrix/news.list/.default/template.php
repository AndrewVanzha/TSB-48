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

<div class="v21-section js-v21-tabs">
    <div class="v21-tabs-header js-v21-tabs-header">
        <button class="v21-tabs-header__nav v21-tabs-header__nav--next js-v21-tabs-header-next"></button>
        <button class="v21-tabs-header__nav v21-tabs-header__nav--prev js-v21-tabs-header-prev"></button>
        <div class="js-v21-tabs-header-slider">
            <? $counter = 0; ?>
            <? foreach ($arResult["SECTIONS"] as $key => $section) { ?>
                <div>
                    <a href="#" data-tab-id="tab<?= $key ?>" data-slide="<?= $counter ?>" class="v21-tabs-header__item js-v21-tabs-header-item js-v21-tabs-toggle<?= $counter == 0 ? " is-active" : "" ?>">
                        <?= $section ?>
                    </a>
                </div>
                <? $counter++; ?>
            <? } ?>
        </div><!-- /.js-v21-tabs-header-slider -->
    </div><!-- /.v21-tabs-header -->

    <div class="v21-tabs-content">
        <? foreach ($arResult["ELEMENTS"] as $key => $section) { ?>
            <div data-tab-id="tab<?= $key ?>" class="v21-tabs-content__item v21-fade">
                <? foreach ($section as $element) { ?>
                    <? $params = [
                        $element["PROPERTIES"]["INTEREST_RATE"],
                        $element["PROPERTIES"]["DEPOSIT_TERM"],
                        $element["PROPERTIES"]["MIN_SUMM"],
                    ] ?>
                    <div class="v21-service-card">
                        <div class="v21-service-card__image">
                            <img src="<?= $element["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $element["NAME"] ?>">
                        </div><!-- /.v21-service-card__image -->
                        <div class="v21-service-card__text">
                            <h3 class="v21-service-card__title v21-h4"><?= $element["NAME"] ?></h3>

                            <div class="v21-service-card__item">
                                <div class="v21-service-card__stats v21-service-card__stats--deposit v21-grid">
                                    <? foreach ($params as $param) { ?>
                                        <div class="v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">
                                            <div class="v21-service-card__stats-title"><?= $param["NAME"] ?></div>
                                            <div class="v21-service-card__stats-value"><?= $param["VALUE"] ?></div>
                                        </div><!-- /.v21-service-card__stats-item -->
                                    <? } ?>
                                </div><!-- /.v21-service-card__stats -->
                            </div><!-- /.v21-service-card__item -->

                            <? if ($element["PROPERTIES"]["ADVANTAGES"]["VALUE"]) { ?>
                                <p class="v21-service-card__item--sm v21-service-card__item"><?= $element["PROPERTIES"]["ADVANTAGES"]["VALUE"] ?></p><!-- /.v21-service-card__item -->
                            <? } ?>
                            <div class="v21-service-card__controls">
                                <a href="#v21_depositOrder" data-name="<?= $element["NAME"] ?>" class="v21-service-card__order v21-service-card__controls-item v21-button js-v21-modal-toggle open">Оставить заявку</a>
                                <a href="<?= $element["DETAIL_PAGE_URL"] ?>" class="v21-service-card__controls-item v21-button v21-button--link">
                                    <div>Подробнее</div>
                                    <svg width="9" height="9" class="v21-button__icon">
                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowRightSmall"></use>
                                    </svg>
                                </a>
                            </div><!-- /.v21-service-card__controls -->
                        </div><!-- /.v21-service-card__text -->
                    </div><!-- /.v21-service-card -->
                <? } ?>
            </div>
        <? } ?>
    </div>
</div>