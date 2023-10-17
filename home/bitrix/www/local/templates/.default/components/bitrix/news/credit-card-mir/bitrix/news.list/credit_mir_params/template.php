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

<? if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["ITEMS"][0]["PREVIEW_TEXT"]): ?>
    <div class="v21-section">
        <div class="mir-section-topblock">
            <div class="mir-section-topblock__content">
                <? if($arParams["DISPLAY_NAME"]!="N" && $arResult["ITEMS"][0]["NAME"]): ?>
                    <h1 class="mir-section-topblock__header"><?= $arResult["ITEMS"][0]["NAME"] ?></h1>
                <? endif; ?>

                <h3 class="mir-section-topblock__content"><?echo $arResult["ITEMS"][0]["PREVIEW_TEXT"]; ?></h3>
                <!--div class="v21-ved-contracts__wrap"></div!-->
                <a href="#fMirCreditCardForm" class="v21-button-2022 mir-section-topblock__button js-mir-section__button">
                    <span>Заказать карту</span>
                </a>
            </div>
            <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["ITEMS"][0]["PREVIEW_PICTURE"])):?>
                <div class="mir-section-topblock__image mir-section-topblock__image--dt">
                    <img
                        src="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["SRC"]?>"
                        <?/*?>width="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["WIDTH"]?>"
                        height="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["HEIGHT"]?>"<?*/?>
                        alt="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["ALT"]?>"
                        title="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["TITLE"]?>"
                    />
                </div>
                <div class="mir-section-topblock__image mir-section-topblock__image--mobile">
                    <img src="/images/Creditcard_MIR_top.png" alt="Кредитная карта МИР">
                </div>
            <?endif?>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.js-mir-section__button').on('click', function() {
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
<!--div class="v21-section v21-section--border"!-->
<div class="v21-section">
    <div class="mir-section-tileblock">
        <!--ul class="mir-section-tileblock__grid v21-grid"-->
        <ul class="mir-section-tileblock__grid">
            <div class="mir-section-tileblock__grid--horline horline-1"></div>
            <div class="mir-section-tileblock__grid--horline horline-2"></div>
            <div class="mir-section-tileblock__grid--horline horline-3"></div>
            <div class="mir-section-tileblock__grid--verline verline-1"></div>
            <div class="mir-section-tileblock__grid--verline verline-2"></div>
            <? foreach ($arResult["ITEMS"][0]["PROPERTIES"] as $code=>$arValue) : ?>
                <?
                $this->AddEditAction($arResult["ITEMS"][0]['ID'], $arResult["ITEMS"][0]['EDIT_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][0]["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arResult["ITEMS"][0]['ID'], $arResult["ITEMS"][0]['DELETE_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][0]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <? if(in_array($arValue["ID"], $arParams["CREDIT_CARD_PARAMS"])): ?>
                    <?/*?><li class="v21-benefits__grid-item v21-grid__item v21-grid__item--1x2@md v21-grid__item--1x3@lg mir-section-tileblock__grid-item--docs" id="<?=$this->GetEditAreaId($arResult["ITEMS"][0]['ID']);?>"><?*/?>
                    <li class="mir-section-tileblock__grid--item" id="<?=$this->GetEditAreaId($arResult["ITEMS"][0]['ID']);?>">
                        <div class="mir-section-tileblock__grid--item-box">
                            <div class="mir-section-tileblock__grid--text">
                                <h3 class="mir-section-tileblock__grid--title"><?= $arValue["~NAME"]; ?></h3>
                                <p class="mir-section-tileblock__grid--subtitle"><?= $arValue["~VALUE"][0]; ?></p>
                                <p class="mir-section-tileblock__grid--brief"><?= $arValue["~DESCRIPTION"][0]; ?></p>
                            </div>
                        </div>
                    </li>
                <? endif; ?>
            <? endforeach; ?>
        </ul>
    </div>
    <?/*?><a href="https://transstroybank.ru/2022/10/Сборник тарифных планов по банковским картам для физических лиц (действуют с 03.10.2022г.).pdf" target="_blank" class="mir-section-details"><?*/?>
    <a href="<?= CFile::GetPath($arResult["ITEMS"][0]["PROPERTIES"]["ATT_TARIFF_DOC"]["VALUE"]) ?>" target="_blank" class="mir-section-details">
        <span>Подробнее о тарифе </span>
        <svg class="mir-section-details__arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
            <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
        </svg>
    </a>
</div>
<??>
