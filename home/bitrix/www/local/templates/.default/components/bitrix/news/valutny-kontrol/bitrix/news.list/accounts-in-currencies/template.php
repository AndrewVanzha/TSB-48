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
<? //debugg($arParams["SERVICES_BLOCK"]) ?>
<? //debugg($arResult["ITEMS"]) ?>
<? //debugg($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]]) ?>
<??>
<?
if (count($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]])%2) { // odd
    $gridFlag = 'odd';
}
else { // even
    $gridFlag = 'even';
}
$gridFlag = 'odd'; // рссчитываю только на 5 элементов 3х размеров
$ix = 0;
?>
<section class="accounts-currencies-tileblock">
    <h3 class="accounts-currencies-tileblock__header"><?= $arResult["PROPERTY_HEADER"]; ?></h3>
    <div class="accounts-currencies-tileblock__grid--<?= $gridFlag ?>">
        <?/*?><div class="accounts-currencies-tileblock__grid--horline horline-1"></div>
        <div class="accounts-currencies-tileblock__grid--horline horline-2"></div><?*/?>
        <? foreach ($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]] as $key=>$arItem) : ?>
            <div class="accounts-currencies-tileblock__grid--item grid--item__<?= $gridFlag ?>-<?= $ix++ ?>" >
                <div class="accounts-currencies-tileblock__grid--item-box box-1">
                    <? foreach ($arItem["icon"] as $key=>$icon) : ?>
                    <div class="accounts-currencies-tileblock__grid--img grid--img_<?= $key ?>">
                        <img
                                src="<?=CFile::GetPath($icon)?>"
                                alt="иконка"
                                title="<?=$arItem["main"]?>"
                        />
                    </div>
                    <? endforeach; ?>
                    <h4 class="accounts-currencies-tileblock__grid--title"><?= $arItem["main"]; ?></h4>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</section>
<??>
<?php/*?>
<script>
    $(document).ready(function () {
        $('.js-base-account__button').on('click', function() {
            let href = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(href).offset().top - 120
            }, {
                duration: 800,   // по умолчанию «400»
                easing: "linear" // по умолчанию «swing»
            });
            return false;
        });

        $('.js-show-notetext').hover(
            function() { $(this).find('.brief-text--subline').addClass("brief-text--subline_show"); },
            function() { $(this).find('.brief-text--subline').removeClass("brief-text--subline_show"); }
        );
    });
</script>
<?php*/?>