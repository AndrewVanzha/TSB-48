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
    <section class="ved-consultation-tileblock">
        <?/*?><h3 class="ved-consultation-tileblock__header"><?= $arResult["PROPERTY_HEADER"]; ?></h3><?*/?>
        <div class="ved-consultation-tileblock__grid">
            <?/*?><div class="ved-consultation-tileblock__grid--horline horline-1"></div>
        <div class="ved-consultation-tileblock__grid--horline horline-2"></div><?*/?>
            <?/*?><?*/?>
            <? foreach ($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]] as $key=>$arItem) : ?>
                <div class="ved-consultation-tileblock__grid--item" >
                    <p class="ved-consultation-tileblock__grid--bird">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                            <path d="M5.66129 11.4147L0.995392 6.7488C0.721795 6.4752 0.721794 6.03161 0.995392 5.75802C1.26899 5.48442 1.71258 5.48442 1.98618 5.75802L5.66129 9.43313L14.0138 1.0806C14.2874 0.807 14.731 0.806999 15.0046 1.0806C15.2782 1.35419 15.2782 1.79778 15.0046 2.07138L5.66129 11.4147Z" fill="#00345E"/>
                        </svg>
                    </p>
                    <p class="ved-consultation-tileblock__grid--title"><?= $arItem["main"]; ?></p>
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