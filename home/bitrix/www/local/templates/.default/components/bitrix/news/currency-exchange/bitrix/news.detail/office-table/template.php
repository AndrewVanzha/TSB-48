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
<?php
//debugg($_SERVER);
$cityID = 399; // moskva
if (!empty($_SESSION['city'])) {
    $cityID = $_SESSION['city'];
}
$cityCode = $arParams['CITY_CODE'];
$currencyCode = $arParams['CURRENCY'];
//debugg($arResult);

foreach ($arResult['OFFICES'] as $arItem) {
    if ($arResult['PROPERTIES']['ATT_CODE']['VALUE'] == $arItem['PROPERTY_ATT_CODE_VALUE']) {
        $arOffice = $arItem;
    }
}
$officeCode = $arOffice['INT_OFFICE_CODE'];

$title_h1 = ($arOffice['PROPERTY_ATT_NAME_WHERE_VALUE'])? $arOffice['PROPERTY_ATT_NAME_WHERE_VALUE'] : $arOffice['NAME'];
$APPLICATION->SetTitle("Обмен валюты в " . $title_h1);
$APPLICATION->SetPageProperty("title", "Обмен валют в " . $title_h1 . " | АКБ «ТрансСтройБанк»");

?>
<section class="v21-obmen-valyut--top">
    <div class="v21-obmen-valyut--top_left">
        <h1> Обмен валюты в <?= $title_h1 ?></h1>
    </div>
    <div class="v21-obmen-valyut--top_right">
        <div class="v21-obmen-valyut--top_right__link">
            <a href="<?=$arParams['BACK_PATH_URI']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M1.79883 6.16667L11.7988 6.16667V11.5H8.46549M1.79883 6.16667L5.79883 10.8333M1.79883 6.16667L5.79883 1.5" stroke="#00345E" stroke-width="1.7"/>
                </svg>
                <span>Вернуться к списку офисов</span>
            </a>
        </div>
        <div class="v21-obmen-valyut--top_right__box">
            <? if ($arOffice['NAME'] != 'iSimple') :
                $office_name = $arOffice['NAME']; ?>
                <div class="v21-obmen-valyut--top_right__textbox">
                    <p class="js-v21-intro-card" data-office="<?=$arOffice['ID']?>">Контакты</p>
                    <p class="v21-p--address"><?= $arOffice['PROPERTY_ATT_ADDRESS_VALUE']; ?></p>
                    <p>
                        <span class="v21-p--hours_add"><?= $arOffice['PROPERTY_ATT_OFFICE_HOURS_VALUE'] . ' | '; ?></span>
                        <a href="tel:<?= $arOffice['PROPERTY_ATT_PHONE_LINK_VALUE']; ?>"><?= $arOffice['PROPERTY_ATT_PHONE_VALUE']; ?></a>
                    </p>
                </div>
                <?/* else:
                        $office_name = 'ТСБ-онлайн'; ?>
                        <p class="js-v21-intro-card" data-office="<?=$arOffice['ID']?>" data-city="<?=$arResult['CITY']['ID']?>" data-num="<?=$key?>"><?= $office_name?></p>
                        <?*/?>
                <div class="v21-obmen-valyut--top_right__geobox">
                    <div class="v21-obmen-valyut--top_right__geobox_link js-select-yandex-geobox"
                         data-office="<?=$arOffice['ID']?>"
                         data-position="<?=$arOffice['PROPERTY_ATT_YANDEX_POS_VALUE']?>"
                    >
                        <a href="<?=$arOffice["PROPERTY_ATT_YANDEX_LOCATION_VALUE"]?>" target="_blank">
                            <img src="/images/Yandex_icon.svg" alt="яндекс карта">
                            <span>Яндекс.Карты</span>
                        </a>
                        <??>
                    </div>
                    <div class="v21-obmen-valyut--top_right__geobox_link js-select-gis-geobox"
                         data-office="<?=$arOffice['ID']?>"
                         data-position="<?=$arOffice['PROPERTY_ATT_YANDEX_POS_VALUE']?>"
                    >
                        <a href="<?=$arOffice["PROPERTY_ATT_2GIS_LOCATION_VALUE"]?>" target="_blank">
                            <img src="/images/2GIS_icon.svg" alt="2gis карта">
                            <span>2ГИС</span>
                        </a>
                    </div>
                </div>
            <? endif; ?>

        </div>
    </div>
    <div class="v21-obmen-valyut--undertop">
        <div class="v21-obmen-valyut--undertop_left">
            <div class="v21-obmen-valyut--top_right__horline horline1"></div>
            <div class="v21-obmen-valyut--top_right__horline horline2"></div>
            <h3>Скидка на конвертацию</h3>
            <p>Чем выше суммарный объём конвертации, тем выгоднее курс</p>
        </div>
        <div class="v21-obmen-valyut--undertop_right">
            <h3>Продаём и выкупаем</h3>
            <p>Мы не только продадим, но и выкупим у вас редкую иностранную валюту по лучшему курсу</p>
            <div class="v21-obmen-valyut--top_right__horline horline3"></div>
        </div>
    </div>
