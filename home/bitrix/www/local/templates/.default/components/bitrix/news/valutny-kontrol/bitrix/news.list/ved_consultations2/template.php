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
<? //debugg($arResult["PROPERTIES"]) ?>
<??>
<section class="consultations-tileblock">
    <h3 class="consultations-tileblock__header"><?= $arResult["PROPERTY_HEADER"] ?></h3>
    <div class="consultations-tileblock__grid">
        <?/*?><div class="base-account-tileblock__grid--horline horline-1"></div>
        <div class="base-account-tileblock__grid--horline horline-2"></div><?*/?>
        <? foreach ($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]] as $key=>$arItem) : ?>
            <div class="consultations-tileblock__grid--item">
                <div class="consultations-tileblock__grid--item-box item-box-<?= $key ?>">
                    <div class="consultations-tileblock__grid--img">
                        <img
                                src="<?=CFile::GetPath($arItem["icon"])?>"
                                alt="иконка"
                                title="<?=$arItem["main"]?>"
                        />
                    </div>
                    <h4 class="consultations-tileblock__grid--title"><?= $arItem["main"]; ?></h4>
                    <p class="consultations-tileblock__grid--subtitle">
                        <? if ($arItem["dop"]) : ?>
                            <span><?= $arItem["dop"]; ?></span>
                        <? endif; ?>
                    </p>
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