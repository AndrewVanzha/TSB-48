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
//debugg($arResult);
$currencyTitle = $arParams["CURRENCY"]; // первоначальный выбор
$currencyCode = $arParams["CURRENCY"];
?>
    <section class="currency-table">
        <div class="currency-table--top">
            <h2>Курс обмена <?=$arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU_GEN']?> в офисах Трансстройбанка</h2>
            <p>Данные на <?= FormatDate("H:i, j F Y", $arResult['COURSES']['time']) ?>, <?=$arResult['CITY']['NAME']?></p>
        </div>
        <div class="currency-table--wrap">
            <? foreach ($arResult['OFFICES'] as $key=>$arOffice) : ?>
                <?//debugg($arOffice) ?>
                <?//debugg($arResult['COURSES']['tsb'])?>
                <? if(isset($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']])) : ?>
                    <div class="currency-table--item">

                        <h3 class="currency-table--item__header"><?=$arOffice['NAME']?></h3>
                        <div class="currency-table--item__exchange">
                            <div class="currency-table--item__exchange_header <?= (isset($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]))? 'currency-table--item__exchange_header-bottom' : ''; ?>">
                                <div class="currency-table--item__exchange_name"><?= GetMessage("CURRENCY") ?></div>
                                <div class="currency-table--item__exchange_code"><?= GetMessage("CURRENCY_CODE") ?></div>
                                <div class="currency-table--item__exchange_purchase"><?= GetMessage("PURCHASE") ?></div>
                                <div class="currency-table--item__exchange_sale"><?= GetMessage("SALE") ?></div>
                                <div class="currency-table--item__exchange_cbrf"><?= GetMessage("CBRF") ?></div>
                            </div>

                            <? if(!empty($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['buy'])) {
                                $curr_buy_0 = number_format((float)$arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['buy'], 2, '.', '');
                            } else {
                                $curr_buy_0 = '';
                            } ?>
                            <? if(!empty($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['buy'])) {
                                $curr_buy_1 = number_format((float)$arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['buy'], 2, '.', '');
                            } ?>
                            <? if(!empty($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['sell'])) {
                                $curr_sell_0 = number_format((float)$arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['sell'], 2, '.', '');
                            } else {
                                $curr_sell_0 = '';
                            }
                            if(!empty($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['sell'])) {
                                $curr_sell_1 = number_format((float)$arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['sell'], 2, '.', '');
                            } ?>

                            <div class="currency-table--item__exchange_grid currency-table--item__exchange_gridrow js-currency-table--item__exchange_grid <?= (isset($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]))? 'currency-table--item__exchange_widerow_1' : ''; ?>" data-office="<?=$arOffice['PROPERTY_ATT_CODE_VALUE']?>" data-curr="<?=$currencyCode?>">
                                <?// debugg($arResult['TSB_CURRENCIES'][$currencyCode])?>
                                <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_name"><?// 0-0 ?>
                                    <div>
                                        <?
                                        if (!isset($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1])) {
                                            if ($arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU2'] == 'Фунт стерлингов' && $arOffice['NAME'] == 'ДО «Братиславская»') { // костыль ДО «Братиславская»
                                                echo $arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU2'].', в т.ч. шотландский и североирландский';
                                            } else {
                                                echo $arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU2'];
                                            }
                                        } else {
                                            echo $arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU2'] . ' (до ' . $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['volume'] . ')';
                                        }
                                        ?>
                                    </div>
                                    <? if(!empty($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['mark'])) : ?>
                                        <div class="exchange-table__text-note js-show-notetext">
                                            <div class="exchange-table__text-symbol">i</div>
                                            <div class="exchange-table__text-subline">
                                                <span><?= $arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU2'] ?></span>
                                                <span class="exchange-table__text-subline--close js-subline--close">
                                                <img src="/images/close_crux.png" alt="закрывающий крестик">
                                            </span>
                                                <? if($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['mark'] == 'cb') { // не котирует ЦБ?>
                                                    <span><?= GetMessage("CURS_LIST"); ?></span>
                                                <? } ?>
                                                <? if($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['mark'] == 'multi') { // есть множитель ?>
                                                    <span><?= GetMessage("CURS_COUNT").' '.$arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['multi'].' '.$arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU_PL']; ?></span>
                                                <? } ?>
                                                <? if($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['mark'] == 'both') { // не котирует ЦБ и есть множитель ?>
                                                    <span><?= GetMessage("CURS_LIST") . ', ' . GetMessage("CURS_COUNT") . ' ' . $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['multi'].' '.$arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU_GEN']; ?></span>
                                                <? } ?>
                                            </div>
                                        </div>
                                    <? endif; ?>
                                </div>

                                <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_code"><?// 0-1 ?>
                                    <?= $currencyCode ?>
                                </div>

                                <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_buy"><?// 0-2 ?>
                                    <??><div class="currency-table--item__exchange_buy--name">Покупка</div><??>
                                    <div class="currency-table--item__exchange_buy--value v21-exchange-table__value--buy">
                                        <?//debugg($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']])?>
                                        <span class="v21-exchange-table__value--buy-value"><?= $curr_buy_0 ?></span>
                                        <? if ($curr_buy_0 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['buy_move'] == '>') { ?>
                                            <svg width="10" height="10" class="v21-exchange-table__icon">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                            </svg>
                                        <? } ?>
                                        <? if ($curr_buy_0 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['buy_move'] == '<') { ?>
                                            <svg width="10" height="10" class="v21-exchange-table__icon">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                            </svg>
                                        <? } ?>
                                        <? if ($curr_buy_0 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['buy_move'] == '=') { ?>
                                            <span class="v21-exchange-table__icon v21-equal-sign">=</span>
                                        <? } ?>
                                    </div>
                                </div>

                                <? if (!$curr_sell_0 == '') : ?>
                                    <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_sell"><?// 0-3 ?>
                                        <??><div class="currency-table--item__exchange_sell--name">Продажа</div><??>
                                        <div class="currency-table--item__exchange_sell--value v21-exchange-table__value--sell">
                                            <span class="v21-exchange-table__value--sell-value"><?= $curr_sell_0 ?></span>
                                            <? if ($curr_sell_0 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['sell_move'] == '>') { ?>
                                                <svg width="10" height="10" class="v21-exchange-table__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                                </svg>
                                            <? } ?>
                                            <? if ($curr_sell_0 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['sell_move'] == '<') { ?>
                                                <svg width="10" height="10" class="v21-exchange-table__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                                </svg>
                                            <? } ?>
                                            <? if ($curr_sell_0 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][0]['sell_move'] == '=') { ?>
                                                <span class="v21-exchange-table__icon v21-equal-sign">=</span>
                                            <? } ?>
                                        </div>
                                    </div>
                                <? endif; ?>

                                <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_cbrf"><?// 0-4 ?>
                                    <??><div class="currency-table--item__exchange_cbrf--name">ЦБ РФ</div><??>
                                    <div class="currency-table--item__exchange_cbrf--value">
                                        <? if($arResult['COURSES']['cbr'][$currencyCode]) : ?>
                                            <span><?= number_format((float)$arResult['COURSES']['cbr'][$currencyCode]['course'], 2, '.', '') ?></span>
                                            <? if ($arResult['COURSES']['cbr'][$currencyCode]['status'] == '>') { ?>
                                                <svg width="10" height="10" class="v21-exchange-table__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                                </svg>
                                            <? } ?>
                                            <? if ($arResult['COURSES']['cbr'][$currencyCode]['status'] == '<') { ?>
                                                <svg width="10" height="10" class="v21-exchange-table__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                                </svg>
                                            <? } ?>
                                            <? if ($arResult['COURSES']['cbr'][$currencyCode]['status'] == '=') { ?>
                                                <span class="v21-exchange-table__icon v21-equal-sign">=</span>
                                            <? } ?>
                                        <? else: ?>
                                            <span> </span>
                                        <? endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?//debugg($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode])?>

                            <? if (isset($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1])) : ?>
                                <div class="currency-table--item__exchange_grid currency-table--item__exchange_gridrow js-currency-table--item__exchange_grid currency-table--item__exchange_widerow_2" data-office="<?=$arOffice['PROPERTY_ATT_CODE_VALUE']?>" data-curr="<?=$currencyCode?>">
                                    <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_name"><?// 1-0 ?>
                                        <? $curr_limit = intval($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['volume']) + 1 ?>
                                        <span><?= $arResult['TSB_CURRENCIES'][$currencyCode]['UF_CURR_TEXT_RU2'] . ' (более ' . $curr_limit . ')' ?></span>
                                    </div>

                                    <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_code"><?// 1-1 ?>
                                        <?= $currencyCode ?>
                                    </div>

                                    <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_buy"><?// 1-2 ?>
                                        <??><div class="currency-table--item__exchange_buy--name">Покупка</div><??>
                                        <div class="currency-table--item__exchange_buy--value v21-exchange-table__value--buy">
                                            <?//debugg($arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']])?>
                                            <span class="v21-exchange-table__value--buy-value"><?= $curr_buy_1 ?></span>
                                            <? if ($curr_buy_1 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['buy_move'] == '>') { ?>
                                                <svg width="10" height="10" class="v21-exchange-table__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                                </svg>
                                            <? } ?>
                                            <? if ($curr_buy_1 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['buy_move'] == '<') { ?>
                                                <svg width="10" height="10" class="v21-exchange-table__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                                </svg>
                                            <? } ?>
                                            <? if ($curr_buy_1 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['buy_move'] == '=') { ?>
                                                <span class="v21-exchange-table__icon v21-equal-sign">=</span>
                                            <? } ?>
                                        </div>
                                    </div>

                                    <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_sell"><?// 1-3 ?>
                                        <??><div class="currency-table--item__exchange_sell--name">Продажа</div><??>
                                        <div class="currency-table--item__exchange_sell--value v21-exchange-table__value--sell">
                                            <span class="v21-exchange-table__value--sell-value"><?= $curr_sell_1 ?></span>
                                            <? if ($curr_sell_1 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['sell_move'] == '>') { ?>
                                                <svg width="10" height="10" class="v21-exchange-table__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                                </svg>
                                            <? } ?>
                                            <? if ($curr_sell_1 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['sell_move'] == '<') { ?>
                                                <svg width="10" height="10" class="v21-exchange-table__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                                </svg>
                                            <? } ?>
                                            <? if ($curr_sell_1 != '' && $arResult['COURSES']['tsb'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'][$currencyCode][1]['sell_move'] == '=') { ?>
                                                <span class="v21-exchange-table__icon v21-equal-sign">=</span>
                                            <? } ?>
                                        </div>
                                    </div>

                                    <div class="currency-table--item__exchange_gridcell currency-table--item__exchange_cbrf"><?// 1-4 ?>
                                        <??><div class="currency-table--item__exchange_cbrf--name">ЦБ РФ</div><??>
                                        <div class="currency-table--item__exchange_cbrf--value">
                                            <? if($arResult['COURSES']['cbr'][$currencyCode]) : ?>
                                                <span><?= number_format((float)$arResult['COURSES']['cbr'][$currencyCode]['course'], 2, '.', '') ?></span>
                                                <? if ($arResult['COURSES']['cbr'][$currencyCode]['status'] == '>') { ?>
                                                    <svg width="10" height="10" class="v21-exchange-table__icon">
                                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#upValue"></use>
                                                    </svg>
                                                <? } ?>
                                                <? if ($arResult['COURSES']['cbr'][$currencyCode]['status'] == '<') { ?>
                                                    <svg width="10" height="10" class="v21-exchange-table__icon">
                                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#downValue"></use>
                                                    </svg>
                                                <? } ?>
                                                <? if ($arResult['COURSES']['cbr'][$currencyCode]['status'] == '=') { ?>
                                                    <span class="v21-exchange-table__icon v21-equal-sign">=</span>
                                                <? } ?>
                                            <? else: ?>
                                                <span> </span>
                                            <? endif; ?>
                                        </div>
                                    </div>
                                </div>

                            <? endif; ?>

                            <div class="currency-table--item__exchange_calculator">
                                <form action="" method="get" class="calculator-form">
                                    <div class="calculator-operation" data-office="<?=$arOffice['PROPERTY_ATT_CODE_VALUE']?>" data-curr="<?=$currencyCode?>">
                                        <ul class="calculator-operation--wrap">
                                            <li class="calculator-operation--buy">
                                                <label class="calculator-operation--radio">
                                                    <input type="radio" name="operation" value="buy" class="operation-box--word operation-box--word__active" checked hidden>
                                                    <span>Купить</span>
                                                </label>
                                            </li>
                                            <li class="calculator-operation--sell">
                                                <label class="calculator-operation--radio">
                                                    <input type="radio" name="operation" value="sell" class="operation-box--word operation-box--word__passive" hidden>
                                                    <span>Продать</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="calculator-window" data-office="<?=$arOffice['PROPERTY_ATT_CODE_VALUE']?>" data-curr="<?=$currencyCode?>">
                                        <div class="calculator-window--left">
                                            <div class="calculator-window--left__number">
                                                <input type="text" name="currNum" class="calculator-window--left__input js-calculator-window--left__input" placeholder="0">
                                            </div>
                                            <div class="calculator-window--left__code"><?= $currencyCode ?></div>
                                        </div>
                                        <div class="calculator-window--medium js-calculator-window--submit" data-office="<?=$arOffice['PROPERTY_ATT_CODE_VALUE']?>" data-curr="<?=$currencyCode?>">=</div>
                                        <div class="calculator-window--right">
                                            <div class="calculator-window--right__number">
                                                <input type="text" name="currNumRub" class="calculator-window--right__input js-calculator-window--right__input" placeholder="0">
                                            </div>
                                            <div class="calculator-window--right__code">RUB
                                                <?/*?>
                                                <select name="currency">
                                                    <?foreach ($arResult['COURSES']['tsb_curr'][$arOffice['PROPERTY_ATT_CODE_VALUE']]['list'] as $curr) : ?>
                                                        <option value="<?=$curr?>">
                                                            &nbsp;&nbsp;<?=$curr?>
                                                        </option>
                                                    <? endforeach; ?>
                                                </select>
                                                <?*/?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="currency-table--item__contacts">
                            <div class="currency-table--item__horline"></div>
                            <? if ($arOffice['NAME'] != 'iSimple') :
                                $office_name = $arOffice['NAME']; ?>
                                <div class="currency-table--item__textbox">
                                    <div class="currency-table--item__horline"></div>
                                    <h5 class="currency-table--item__subheader js-v21-intro-card" data-office="<?=$arOffice['ID']?>" data-city="<?=$arResult['CITY']['ID']?>" data-num="<?=$key?>">Контакты</h5>
                                    <div class="v21-p--address"><?= $arOffice['PROPERTY_ATT_ADDRESS_VALUE']; ?></div>
                                    <div>
                                        <span class="v21-p--hours_add"><?= $arOffice['PROPERTY_ATT_OFFICE_HOURS_VALUE'] . ' | '; ?></span>
                                        <a href="tel:<?= $arOffice['PROPERTY_ATT_PHONE_LINK_VALUE']; ?>"><?= $arOffice['PROPERTY_ATT_PHONE_VALUE']; ?></a>
                                    </div>
                                    <? if ($arOffice['PROPERTY_ATT_WORK_PAUSES_VALUE']) : ?>
                                        <div class="v21-p--pauses">
                                            <span>Технические перерывы</span>
                                            <? if (strpos($arOffice['PROPERTY_ATT_WORK_PAUSES_VALUE'], ',') == false) {
                                                $ar_pauses_time[0] = $arOffice['PROPERTY_ATT_WORK_PAUSES_VALUE'];
                                            } else {
                                                $ar_pauses_time = explode(',', $arOffice['PROPERTY_ATT_WORK_PAUSES_VALUE']);
                                            } ?>
                                            <ul class="v21-p--pauses__list">
                                                <? foreach ($ar_pauses_time as $iline) : ?>
                                                    <li><?= trim($iline) ?></li>
                                                <? endforeach; ?>
                                            </ul>
                                        </div>
                                    <? endif; ?>
                                    <div>
                                        <span class="v21-p--hours_add">Режим работы в праздничные дни <a href="/ofisy-i-bankomaty/">смотри тут</a></span>
                                    </div>
                                </div>
                                <?/* else:
                                    $office_name = 'ТСБ-онлайн'; ?>
                                    <p class="js-v21-intro-card" data-office="<?=$arOffice['ID']?>" data-city="<?=$arResult['CITY']['ID']?>" data-num="<?=$key?>"><?= $office_name?></p>
                                    <?*/?>
                                <div class="currency-table--item__geobox">
                                    <div class="currency-table--item__geobox_link js-select-yandex-geobox"
                                         data-office="<?=$arOffice['ID']?>"
                                         data-city="<?=$arResult['CITY']['ID']?>"
                                         data-position="<?=$arOffice['PROPERTY_ATT_YANDEX_POS_VALUE']?>"
                                    >
                                        <a href="<?=$arOffice["PROPERTY_ATT_YANDEX_LOCATION_VALUE"]?>" target="_blank">
                                            <img src="/images/Yandex_icon.svg" alt="яндекс карта">
                                            <span>Яндекс.Карты</span>
                                        </a>
                                        <??>
                                    </div>
                                    <div class="currency-table--item__geobox_link js-select-gis-geobox"
                                         data-office="<?=$arOffice['ID']?>"
                                         data-city="<?=$arResult['CITY']['ID']?>"
                                         data-position="<?=$arOffice['PROPERTY_ATT_YANDEX_POS_VALUE']?>"
                                         data-num="<?=$key?>"
                                    >
                                        <a href="<?=$arOffice["PROPERTY_ATT_2GIS_LOCATION_VALUE"]?>" target="_blank">
                                            <img src="/images/2GIS_icon.svg" alt="2gis карта">
                                            <span>2ГИС</span>
                                        </a>
                                    </div>
                                </div>
                            <? endif; ?>

                            <div class="currency-table--item__link">
                                <?/*?><a href="detail.php?city=<?=$arParams["CITY_CODE"]?>&currency=<?=$currencyCode?>&office=<?=$arOffice['PROPERTY_ATT_CODE_VALUE']?>"><?*/?>
                                <a href="<?echo $arOffice["DETAIL_PAGE_URL"]?>?currency=<?=$currencyCode?>">
                                    <span>Все валюты этого офиса</span>
                                    <svg class="details__arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                        <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                <? endif; ?>
            <? endforeach; ?>
        </div>
    </section>
<?// echo json_encode($arResult); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            function triplets(str) {
                // \u202f — неразрывный узкий пробел
                // \u00a0 — неразрывный пробел
                return str.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1\u00a0');
            }

            function getInputNumber(elem) {
                let initial_sum_string = $(elem).val();
                let initial_sum;
                //console.log(elem);
                //console.log('initial_sum_string=' + initial_sum_string);
                initial_sum = initial_sum_string.replace(/\D/g, ''); // убрать все, кроме цифр
                $(elem).val(initial_sum);
                //console.log('initial_sum=' + initial_sum);
                return initial_sum;
            }

            function calculateCurrValue(curr_array, operation_type, initial_sum) {
                //console.log('curr_array=');
                //console.log(curr_array);
                //console.log(operation_type, initial_sum);
                let curr_value;
                let curr_volume = 1000000000; // объем покупки/продажи, при котором переключаются котировки
                if(curr_array[1]) {
                    curr_volume = curr_array[1].volume;
                }
                let multi = (curr_array[0].multi > .1)? curr_array[0].multi : 1; // предохранение от 0
                if(operation_type == 'buy') {
                    curr_value = curr_array[0].sell / multi;
                    if(parseInt(initial_sum) >= parseInt(curr_volume)) {
                        if(curr_array[1]) {
                            curr_value = curr_array[1].sell / multi;
                        }
                    }
                } else {
                    curr_value = curr_array[0].buy / multi;
                    if(parseInt(initial_sum) >= parseInt(curr_volume)) {
                        if(curr_array[1]) {
                            curr_value = curr_array[1].buy / multi;
                        }
                    }
                }
                return curr_value;
            }

            //const mainSelect = document.querySelector('.js-currency-wrap--select'); // теперь это js-v21-select
            const calcForms = document.querySelectorAll('.currency-table--item__exchange_calculator .calculator-form'); // все формы в калькуляторах
            const calcSubmits = document.querySelectorAll('.js-calculator-window--submit'); // кнопочки (=)
            const leftInputs = document.querySelectorAll('.js-calculator-window--left__input'); // ввод в левое окошко
            const rightInputs = document.querySelectorAll('.js-calculator-window--right__input'); // ввод в правое окошко
            const operations = document.querySelectorAll('input[name="operation"]'); // переключатель radio operation
            const currencyRatesWindows = document.querySelectorAll('.js-currency-table--item__exchange_grid'); //
            let arResult = <? echo json_encode($arResult) ?>;
            //let operationType = 'buy';
            //let initialLeftSum;
            //let initialRightSum;
            let operTypeArray = [];

            //console.log(arResult);
            //console.log(arResult.COURSES);
            //console.log(arResult.COURSES.tsb);
            let arrTSB = arResult.COURSES.tsb;
            //const entries = Object.entries(arrTSB);
            //entries.forEach(([key, value]) => {
            //    //console.log(`${key} : ${arrTSB[key]}`);
            //    console.log(`${key} : ${value}`);
            //});
            const TSBcurr = [];
            const values = Object.values(arrTSB);
            values.forEach(value => {
                TSBcurr.push(value);
            });
            //console.log(TSBcurr);

            let findOfficeCurrencyRate = id => { // возвращает объект с массивом валюты для выбранного офиса, исх.данные в $arResult
                let ar_office_rates = [];
                let curr_obj = TSBcurr.find(item => item.code == id).currency;
                let curr_arr = Object.values(curr_obj)[0];

                [].forEach.call(currencyRatesWindows, function (elem) {
                    if(elem.getAttribute('data-office') == id) {
                        let buy_field = $(elem).find('.v21-exchange-table__value--buy-value')[0];
                        let sell_field = $(elem).find('.v21-exchange-table__value--sell-value')[0];
                        ar_office_rates.push({
                            buy: $(buy_field).html(),
                            sell: $(sell_field).html()
                        });
                    }
                });
                //console.log(Object.values(curr_obj));
                //console.log(curr_arr);
                for(let ix = 0; ix<curr_arr.length; ix++) {
                    //console.log(curr_arr[ix]);
                    //console.log(ar_office_rates[ix]);
                    //console.log(curr_arr[ix].buy);
                    //console.log(curr_arr[ix].sell);
                    curr_arr[ix].buy = ar_office_rates[ix].buy;
                    curr_arr[ix].sell = ar_office_rates[ix].sell;
                }
                //console.log(curr_arr);

                //return TSBcurr.find(item => item.code == id).currency;
                return curr_arr;
            };

            //mainSelect.addEventListener("change", () => { // не надо, теперь работает глобальный js-скрипт
            //    $('#currency_select').submit();
            //});

            [].forEach.call(operations, function (elem) { // перебираю все radio и получаю выбранный operationType
                //console.log('elem');
                //console.log(elem);
                if(elem.checked) {
                    operTypeArray.push({
                        office: $(elem).parents('.calculator-operation').attr('data-office'),
                        operation: elem.value
                    });
                }
                //console.log(operTypeArray);
                elem.addEventListener("click", (event) => {
                    //console.log(elem);
                    let calc_oper = $(elem).parents('.calculator-operation');
                    //console.log(calc_oper);
                    let office_id = $(calc_oper).attr('data-office');
                    //console.log('office_id=' + office_id);
                    if (elem.checked) {
                        //console.log(elem.value);
                        //operationType = elem.value;
                        //console.log(operTypeArray.find(office=>office.office == office_id));
                        operTypeArray.find(office=>office.office == office_id).operation = elem.value; // нашел id офиса, по которому кликнули

                        [].forEach.call(leftInputs, function (element) { // перебираю все изменения левых input
                            let left_input_office = $(element).parents('.calculator-window').attr('data-office');
                            //console.log(left_input_office);
                            if(left_input_office == office_id) {
                                //console.log('left_input_office='+left_input_office);
                                let initial_left_sum = getInputNumber(element);
                                //console.log('initial_left_sum='+initial_left_sum);
                                let curr_obj = findOfficeCurrencyRate(office_id); // получаю массив с курсами в офисе
                                let oper_type = operTypeArray.find(office=>office.office == office_id);
                                //let curr_value = calculateCurrValue(Object.values(curr_obj)[0], oper_type.operation, initial_left_sum);
                                let curr_value = calculateCurrValue(curr_obj, oper_type.operation, initial_left_sum);
                                //console.log('curr_value='+curr_value);
                                let initial_right_sum = Math.floor(initial_left_sum * curr_value);
                                //console.log('initial_right_sum='+initial_right_sum);
                                $(element).parents('.calculator-window').find('.calculator-window--left__number input').val(triplets(initial_left_sum));
                                $(element).parents('.calculator-window').find('.calculator-window--right__number input').val(triplets(initial_right_sum));
                            }
                        });

                    }
                    //console.log(operTypeArray);
                });
            });

            [].forEach.call(leftInputs, function (elem) { // перебираю все изменения левого input
                let curr_value;
                //console.log(elem);
                //console.log($(elem).parents('.calculator-window').attr('data-office'));
                elem.addEventListener("input", (event) => {
                    //event.preventDefault();
                    let initial_left_sum = getInputNumber(elem);
                    //initialLeftSum = getInputNumber(elem);
                    //console.log('initial_left_sum='+initial_left_sum);

                    //console.log(elem);
                    let calc_window = $(elem).parents('.calculator-window');
                    //console.log(calc_window);
                    let office_id = $(calc_window).attr('data-office');
                    let curr_code = String($(calc_window).attr('data-curr'));
                    //console.log('office_id=' + office_id);
                    //console.log('curr_code=' + curr_code);
                    let curr_obj = findOfficeCurrencyRate(office_id); // получаю массив с курсами в офисе
                    //console.log('лев curr_obj=');
                    //console.log(curr_obj);
                    let oper_type = operTypeArray.find(office=>office.office == office_id);
                    //console.log(oper_type);
                    //console.log(curr_obj);

                    //console.log('operationType='+oper_type.operation);
                    //curr_value = calculateCurrValue(Object.values(curr_obj)[0], oper_type.operation, initial_left_sum);
                    curr_value = calculateCurrValue(curr_obj, oper_type.operation, initial_left_sum);
                    //console.log('curr_value='+curr_value);

                    let initial_right_sum = Math.floor(initial_left_sum * curr_value); // ['COURSES']['tsb'][office_id]['currency'][curr_code]['sell']
                    $(calc_window).find('.calculator-window--right__number input').val(triplets(initial_right_sum));
                });
            });

            [].forEach.call(rightInputs, function (elem) { // перебираю все изменения правого input
                let curr_value;
                elem.addEventListener("input", (event) => {
                    //event.preventDefault();
                    let initial_left_sum = 0;
                    let initial_right_sum = getInputNumber(elem);
                    //initialRightSum = getInputNumber(elem, $(elem).val());

                    //console.log(elem);
                    let calc_window = $(elem).parents('.calculator-window');
                    //console.log(calc_window);
                    let office_id = $(calc_window).attr('data-office');
                    let curr_code = String($(calc_window).attr('data-curr'));
                    //console.log('office_id=' + office_id);
                    //console.log('curr_code=' + curr_code);
                    let curr_obj = findOfficeCurrencyRate(office_id); // получаю массив с курсами в офисе
                    //console.log('прав curr_obj=');
                    //console.log(curr_obj);
                    let oper_type = operTypeArray.find(office=>office.office == office_id);

                    //curr_value = calculateCurrValue(Object.values(curr_obj)[0], oper_type.operation, initial_right_sum);
                    curr_value = calculateCurrValue(curr_obj, oper_type.operation, initial_right_sum);
                    //console.log('curr_value='+curr_value);

                    if (curr_value != 0) {
                        initial_left_sum = Math.ceil(initial_right_sum / curr_value);
                    }
                    $(calc_window).find('.calculator-window--left__number input').val(triplets(initial_left_sum));
                });
            });

            [].forEach.call(leftInputs, function (elem) { // перебираю все изменения левого input
                elem.addEventListener("change", (event) => {
                    event.preventDefault();
                    let initial_left_sum = getInputNumber(elem);
                    $(elem).val(triplets(initial_left_sum));
                    //$(elem).val(triplets(initialLeftSum));
                });
            });

            [].forEach.call(rightInputs, function (elem) { // перебираю все изменения правого input
                elem.addEventListener("change", (event) => {
                    event.preventDefault();
                    let initial_right_sum = getInputNumber(elem);
                    $(elem).val(triplets(initial_right_sum));
                });
            });

            [].forEach.call(calcForms, function (elem) { // перебираю все calc forms submits - клик на ENTER
                $(elem).on("submit", function(event){
                    event.preventDefault();
                    //console.log('form operation');
                    //console.log(elem);
                    //console.log(elem.operation);
                });
            });

            [].forEach.call(calcSubmits, function (elem) { // перебираю все значения culcSubmits - клик на =
                elem.addEventListener("click", (event) => {
                    console.log('=');
                    //console.log(elem);
                    event.preventDefault();
                    //console.log($('.calculator-window--left__input').val());
                });
            });

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
