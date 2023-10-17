<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<?
//debugg($arParams);
//debugg($arResult);
//debugg($arResult['COURSES']);

$currencyCode = 'USD';
$officeCode = '10013';
if(isset($_GET['currency'])) {
    $currencyCode = htmlspecialchars($_GET['currency']);
}
if(isset($_GET['office'])) {
    $officeCode = htmlspecialchars($_GET['office']);
}

//debugg($currencyTitle);
//debugg($currencyCode);
?>
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
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //const check_notes_text = document.querySelectorAll('.js-show-notetext');
        //$('.js-show-notetext').on('click', function () {
        //    $(this).find('.exchange-table__text-subline').toggleClass('exchange-table__text-subline--show');
        //});

        $('.js-show-notetext').hover(
            function() { $(this).find('.exchange-table__text-subline').addClass("exchange-table__text-subline--show"); },
            function() { $(this).find('.exchange-table__text-subline').removeClass("exchange-table__text-subline--show"); }
        );

    });
</script>
