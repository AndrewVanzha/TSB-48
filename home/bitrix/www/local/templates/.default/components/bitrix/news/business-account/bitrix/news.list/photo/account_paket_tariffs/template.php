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
<?// debugg($arResult["ITEMS"]) ?>

<? if($arParams["DISPLAY_PREVIEW_TEXT"]!="N"): ?>
    <div class="v21-section">
        <section class="business-account-topblock">
            <div class="business-account-tileblock__grid--horline horline-1"></div>
            <div class="business-account-tileblock__grid--verline verline-1"></div>
            <div class="business-account-topblock__block">
                <? if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]): ?>
                    <h1 class="business-account-topblock__header"><?= $arResult["NAME"] ?></h1>
                <? endif; ?>

                <h3 class="business-account-topblock__content"><?echo $arResult["SECTION"]["PATH"][0]["~DESCRIPTION"]; ?></h3>
                <a href="#fBusinessAccountForm" class="v21-button-2022 business-account-topblock__button js-business-account__button">
                    <span>Открыть счёт</span>
                </a>
            </div>
            <?if($arParams["DISPLAY_PICTURE"]!="N" && !empty($arResult["ITEMS"])):?>
                <div class="business-account-topblock__image business-account-topblock__image--dt">
                    <img
                        src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][0]["PICTURE"])?>"
                        <?/*?>width="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["WIDTH"]?>"
                        height="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["HEIGHT"]?>"<?*/?>
                        alt="картинка"
                        title="<?=$arResult["SECTION"]["PATH"][0]["~NAME"]?>"
                    />
                </div>
                <div class="business-account-topblock__image business-account-topblock__image--mobile">
                    <img src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][0]["PICTURE"])?>" alt="картинка">
                </div>
            <?endif?>
        </section>
    </div>

    <script>
        $(document).ready(function () {
            $('.js-business-account__button').on('click', function() {
                let href = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $(href).offset().top - 120
                }, {
                    duration: 800,   // по умолчанию «400»
                    easing: "linear" // по умолчанию «swing»
                });
                return false;
            });
        });
    </script>
<? endif; ?>

<??>
<section class="v21-section business-account-tileblock">
    <div class="business-account-tileblock__topbox">
        <div class="business-account-tileblock__topbox--left">
            <span class="figure-3-big">
                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="96" viewBox="0 0 61 96" fill="none">
<path d="M60.3082 64.6494C60.3082 83.3271 46.84 95.9059 27.0188 95.9059C18.1247 95.9059 8.72235 93.3647 3.64 90.3153L0.590588 71.0024L2.11529 70.6212C9.48471 83.7082 15.4565 91.9671 27.7812 91.9671C43.1553 91.9671 49.2541 79.8965 49.2541 65.1576C49.2541 48.2588 41.3765 39.7459 27.2729 39.7459C19.9035 39.7459 15.0753 42.16 11.0094 45.2094L9.23059 42.9224L45.1882 10.3953H5.03765L8.97647 0.992941H58.9106V2.77176L20.92 37.2047C23.5882 36.1882 26.6376 35.68 30.1953 35.68C45.9506 35.68 60.3082 45.4635 60.3082 64.6494Z" fill="#00345E"/>
                </svg>
            </span>
            <span class="figure-3-small">
                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="68" viewBox="0 0 44 68" fill="none">
