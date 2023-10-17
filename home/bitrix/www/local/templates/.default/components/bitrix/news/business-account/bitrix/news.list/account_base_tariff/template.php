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
<??>
<section class="base-account-tileblock">
    <ul class="base-account-tileblock__grid">
        <div class="base-account-tileblock__grid--horline horline-1"></div>
        <div class="base-account-tileblock__grid--horline horline-2"></div>
        <? foreach ($arResult["ITEMS"] as $key=>$arItem) : ?>
            <?
            $this->AddEditAction($arResult["ITEMS"][$key]['ID'], $arResult["ITEMS"][$key]['EDIT_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][0]["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arResult["ITEMS"][$key]['ID'], $arResult["ITEMS"][$key]['DELETE_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][0]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <? if($arItem["ID"] == $arParams["BASE_TARIFF_PARAM"][0]) : ?>
                <li class="base-account-tileblock__grid--item" id="<?=$this->GetEditAreaId($arResult["ITEMS"][$key]['ID']);?>">
                    <div class="base-account-tileblock__grid--item-box box-1">
                        <h3 class="base-account-tileblock__grid--title"><?= $arItem["~PREVIEW_TEXT"]; ?></h3>
                        <p class="base-account-tileblock__grid--subtitle">
                            <span><?= $arItem["PROPERTIES"]["ATT_BA_VOLUME"]["~VALUE"]; ?></span>
                        </p><?//debugg($arItem["PROPERTIES"])?>
                    </div>
                    <div class="base-account-tileblock__grid--item-box box-2">
                        <div class="base-account-tileblock__grid--brief">
                            <p class="brief-title"><?= $arItem["PROPERTIES"]["ATT_BA_PAYMENTS"]["~NAME"]; ?></p>
                            <div class="brief-text">
                                <span><?= $arItem["PROPERTIES"]["ATT_BA_PAYMENTS"]["~VALUE"]; ?></span>
                                <?if ($arItem["PROPERTIES"]["ATT_BA_PAYMENTS"]["DESCRIPTION"]) : ?>
                                    <span class="text--addition"><?= $arItem["PROPERTIES"]["ATT_BA_PAYMENTS"]["~DESCRIPTION"]; ?></span>
                                <? endif; ?>
                            </div>
                        </div>
                        <div class="base-account-tileblock__grid--brief">
                            <p class="brief-title"><?= $arItem["PROPERTIES"]["ATT_BA_CASH_IN"]["~NAME"]; ?></p>
                            <div class="brief-text">
                                <span><?= $arItem["PROPERTIES"]["ATT_BA_CASH_IN"]["~VALUE"]; ?></span>
                                <?if ($arItem["PROPERTIES"]["ATT_BA_CASH_IN"]["DESCRIPTION"]) : ?>
                                    <span class="text--addition"><?= $arItem["PROPERTIES"]["ATT_BA_CASH_IN"]["~DESCRIPTION"]; ?></span>
                                <? endif; ?>
                            </div>
                        </div>
                        <div class="base-account-tileblock__grid--brief">
                            <p class="brief-title"><?= $arItem["PROPERTIES"]["ATT_BA_CASH_OUT"]["~NAME"]; ?></p>
                            <div class="brief-text">
                                <span><?= $arItem["PROPERTIES"]["ATT_BA_CASH_OUT"]["~VALUE"]; ?></span>
                                <?if ($arItem["PROPERTIES"]["ATT_BA_CASH_OUT"]["DESCRIPTION"]) : ?>
                                    <span class="text--addition"><?= $arItem["PROPERTIES"]["ATT_BA_CASH_OUT"]["~DESCRIPTION"]; ?></span>
                                <? endif; ?>
                            </div>
                        </div>
                        <div class="base-account-tileblock__grid--brief">
                            <p class="brief-title"><?= $arItem["PROPERTIES"]["ATT_BA_COMISSION2"]["~NAME"]; ?></p>
                            <div class="brief-text brief-text--special">
                                <span><?= $arItem["PROPERTIES"]["ATT_BA_COMISSION2"]["~VALUE"]; ?></span>
                                <?if ($arItem["PROPERTIES"]["ATT_BA_COMISSION2"]["DESCRIPTION"]) : ?>
                                    <span class="text--addition"><?= $arItem["PROPERTIES"]["ATT_BA_COMISSION2"]["~DESCRIPTION"]; ?></span>
                                <? endif; ?>
                                <div class="brief-text--note js-show-notetext">
                                    <div class="brief-text--symbol">i</div>
                                    <div class="brief-text--subline">
                                        <span>При подклчении Онлайн-банка. Без подключения – 2 200 ₽ в месяц.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="base-account-tileblock__grid--brief base-account-tileblock__grid--brief-link">
                            <a href="#fBusinessAccountForm" class="v21-button-2022 base-account-tileblock__grid__button js-base-account__button">
                                <span>Открыть счёт</span>
                            </a>
                        </div>
                    </div>
                </li>
            <? endif; ?>
        <? endforeach; ?>
    </ul>
</section>
<??>

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
