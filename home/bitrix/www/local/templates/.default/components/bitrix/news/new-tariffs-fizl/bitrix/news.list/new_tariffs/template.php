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
<? if (isset($arResult["ITEMS"][0]["PROPERTIES"])) : ?>
    <section class="v21-section v21-section-top">
        <div class="tariff-section--topblock">
            <div class="tariff-section--topblock__content">
                <? if($arResult["ITEMS"][0]["PROPERTIES"]["ATT_TARIFFS_PAGE_HEADER"]["VALUE"]): ?>
                    <h1 class="tariff-section--topblock__header"><?= $arResult["ITEMS"][0]["PROPERTIES"]["ATT_TARIFFS_PAGE_HEADER"]["~VALUE"] ?></h1>
                <? endif; ?>
                <? if($arResult["SECTION"]["PATH"][0]["DESCRIPTION"]): ?>
                    <h3 class="tariff-section--topblock__subheader"><?= $arResult["SECTION"]["PATH"][0]["~DESCRIPTION"] ?></h3>
                <? endif; ?>
                <? if($arResult["ITEMS"][0]["PROPERTIES"]["ATT_DATE"]["VALUE"]): ?>
                    <div class="tariff-section--topblock__date">Тарифы вступят в силу с <i><?= $arResult["ITEMS"][0]["PROPERTIES"]["ATT_DATE"]["~VALUE"] ?></i></div>
                <? endif; ?>
            </div>
            <div class="tariff-section--topblock__aside">
                <div class="tariff-section--topblock__aside--wrap">
                    <div class="tariff-section-tileblock__horline horline-1"></div>
                    <div class="tariff-section-tileblock__horline horline-2"></div>

                    <div class="tariff-section--topblock__doc" id="tariff-section--topblock__doc">
                        <a href="<?= CFile::GetPath($arResult["ITEMS"][0]["PROPERTIES"]["ATT_DOCUMENTS"]["VALUE"][0]) ?>" class="v21-document v21-link tariff-section--topblock__link" target="_blank">
                            <div class="tariff-section--topblock__img">
                                <img src="/images/paper.png" alt="иконка документов">
                            </div>
                            <div class="tariff-section--topblock__download">
                                <span class="v21-link__text download--text">Скачать</span>
                                <svg width="11" height="12" class="download--icon">
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#download"></use>
                                </svg>
                            </div>
                        </a>
                    </div>

                    <? if ($arResult["ITEMS"][0]["PROPERTIES"]["ATT_DOCUMENTS_LIST"]["VALUE"]) : ?>
                        <div class="tariff-section--topblock__list">
                            <h4 class="tariff-section--topblock__list--header">Содержание документа</h4>
                            <ol class="tariff-section--topblock__list--list">
                                <? foreach ($arResult["ITEMS"][0]["PROPERTIES"]["ATT_DOCUMENTS_LIST"]["~VALUE"] as $item) : ?>
                                    <li><?=$item?></li>
                                <? endforeach; ?>
                            </ol>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="v21-section tariff-listing">
        <div class="tariff-listing--block">
            <h3 class="tariff-listing--header">Краткий перечень тарифов</h3>
            <div class="tariff-listing--wrap">
                <? foreach ($arResult["ITEMS"][0]["PROPERTIES"] as $arProperties) : ?>
                    <? $cond1 = $arProperties["ID"]>=785 && $arProperties["ID"]<=793; ?>
                    <? $cond2 = $arProperties["ID"]>=1031 && $arProperties["ID"]<=1032; ?>
                    <? $cond_total = $cond1 || $cond2; ?>
                    <? if ($cond_total && !empty($arProperties["VALUE"])) : ?>
                        <div class="tariff-listing--box">
                            <h4 class="tariff-listing--box__title"><?=$arProperties["~NAME"]?></h4>
                            <div class="tariff-listing--box__info">
                                <div class="tariff-listing--box__main"><?=$arProperties["~VALUE"]?></div>
                                <? if ($arProperties["DESCRIPTION"]) : ?>
                                    <div class="tariff-listing--box__dop"><?=$arProperties["~DESCRIPTION"]?></div>
                                <? endif; ?>
                            </div>
                        </div>
                    <? endif; ?>
                <? endforeach; ?>
            </div>

            <a href="<?= CFile::GetPath($arResult["ITEMS"][0]["PROPERTIES"]["ATT_DOCUMENTS"]["VALUE"][0]) ?>" class="tariff-listing--details" target="_blank">
                <span>Подробнее о тарифах </span>
                <svg class="tariff-listing--details__arrow" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 14 13" fill="none">
                    <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                </svg>
            </a>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('.js-tariff-listing--details').on('click', function() {
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
