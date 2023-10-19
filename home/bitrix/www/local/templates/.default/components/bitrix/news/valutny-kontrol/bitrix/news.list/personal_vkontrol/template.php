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
<?// debugg($arParams["SERVICES_BLOCK"]) ?>
<?// debugg($arResult["PROPERTIES"]) ?>
<??>
<section class="personal-vkontrol-tileblock">
    <h3 class="personal-vkontrol-tileblock__header"><?= $arResult["PROPERTY_HEADER"] ?></h3>
    <div class="personal-vkontrol-tileblock__grid">
        <div class="personal-vkontrol-tileblock__grid--textbox">
            <? foreach ($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]] as $key=>$arItem) : ?>
                <div class="personal-vkontrol-tileblock__grid--item">
                    <div class="personal-vkontrol-tileblock__grid--item-box box-1">
                        <h4 class="personal-vkontrol-tileblock__grid--title"><?= $arItem["main"]; ?></h4>
                        <p class="personal-vkontrol-tileblock__grid--subtitle">
                            <span><?= $arItem["dop"]; ?></span>
                        </p>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <div class="personal-vkontrol-tileblock__grid--imgbox">
            <?/* if ($arResult["PROPERTIES"]["PATH"]["icon"]) : ?>
                <div class="personal-vkontrol-topblock__image personal-vkontrol-topblock__image--1366">
                    <img
                            src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][1366]["icon"])?>"
                            alt="картинка"
                            title="<?=$arResult["NAME"]?>"
                    />
                </div>
            <? endif; */?>
            <? if ($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]][3]["icon"]) : ?>
                <div class="personal-vkontrol-topblock__image personal-vkontrol-topblock__image--1024">
                    <img
                            src="<?=CFile::GetPath($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]][3]["icon"])?>"
                            alt="картинка"
                            title="<?=$arResult["NAME"]?>"
                    />
                </div>
            <? endif; ?>
            <? if ($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]][2]["icon"]) : ?>
                <div class="personal-vkontrol-topblock__image personal-vkontrol-topblock__image--768">
                    <img
                            src="<?=CFile::GetPath($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]][2]["icon"])?>"
                            alt="картинка"
                            title="<?=$arResult["NAME"]?>"
                    />
                </div>
            <? endif; ?>
            <? if ($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]][1]["icon"]) : ?>
                <div class="personal-vkontrol-topblock__image personal-vkontrol-topblock__image--480">
                    <img
                            src="<?=CFile::GetPath($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]][1]["icon"])?>"
                            alt="картинка"
                            title="<?=$arResult["NAME"]?>"
                    />
                </div>
            <? endif; ?>
            <? if ($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]][0]["icon"]) : ?>
                <div class="personal-vkontrol-topblock__image personal-vkontrol-topblock__image--320">
                    <img
                            src="<?=CFile::GetPath($arResult["PROPERTIES"][$arParams['SERVICES_BLOCK'][0]][0]["icon"])?>"
                            alt="картинка"
                            title="<?=$arResult["NAME"]?>"
                    />
                </div>
            <? endif; ?>
        </div>
        <?/*?><div class="base-account-tileblock__grid--horline horline-1"></div>
    <div class="base-account-tileblock__grid--horline horline-2"></div><?*/?>
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