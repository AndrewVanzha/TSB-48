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
<?
if ($arResult["PICTURE"]) {
    $width = 250;
    $height = 238 / 800 * $width;
    $arFileTmp  = \CFile::ResizeImageGet(
        $arResult["PICTURE"],
        array("width" => $width, 'height' => $width),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
    if($arFileTmp['src']) {
        $arFileTmp['src'] = \CUtil::GetAdditionalFileURL($arFileTmp['src'], true);
    }
    $arPicture = array_change_key_case($arFileTmp, CASE_UPPER);
}
if ($arResult["PICTURE"]) :
    ?>
    <div class="insurance-title">
        <h3 class="v21-h3-new insurance-title--text"><?=$arResult['~DESCRIPTION']?></h3>
        <div class="insurance-title--logo">
            <img src="<?=$arPicture['SRC']?>" width="<?=$arPicture['WIDTH']?>"
                 height="<?=$arPicture['HEIGHT']?>"
                 alt="логотип"
            >
        </div>
    </div>
<? endif; ?>

<section class="insurance-section">
    <? foreach($arResult["ITEMS"] as $arItem) : ?>
        <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
        <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
        <div class="insurance-item" id="item_<?=$arItem['ID']?>">
            <?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
                <a href="#fInsuranceForm" class="insurance-area--image js-fInsuranceForm" data-item="<?=$arItem['SECTION']['CODE']?>">
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>">
                </a>
            <?endif?>
            <div class="insurance-item--text-wrap">
                <h3 class="insurance-item--text-header"><?=$arItem['SECTION']['DESCRIPTION']?></h3>
                <p class="insurance-item--text-subheader"><?=$arItem['PROPERTIES']['APP_SUBHEADER']['~VALUE']?></p>
                <h3 class="insurance-item--text-header2"><?=$arItem['PROPERTIES']['APP_HEADER2']['~VALUE']?></h3>
                <div class="insurance-item--text-view"><?=$arItem['~PREVIEW_TEXT']?></div>
                <div class="insurance-item--control">
                    <a href="#fInsuranceForm" class="v21-plastic-card__controls-order v21-button js-fInsuranceForm" data-item="<?=$arItem['SECTION']['CODE']?>">Оставить заявку</a>
                    <? if ($arItem["DETAIL_TEXT"]) { ?>
                        <div class="v21-plastic-card__controls-more v21-button v21-button--link js-v21-popup-toggle" data-item="<?=$arItem['ID']?>">
                            <div class="v21-plastic-card__controls-caption-1">Подробнее</div>
                            <?/*?><div class="v21-plastic-card__controls-caption-2">Свернуть информацию</div><?*/?>
                            <svg width="9" height="9" class="v21-plastic-card__controls-icon v21-button__icon">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowDownSmall"></use>
                            </svg>
                        </div>
                    <? } ?>
                </div><!-- /.insurance-item--control -->
            </div>
        </div>
        <div class="insurance-item--detail-popup" data-item="<?=$arItem['ID']?>">
            <div class="insurance-item--text-detail"><?=$arItem['~DETAIL_TEXT']?></div>
            <div class="insurance-item--popup-close js-insurance-item--popup-close">
                <svg width="20" height="20">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
                </svg>
            </div>
        </div>
    <? endforeach; ?>
</section>

<script>
    $(document).ready(function () {
        const specialFadeIn = (el, timeout, display) => {
            el.style.opacity = 0;
            el.style.transition = `opacity ${timeout}ms`;
            setTimeout(() => {
                el.style.opacity = 1;
            }, 10);
        };

        const specialFadeOut = (el, timeout) => {
            el.style.opacity = 1;
            el.style.transition = `opacity ${timeout}ms`;
            el.style.opacity = 0;
        };

        const delayShow = 1000;
        let arr = document.querySelectorAll('.insurance-item--detail-popup');
        $('.js-v21-popup-toggle').on('click', function () {  // отработка Подробнее
            let $this = $(this);
            let coord = $this.offset();
            let window_width = $(window).width();
            let popup_infobox_width = $(arr[0]).width();
            let data_item = $this.data('item');

            arr.forEach((item, index) => {
                $(item).removeClass('insurance-item--detail-popup__show');
                if($(item).data('item') == data_item) {
                    item.style.top = (coord.top + 50) + 'px';
                    if(popup_infobox_width < (window_width - coord.left)) { // вывожу справа от
                        item.style.left = (coord.left + 5) + 'px';
                    }
                    else {
                        if(popup_infobox_width < (coord.left)) { // вывожу слева от
                            item.style.left = (coord.left - popup_infobox_width - 5) + 'px';
                        }
                        else {  // вывожу посередине экрана
                            item.style.left = (window_width - popup_infobox_width) / 2 + 'px';
                        }
                    }
                    $(item).addClass('insurance-item--detail-popup__show');
                    specialFadeIn(item, delayShow);
                }
            });

        });

        $('.js-insurance-item--popup-close').click((el) => {
            //console.log(el.currentTarget.parentElement);
            specialFadeOut(el.currentTarget.parentElement, delayShow);
            setTimeout(() => {
                el.currentTarget.parentElement.classList.remove('insurance-item--detail-popup__show') ;
                arr.forEach((item, index) => {
                    $(item).removeClass('insurance-item--detail-popup__show');
                });
            }, delayShow);
        });
    });
</script>
