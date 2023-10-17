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
<?// debugg($arResult["ITEMS"]); ?>

<section class="deposit-section">
    <? foreach($arResult["ITEMS"] as $arItem) : ?>
        <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
        <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
        <div class="deposit-section--item" id="item_<?=$arItem['ID']?>">
            <? if ($arItem["PREVIEW_PICTURE"]) :
                $arResizeBigPicture = CFile::ResizeImageGet(
                    $arItem["PREVIEW_PICTURE"]["ID"],
                    array("width" => 460, 'height' => 460 * 537 / 826),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );
                $arResizeSmallPicture = CFile::ResizeImageGet(
                    $arItem["PREVIEW_PICTURE"]["ID"],
                    array("width" => 280, 'height' => 280 * 537 / 826),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );
                ?>
                <a href="#fInsuranceForm" class="deposit-item--image js-fDepositForm" data-item="<?=$arItem['ID']?>">
                    <img src="<?=$arResizeBigPicture['src']?>" class="deposit-item--bigimg" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
                    <img src="<?=$arResizeSmallPicture['src']?>" class="deposit-item--smallimg" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
                </a>
            <? endif; ?>

            <div class="deposit-item--text-wrap">
                <h3 class="deposit-item--text-header"><?=$arItem['PROPERTIES']['ADD_BLOCK_HEADER']['~VALUE']?></h3>
                <? if ($arItem['PROPERTIES']['ADD_MAIN_ATTRIBUTE']) : ?>
                    <p><?=$arItem['PROPERTIES']['ADD_MAIN_ATTRIBUTE']['~VALUE']?></p>
                <? endif; ?>
                <? if ($arItem['PROPERTIES']['ADD_INTEREST_RATE']) : ?>
                    <p>
                        <span><?=$arItem['PROPERTIES']['ADD_INTEREST_RATE']['~DESCRIPTION']?> </span>
                        <span><?=$arItem['PROPERTIES']['ADD_INTEREST_RATE']['~VALUE']?></span>
                    </p>
                <? endif; ?>
                <? if ($arItem['PROPERTIES']['ADD_MIN_SUM']) : ?>
                    <p>
                        <span><?=$arItem['PROPERTIES']['ADD_MIN_SUM']['~DESCRIPTION']?> </span>
                        <span><?=$arItem['PROPERTIES']['ADD_MIN_SUM']['~VALUE']?></span>
                    </p>
                <? endif; ?>
                <? if ($arItem['PROPERTIES']['ADD_OPTION']) : ?>
                    <p><?=$arItem['PROPERTIES']['ADD_OPTION']['~VALUE']?></p>
                <? endif; ?>
                <div class="deposit-item--control">
                    <a href="#fDepositForm" class="v21-plastic-card__controls-order v21-button js-fDepositForm" data-item="<?=$arItem['ID']?>">Оставить заявку</a>
                    <? if ($arItem["DETAIL_TEXT"]) : // если делать подробную таблицу ?>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="v21-plastic-card__controls-more v21-button v21-button--link" data-item="<?=$arItem['ID']?>">
                            <div class="v21-plastic-card__controls-caption-1">Подробнее</div>
                            <?/*?><div class="v21-plastic-card__controls-caption-2">Свернуть информацию</div><?*/?>
                            <svg width="9" height="9" class="v21-plastic-card__controls-icon v21-button__icon">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowDownSmall"></use>
                            </svg>
                        </a>
                    <? else: ?>
                        <a href="/2023/Deposits/Условия%20по%20депозитам%20юр.лиц_190922.pdf" class="v21-plastic-card__controls-more v21-button v21-button--link" data-item="<?=$arItem['ID']?>">
                            <div class="v21-plastic-card__controls-caption-1">Подробнее</div>
                            <?/*?><div class="v21-plastic-card__controls-caption-2">Свернуть информацию</div><?*/?>
                            <svg width="9" height="9" class="v21-plastic-card__controls-icon v21-button__icon">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowDownSmall"></use>
                            </svg>
                        </a>
                    <? endif; ?>
                </div><!-- /.deposit-item--control -->
            </div>
        </div>
    <? endforeach; ?>
</section>