<path d="M43.26 45.21C43.26 58.44 33.72 67.35 19.68 67.35C13.38 67.35 6.72 65.55 3.12 63.39L0.96 49.71L2.04 49.44C7.26 58.71 11.49 64.56 20.22 64.56C31.11 64.56 35.43 56.01 35.43 45.57C35.43 33.6 29.85 27.57 19.86 27.57C14.64 27.57 11.22 29.28 8.34 31.44L7.08 29.82L32.55 6.78H4.11L6.9 0.119995H42.27V1.38L15.36 25.77C17.25 25.05 19.41 24.69 21.93 24.69C33.09 24.69 43.26 31.62 43.26 45.21Z" fill="#00345E"/>
                </svg>
            </span>
            <span>комплексных решения</span>
        </div>
        <div class="business-account-tileblock__topbox--right">Для начинающих и уже набравших оборот предпринимателей</div>
    </div>
    <ul class="business-account-tileblock__grid">
        <? foreach ($arResult["ITEMS"] as $key=>$arItem) : ?>
            <?
            $this->AddEditAction($arResult["ITEMS"][$key]['ID'], $arResult["ITEMS"][$key]['EDIT_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][0]["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arResult["ITEMS"][$key]['ID'], $arResult["ITEMS"][$key]['DELETE_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][0]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <? if($arItem["ID"] != $arParams["BASE_TARIFF_PARAM"][0]) : ?>
                <li class="business-account-tileblock__grid--item" id="<?=$this->GetEditAreaId($arResult["ITEMS"][$key]['ID']);?>">
                    <div class="business-account-tileblock__grid--item-box box-1">
                        <h3 class="business-account-tileblock__grid--title"><?= $arItem["~PREVIEW_TEXT"]; ?></h3>
                        <p class="business-account-tileblock__grid--subtitle">
                            <span><?= $arItem["PROPERTIES"]["ATT_BA_VOLUME"]["~NAME"]; ?> </span>
                            <span><?= $arItem["PROPERTIES"]["ATT_BA_VOLUME"]["~VALUE"]; ?></span>
                        </p><?//debugg($arItem["PROPERTIES"])?>
                        <? if ($arItem["PROPERTIES"]["ATT_BA_HIT"]["VALUE"] == 'Y') : ?>
                            <div class="business-account-tileblock__grid--hit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="73" height="30" viewBox="0 0 73 30" fill="none">
                                    <path d="M0 0H73V30H0L11 15L0 0Z" fill="url(#paint0_linear_2460_3330)"/>
                                    <defs>
                                        <linearGradient id="paint0_linear_2460_3330" x1="73" y1="20" x2="-4" y2="3" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#A58A57"/>
                                            <stop offset="1" stop-color="#CEBC9B"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                        <? endif; ?>
                    </div>
                    <div class="business-account-tileblock__grid--item-box box-2">
                        <div class="business-account-tileblock__grid--brief">
                            <p class="brief-title"><?= $arItem["PROPERTIES"]["ATT_BA_PAYMENTS"]["~NAME"]; ?></p>
                            <div class="brief-text">
                                <span><?= $arItem["PROPERTIES"]["ATT_BA_PAYMENTS"]["~VALUE"]; ?></span>
                                <?if ($arItem["PROPERTIES"]["ATT_BA_PAYMENTS"]["DESCRIPTION"]) : ?>
                                    <span class="text--addition"><?= $arItem["PROPERTIES"]["ATT_BA_PAYMENTS"]["~DESCRIPTION"]; ?></span>
                                <? endif; ?>
                            </div>
                        </div>
                        <div class="business-account-tileblock__grid--brief">
                            <p class="brief-title"><?= $arItem["PROPERTIES"]["ATT_BA_CASH_IN"]["~NAME"]; ?></p>
                            <div class="brief-text">
                                <span><?= $arItem["PROPERTIES"]["ATT_BA_CASH_IN"]["~VALUE"]; ?></span>
                                <?if ($arItem["PROPERTIES"]["ATT_BA_CASH_IN"]["DESCRIPTION"]) : ?>
                                    <span class="text--addition"><?= $arItem["PROPERTIES"]["ATT_BA_CASH_IN"]["~DESCRIPTION"]; ?></span>
                                <? endif; ?>
                            </div>
                        </div>
                        <div class="business-account-tileblock__grid--brief">
                            <p class="brief-title"><?= $arItem["PROPERTIES"]["ATT_BA_CASH_OUT"]["~NAME"]; ?></p>
                            <div class="brief-text">
                                <span><?= $arItem["PROPERTIES"]["ATT_BA_CASH_OUT"]["~VALUE"]; ?></span>
                                <?if ($arItem["PROPERTIES"]["ATT_BA_CASH_OUT"]["DESCRIPTION"]) : ?>
                                    <span class="text--addition"><?= $arItem["PROPERTIES"]["ATT_BA_CASH_OUT"]["~DESCRIPTION"]; ?></span>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="business-account-tileblock__grid--item-box box-3">
                        <div class="business-account-tileblock__grid--price">
                            <p class="price-title"><?= $arItem["PROPERTIES"]["ATT_BA_COMISSION"]["~NAME"]; ?></p>
                            <div class="price-text">
                                <span><?= $arItem["PROPERTIES"]["ATT_BA_COMISSION"]["~VALUE"]; ?></span>
                                <?if ($arItem["PROPERTIES"]["ATT_BA_COMISSION"]["DESCRIPTION"]) : ?>
                                    <span class="text--addition"><?= $arItem["PROPERTIES"]["ATT_BA_COMISSION"]["~DESCRIPTION"]; ?></span>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="business-account-tileblock__grid--item-box box-4">
                        <a href="#fBusinessAccountForm" class="v21-button-2022 business-account-tileblock__grid__button js-business-account__button">
                            <span>Открыть счёт</span>
                        </a>
                        <a href="<?= $arItem["PROPERTIES"]["ATT_BA_DETAIL_LINK"]["VALUE"]; ?>" target="_blank" class="business-account-details">
                            <span>Подробнее </span>
                            <svg class="business-account-details__arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                            </svg>
                        </a>
                    </div>
                </li>
            <? endif; ?>
        <? endforeach; ?>
    </ul>
</section>
<??>
