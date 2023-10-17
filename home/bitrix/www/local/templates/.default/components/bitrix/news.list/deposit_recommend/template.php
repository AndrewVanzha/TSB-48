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
$this->setFrameMode(true);?>

<section class="page-section" style="border-bottom: 1px solid #ddd; margin: 0 0 30px;padding: 0 0 30px;">

    <h2 class="section-title page-title--1 page-title"><?if(count($arResult['ITEMS']) == 0) echo "Подходящих вкладов не найдено, "?>Мы рекомендуем</h2>

    <div class="product-items clearfix">
        <?
        if (count($arResult['ITEMS']) == 0) {
            $GLOBALS['arFilter'] = array( "PROPERTY_ATT_RECOMMENDED_VALUE"=>"yes" );
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "deposit_recommend_2",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "N",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "/chastnym-klientam/vklady-i-investitsii/vklady/#ELEMENT_CODE#/",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("", ""),
                    "FILTER_NAME" => "arFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "47",
                    "IBLOCK_TYPE" => "private_clients",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("MIN_SUMM", "MAX_SUM", "MAX_DATE", "RECOMMEND", "ATT_RECOMMENDED", "INTEREST_RATE", ""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N"
                )
            );
        } else {

            function multipleExplode ($delimiters, $string) {
                $ready = str_replace($delimiters, $delimiters[0], $string);
                $launch = explode($delimiters[0], $ready);
                return  $launch;
            }

            if($_REQUEST['CURRENCY'] == 'Руб.') $cur = 'RUB';
            if($_REQUEST['CURRENCY'] == '$') $cur = 'USD';
            if($_REQUEST['CURRENCY'] == '€') $cur = 'EUR';

            foreach($arResult["ITEMS"] as $arItem) { ?>
                <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
            	<div class="product-item--short product-item">

                    <div class="heading">

                        <div class="aligner">

                            <h3 class="page-title--4 page-title">

                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner">
                                    <?=$arItem['NAME']?>
                                </a>

                            </h3>

                            <p class="since">
                                <?=$arItem['PROPERTIES']['ATT_FROM']['VALUE']?>
                            </p>

                            <p class="income" >
                                <?
                                $rsTerms = CIBlockElement::GetList(
                                    array(),
                                    array('SECTION_ID'=>$arItem['PROPERTIES']['INTEREST_RATES']['VALUE']),
                                    false,
                                    false,
                                    array('ID', 'NAME', 'IBLOCK_ID', 'PROPERTY_*')
                                );
                                $maxRate = 0;
                                while ($arTerms = $rsTerms->GetNextElement()) {
                                    foreach ($arTerms->GetProperties()[$cur]['DESCRIPTION'] as $rate) {
                                        $rate = floatval(str_replace(',', '.', $rate));
                                        if ($rate > $maxRate) $maxRate = $rate;
                                    }
                                }
                                ?>
                                до <?=number_format((float)str_replace(',', '.', $maxRate), 2, '.', '');?>% годовых
                            </p>

                        </div>

                    </div>

            		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
            			<div class="content">
            				<div class="brief" style="height: 275px;">

                                <?
                                //Дата открытия вклада
                                $dayBegin = date(d);
                                $monthBegin = date(m);
                                $yearBegin = date(Y);
                                $dateBegin = $yearBegin.'-'.$monthBegin.'-'.$dayBegin;
                                $dateTimeBegin = new DateTime($dateBegin);

                                //Дата окончания вклада
                                $dayEnd = $dayBegin;
                                $yearPlus = floor( ( ($monthBegin + $_REQUEST['DATE']) - 1 ) / 12 );
                                if ( $yearPlus == 0 ) {
                                    $monthEnd = $monthBegin + $_REQUEST['DATE'];
                                    $yearEnd = $yearBegin;
                                } else {
                                    $monthEnd = $monthBegin + $_REQUEST['DATE'] - 12 * $yearPlus;
                                    $yearEnd = $yearBegin + $yearPlus;
                                }
                                if ( strlen($monthEnd) == 1 ) $monthEnd = '0'.$monthEnd;
                                $dateEnd = $yearEnd.'-'.$monthEnd.'-'.$dayEnd;
                                $dateTimeEnd = new DateTime($dateEnd);

                                //Срок вклада
                                $interval = $dateTimeBegin->diff($dateTimeEnd);
                                $countDays = $interval->format('%a');

                                $leapYear = date(L);

                                $arrYears = [];

                                //Срок вклада по месяцам
                                $arrCountDaysInMonth = [];
                                $arrLeapYearsToMonth = [];

                                for ($i = 0; $i <= $_REQUEST['DATE']; $i++) {

                                    $month = $monthBegin + $i;
                                    $year = $yearBegin;

                                    $yearPlus = floor( ( $month - 1 ) / 12 );

                                    if ($yearPlus !== 0) {
                                        $month = $month - 12 * $yearPlus;
                                        $year = $year + $yearPlus;
                                    }

                                    if ( !in_array( $year,  $arrYears) ) {
                                        array_push( $arrYears, $year );
                                    }

                                    $date = '1-'.$month.'-'.$year;

                                    array_push( $arrCountDaysInMonth, date( "t", mktime( 0, 0, 0, $month, 1, $year ) ) );

                                    array_push( $arrLeapYearsToMonth, date( "L", mktime( 0, 0, 0, $month, 1, $year ) ) );

                                    
                                }

                                //Срок вклада по годам
                                $arrCountDaysInYear = [];
                                $arrLeapYearsToYears = [];

                                for ($n = 0; $n < count($arrYears); $n++) {

                                    $beginOfYear = new DateTime($arrYears[$n].'-01-01');
                                    $endOfYear = new DateTime($arrYears[$n+1].'-01-01');

                                    if ($n == 0) $beginOfYear = new DateTime($dateBegin);

                                    if ($n == count($arrYears) - 1) $endOfYear = new DateTime($dateEnd);

                                    $daysInYear = $beginOfYear->diff($endOfYear);
                                    $countDaysInYear = $daysInYear->format('%a');

                                    array_push( $arrCountDaysInYear, $countDaysInYear );

                                    array_push( $arrLeapYearsToYears, date( "L", mktime( 0, 0, 0, 1, 1, $arrYears[$n] ) ) );
                                    
                                }

                                //I – годовая процентная ставка
                                //j – количество календарных дней в периоде, по итогам которого банк производит капитализацию начисленных процентов; 
                                //t – количество дней начисления процентов по привлеченному вкладу 
                                //K – количество дней в календарном году (365 или 366)
                                //P – первоначальная сумма привлеченных в депозит денежных средств
                                //Pk - сумма вклада с учетом капитализации
                                //n — количество операций по капитализации начисленных процентов в течение общего срока привлечения денежных средств;
                                //Sp – сумма процентов (доходов) за весь срок вклада.
                                //Sm - сумма процентов за месяц.
                                //Sy - сумма процентов за год
                                //S — сумма денежных средств, причитающихся к возврату вкладчику по окончании срока депозита. Она состоит из первоначальной суммы размещенных денежных средств, плюс начисленные проценты.

                                $I = $GLOBALS['RATES'][$arItem['ID']];
                                $K = 365;
                                $P = $_REQUEST['SUM'];
                                $Pk = $P;
                                $n = $_REQUEST['DATE'];
                                $Sp = 0;
                                $Sm = 0;
                                $Sy = 0;

                                if ($arItem['PROPERTIES']['ATT_CAPITAL']['VALUE'] == 'Да') {
                                    //Сумма начисленных процентов по вкладам с капитализацией
                                    for ( $i = 0; $i < count($arrCountDaysInMonth); $i++ ) {
                                        $j = $arrCountDaysInMonth[$i];
                                        if ( $i == 0 ) $j = $arrCountDaysInMonth[$i] - $dayBegin + 1;
                                        if ( $i == count($arrCountDaysInMonth) - 1 ) $j = $dayBegin - 1;
                                        if ( $arrLeapYearsToMonth[$i] == 1 ) $K = 366;
                                        $Pk = $Pk + $Sm;
                                        $Sm = $Pk * ( 1 + ($I * $j) / ($K * 100) ) - $Pk;
                                        $Sp = $Sp + $Sm;
                                    }

                                } else {
                                    //Сумма процентов без капитализации
                                    for ( $n = 0; $n < count($arrCountDaysInYear); $n++ ) {
                                        $t = $arrCountDaysInYear[$n];
                                        if ( $arrLeapYearsToYears[$n] == 1 ) $K = 366;
                                        $Sy = ($P * $I * $t) / ($K * 100);
                                        $Sp = $Sp + $Sy;
                                    }
                                }

                                $S = $Sp + $P;


                                if ($arItem['PROPERTIES']['ATT_CAPITAL']['VALUE'] == 'Да') {

                                    //Рассчет эффективной процентной ставки с капитализацией:

                                    //Т – Срок размещение вклада в месяцах
                                    //N - Количество выплат процентов в течение срока вклада
                                    //I - Годовая процентная ставка
                                    //k - Количество выплат в году
                                    //Ie - Эффективная процентная ставка

                                    $T = $_REQUEST['DATE'];
                                    $N = $_REQUEST['DATE'];
                                    $k = 12;

                                    $Ie = ( (1 + $I / 100 / $k)**$N - 1 ) * 12 / $T * 100;

                                } else {
                                    $Ie = $I;
                                }
                                ?>

                                <p style="text-align: center;">
                                    Сумма к получению:<br>
                                    <span style="font-size: 22px; font-weight: bold;"><?=number_format((float)$S, 2, '.', ' ');?>&nbsp;<?=$_REQUEST["CURRENCY"]?></span>
                                    <br>
                                    Сумма процентов:<br>
                                    <span style="font-size: 20px; font-weight: bold;"><?=number_format((float)$Sp, 2, '.', ' ');?>&nbsp;<?=$_REQUEST["CURRENCY"]?></span>
                                    <br>
                                    <div class="clearfix">
                                        <div class="brief-percent">
                                            Процентная<br>
                                            ставка:<br>
                                            <span style="font-size: 20px; font-weight: bold;"><?=number_format((float)$I, 2, '.', ' ');?>%</span>
                                        </div>
                                        <div class="brief-percent">
                                            Эффективная<br>
                                            ставка:<br>
                                            <span style="font-size: 20px; font-weight: bold;"><?=number_format((float)$Ie, 2, '.', ' ');?>%</span>
                                        </div>
                                    </div>
                                <p>
                                    <?if ($arItem['PROPERTIES']['ATT_PARTIAL']['VALUE'] == 'Да') { echo '* Частичное снятие<br>'; }?>
                                    <?if ($arItem['PROPERTIES']['ATT_CAPITAL']['VALUE'] == 'Да') { echo '* Капитализация<br>'; }?>
                                    <?if ($arItem['PROPERTIES']['ATT_PERCENT']['VALUE'] == 'Да') { echo '* Выплата процентов<br>'; }?>
                                    <?if ($arItem['PROPERTIES']['ATT_REFILL']['VALUE'] == 'Да') { echo '* Пополнение<br>'; }?>
                                </p>
            				</div>
                            <a
                                href="#depositFiz" 
                                data-fancybox=""
                                class="button"
                                onclick="
                                    if ($('.currency input:checked').data('currency') == 'Руб.') {
                                        var sum = $('#summ').val();
                                    } else {
                                        var sum = $('#summ_cur').val();
                                    }
                                    $('#sum').val(sum);
                                    $('.cs-box_selected').text($('.currency input:checked').data('currency'));
                                "
                            >
            				    Подать заявку </a>
            				<div class="more">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
            					Узнать больше </a>
            				</div>
            			</div>
            		</div>
            	</div>

                <? unset($I); ?>
            <? } ?>
        <? } ?>
    </div>
    <? if (count($arResult['ITEMS']) != 0) { ?>
        <p>Данный расчет имеет предварительный характер и не является публичной офертой</p>
    <? } ?>
</section>

