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
<?// debugg($arResult) ?>
<?// debugg($arResult["ITEMS"]) ?>

<? if($arParams["DISPLAY_PREVIEW_TEXT"]!="N"): ?>
    <div class="template-topblock">
        <?/*?><section class="template-topblock"><?*/?>
            <?/*?><div class="template-tileblock__grid--horline horline-1"></div>
            <div class="template-tileblock__grid--verline verline-1"></div><?*/?>
            <div class="template-topblock__block">
                <? if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]): ?>
                    <h1 class="template-topblock__header"><?= $arResult["~NAME"] ?></h1>
                <? endif; ?>

                <h3 class="template-topblock__content"><?echo $arResult["~DESCRIPTION"]; ?></h3>
                <div class="template-topblock__buttons">
                    <a href="#fValutnyKontrolForm" class="v21-button-2022 template-topblock__button button-1 js-valutny-kontrol__button">
                        <span>Получить консультацию</span>
                    </a>
                </div>
            </div>
            <?if($arParams["DISPLAY_PICTURE"]!="N"):?>
                <? if ($arResult["SECTION"]["PATH"][1366]) : ?>
                    <div class="template-topblock__image template-topblock__image--1366">
                        <img
                                src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][1366]["PICTURE"])?>"
                                alt="картинка"
                                title="<?=$arResult["NAME"]?>"
                        />
                    </div>
                <? endif; ?>
                <? if ($arResult["SECTION"]["PATH"][1024]) : ?>
                    <div class="template-topblock__image template-topblock__image--1024">
                        <img
                                src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][1024]["PICTURE"])?>"
                                alt="картинка"
                                title="<?=$arResult["NAME"]?>"
                        />
                    </div>
                <? endif; ?>
                <? if ($arResult["SECTION"]["PATH"][768]) : ?>
                    <div class="template-topblock__image template-topblock__image--768">
                        <img
                                src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][768]["PICTURE"])?>"
                                alt="картинка"
                                title="<?=$arResult["NAME"]?>"
                        />
                    </div>
                <? endif; ?>
                <? if ($arResult["SECTION"]["PATH"][480]) : ?>
                    <div class="template-topblock__image template-topblock__image--480">
                        <img
                                src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][480]["PICTURE"])?>"
                                alt="картинка"
                                title="<?=$arResult["NAME"]?>"
                        />
                    </div>
                <? endif; ?>
                <? if ($arResult["SECTION"]["PATH"][320]) : ?>
                    <div class="template-topblock__image template-topblock__image--320">
                        <img
                                src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][320]["PICTURE"])?>"
                                alt="картинка"
                                title="<?=$arResult["NAME"]?>"
                        />
                    </div>
                <? endif; ?>
                <?/*?>
                <div class="template-topblock__image template-topblock__image--320">
                    <img
                            src="<?=CFile::GetPath($arResult["SECTION"]["PATH"][0]["PICTURE_5"])?>"
                            alt="картинка"
                            title="<?=$arResult["SECTION"]["PATH"][0]["~NAME"]?>"
                    />
                </div>
                <?*/?>
            <?endif?>
        <?/*?></section><?*/?>
    </div>

    <script>
        $(document).ready(function () {
            $('.js-valutny-kontrol__button').on('click', function() {
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

<?/*?>
<section class="business-account-tileblock">
    <div class="business-account-tileblock__topbox">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="74" height="30" viewBox="0 0 74 30" fill="none">
                                    <path d="M0.908203 0H73.9082V30H0.908203L11.9082 15L0.908203 0Z" fill="url(#paint0_linear_2474_2255)"/>
                                    <path d="M28.0522 15.288L24.5482 9.8H27.1082L29.3322 13.544L31.5562 9.8H34.0202L30.5322 15.192L34.4042 21H31.8282L29.2682 16.952L26.6762 21H24.2122L28.0522 15.288ZM45.6643 9.8V21H43.4883V11.448L39.4723 21H35.9843V9.8H38.1763V19.352L42.1763 9.8H45.6643ZM47.2758 9.8H56.4438V11.64H52.9878V21H50.7478V11.64H47.2758V9.8Z" fill="white"/>
                                    <defs>
                                        <linearGradient id="paint0_linear_2474_2255" x1="73.9082" y1="20" x2="-3.09179" y2="3" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#A58A57"/>
                                            <stop offset="1" stop-color="#CEBC9B"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <?/*?><svg xmlns="http://www.w3.org/2000/svg" width="73" height="30" viewBox="0 0 73 30" fill="none">
                                    <path d="M0 0H73V30H0L11 15L0 0Z" fill="url(#paint0_linear_2460_3330)"/>
                                    <defs>
                                        <linearGradient id="paint0_linear_2460_3330" x1="73" y1="20" x2="-4" y2="3" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#A58A57"/>
                                            <stop offset="1" stop-color="#CEBC9B"/>
                                        </linearGradient>
                                    </defs>
                                </svg><?*//*?>
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
                        <a href="#fValutnyKontrolForm" class="v21-button-2022 business-account-tileblock__grid__button js-business-account__button">
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
<?*/?>