</section>

<div class="v21-section v21-section-obmen-valyut-detail">
    <div class="currency">
        <section class="currency-table">
            <div class="currency-table--top">
                <p>Данные на <?= FormatDate("H:i, j F Y", $arResult['COURSES']['time']) ?>, <?=$arResult['CITY']['NAME']?></p>
            </div>
            <div class="currency-table--wrap">
                <? if(isset($arResult['COURSES']['tsb_curr'][$officeCode])) : ?>
                    <div class="exchange-grid-table js-currency-table">
                        <div class="grid-table-padding exchange-table--header">
                            <div class="exchange-table--header_currency"><?= GetMessage("CURRENCY") ?></div>
                            <div class="exchange-table--header_code"><?= GetMessage("CURRENCY_CODE") ?></div>
                            <div class="exchange-table--header_purchase"><?= GetMessage("PURCHASE") ?></div>
                            <div class="exchange-table--header_sale"><?= GetMessage("SALE") ?></div>
                            <div class="exchange-table--header_cbrf"><?= GetMessage("CBRF") ?></div>
                        </div>
                    </div>
                    <? foreach ($arResult['COURSES']['tsb_curr'][$officeCode]['currency'] as $curr_code=>$arCur) : ?>
                        <div class="grid-table-padding grid-table grid-row">
                            <div class="grid-cell grid-cell--currency">
                                <div class="grid-cell--title">
                                    <? if ($arResult['TSB_CURRENCIES'][$curr_code]['UF_CURR_TEXT_RU2'] == 'Фунт стерлингов' && $officeCode == 10907) : // Костыль для ДО «Братиславская» ?>
                                        <div><?= $arResult['TSB_CURRENCIES'][$curr_code]['UF_CURR_TEXT_RU2'].', в т.ч. шотландский' ?></div>
                                    <? else: ?>
                                        <div><?= $arResult['TSB_CURRENCIES'][$curr_code]['UF_CURR_TEXT_RU2'] ?></div>
                                    <? endif; ?>
                                    <? if(!empty($arCur[0]['mark'])) :  // 0 ?>
                                        <?//debugg($arCur)?>
                                        <?/*?><span class="<?=($arCur['note'])? 'exchange-table__text-note js-show-notetext' : ''; ?>"> <?= $arCur['note'] // ??? ?></span><?*/?>
                                        <div class="exchange-table__text-note js-show-notetext">
                                            <div class="exchange-table__text-symbol">i</div>
                                            <div class="exchange-table__text-subline">
                                                <span><?= $arResult['TSB_CURRENCIES'][$curr_code]['UF_CURR_TEXT_RU2'] ?></span>
                                                <span class="exchange-table__text-subline--close js-subline--close">
                                                <img src="/images/close_crux.png" alt="закрывающий крестик">
                                            </span>
                                                <? if($arCur[0]['mark'] == 'cb') { // не котирует ЦБ?>
                                                    <span><?= GetMessage("CURS_LIST"); ?></span>
                                                <? } ?>
                                                <? if($arCur[0]['mark'] == 'multi') { // есть множитель ?>
                                                    <span><?= GetMessage("CURS_COUNT").' '.$arCur[0]['multi'].' '.$arResult['TSB_CURRENCIES'][$curr_code]['UF_CURR_TEXT_RU_PL']; ?></span>
                                                <? } ?>
                                                <? if($arCur[0]['mark'] == 'both') { // не котирует ЦБ и есть множитель ?>
                                                    <span><?= GetMessage("CURS_LIST") . ', ' . GetMessage("CURS_COUNT") . ' ' . $arCur[0]['multi'].' '.$arResult['TSB_CURRENCIES'][$curr_code]['UF_CURR_TEXT_RU_PL']; ?></span>
                                                <? } ?>
                                            </div>
                                        </div>
                                    <? endif; ?>
                                </div>
                            </div>

                            <div class="v21-grid-cell v21-grid-cell--code">
                                <span><?= $curr_code ?></span>
                            </div>

                            <? $classColorText = " exchange-table__value--buy";  // 2 ?>
                            <div class="grid-cell grid-cell--buy">
                                <div class="grid-cell--buy_name">Покупка</div>
                                <div class="grid-cell--buy_value<?= $classColorText ?>">
                                    <span class="exchange-table__value--buy-val"><?= number_format((float)$arCur[0]['buy'], 2, '.', '') ?></span>
                                    <? if ($arCur[0]['buy_move'] == '>') { ?>
                                        <svg width="10" height="10" class="exchange-table__icon">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                        </svg>
                                    <? } ?>
                                    <? if ($arCur[0]['buy_move'] == '<') { ?>
                                        <svg width="10" height="10" class="exchange-table__icon">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                        </svg>
                                    <? } ?>
                                    <? if ($arCur[0]['buy_move'] == '=') { ?>
                                        <span class="exchange-table__icon equal-sign">=</span>
                                    <? } ?>
                                </div>
                            </div>

                            <? $classColorText = " exchange-table__value--sell";  // 3 ?>
                            <div class="grid-cell grid-cell--sell">
                                <div class="grid-cell--sell_name">Продажа</div>
                                <div class="grid-cell--sell_value<?= $classColorText ?>">
                                    <span class="exchange-table__value--sell-val"><?= number_format((float)$arCur[0]['sell'], 2, '.', '') ?></span>
                                    <? if ($arCur[0]['sell_move'] == '>') { ?>
                                        <svg width="10" height="10" class="exchange-table__icon">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                        </svg>
                                    <? } ?>
                                    <? if ($arCur[0]['sell_move'] == '<') { ?>
                                        <svg width="10" height="10" class="exchange-table__icon">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                        </svg>
                                    <? } ?>
                                    <? if ($arCur[0]['sell_move'] == '=') { ?>
                                        <span class="exchange-table__icon equal-sign">=</span>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="grid-cell grid-cell--cbrf">
                                <div class="grid-cell--cbrf_name">ЦБ РФ</div>
                                <div class="grid-cell--cbrf_value">
                                    <?//debugg($arResult['COURSES']['cbr'][$curr_code])?>
                                    <? if($arResult['COURSES']['cbr'][$curr_code]) :  // 4 ?>
                                        <span><?= number_format((float)$arResult['COURSES']['cbr'][$curr_code]['course'], 2, '.', '') ?></span>
                                        <? if ($arResult['COURSES']['cbr'][$curr_code]['status'] == '>') { ?>
                                            <svg width="10" height="10" class="v21-exchange-table__icon">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                            </svg>
                                        <? } ?>
                                        <? if ($arResult['COURSES']['cbr'][$curr_code]['status'] == '<') { ?>
                                            <svg width="10" height="10" class="v21-exchange-table__icon">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                            </svg>
                                        <? } ?>
                                        <? if ($arResult['COURSES']['cbr'][$curr_code]['status'] == '=') { ?>
                                            <span class="v21-exchange-table__icon v21-equal-sign">=</span>
                                        <? } ?>
                                    <? else: ?>
                                        <span> </span>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>

                <? endif; ?>

            </div>

        </section>
        <?// echo json_encode($arResult); ?>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            const check_notes_text = document.querySelectorAll('.js-show-notetext');
            /*$('.js-show-notetext').on('click', function () {
                //console.log($(this));
                //console.log($(this).find('.exchange-table__text-subline'));
                $(this).find('.exchange-table__text-subline').toggleClass('exchange-table__text-subline--show');
            });*/

            $('.js-show-notetext').hover(
                function() { $(this).find('.exchange-table__text-subline').addClass("exchange-table__text-subline--show"); },
                function() { $(this).find('.exchange-table__text-subline').removeClass("exchange-table__text-subline--show"); }
            );

        });
    </script>
</div>
