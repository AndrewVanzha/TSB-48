<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<script src='/local/templates/.default/js/vendor/pdfmake.min.js'></script>
<script src='/local/templates/.default/js/vendor/vfs_fonts.js'></script>
<form action="" class="page-section">

    <h2 class="section-title page-title--2 page-title">
        Подбери кредит под себя
    </h2>

    <div class="credit-calc-block-1 clearfix">

        <div class="column clearfix currency">

            <label class="check-box">
                <input data-currency="<?=$arResult['SETTINGS']['CURRENCY']['RUB']?>" data-percent="<?=$arResult['SETTINGS']['PERCENT_RUB']?>" type="radio" name="testName7" checked>
                <span class="check-box_caption">
                    РУБЛИ - Р
                </span>
            </label>

            <?if($arResult['SETTINGS']['CURRENCY']['EURO']){?>
                <label class="check-box">
                    <input data-currency="<?=$arResult['SETTINGS']['CURRENCY']['EURO']?>" data-percent="<?=$arResult['SETTINGS']['PERCENT_USD']?>" type="radio" name="testName7">
                    <span class="check-box_caption">
                        ЕВРО - €
                    </span>
                </label>
            <?}?>

            <?if($arResult['SETTINGS']['CURRENCY']['DOLLAR']){?>
                <label class="check-box">
                    <input data-currency="<?=$arResult['SETTINGS']['CURRENCY']['DOLLAR']?>" data-percent="<?=$arResult['SETTINGS']['PERCENT_EUR']?>" type="radio" name="testName7">
                    <span class="check-box_caption">
                        ДОЛЛАРЫ США - $
                    </span>
                </label>
            <?}?>

        </div>

        <div class="column type">

            <?if($arResult['SETTINGS']['DIFFERENTIATED'] == 'Да'){?>
                <label class="check-box">
                    <input data-type="differentiated" type="radio" name="testName8">
                    <span class="check-box_caption">
                        Дифференцированный
                    </span>
                </label>
            <?}?>


            <label class="check-box">
                <input data-type="annuity" type="radio" name="testName8" checked>
                <span class="check-box_caption">
                    Аннуитетный
                </span>
            </label>

        </div>

    </div>

    <div class="credit-calc-block-2">

        <div class="calc-range-block">

            <div class="calc-range-block_heading clearfix">

                <h3 class="page-title--3 page-title">
                    Сумма кредита
                </h3>

                <div class="value clearfix">
                    <input id="price" type="text" name="" data-steps="<?=$arResult['SETTINGS']['STEPS_SUMM']?>" data-increment="1" value="200000" class="input-field">
                    <span class="cur">Руб.</span>
                </div>

            </div>

            <div class="calc-range-block_slider"></div>

            <ul class="calc-range-block_steps clearfix"></ul>

        </div>

        <div class="calc-range-block">

            <div class="calc-range-block_heading clearfix">

                <h3 class="page-title--3 page-title">
                    Срок кредитования
                </h3>

                <div class="value clearfix">
                    <input id="date" type="number" name="" data-steps="<?=$arResult['SETTINGS']['STEPS_DATE']?>" data-increment="1" value="6" class="input-field">
                    Мес.
                </div>

            </div>

            <div class="calc-range-block_slider"></div>

            <ul class="calc-range-block_steps clearfix"></ul>

        </div>

    </div>

    <div class="clearfix">

        <div class="credit-calc-block-3 properties">

            <label class="check-box">
                <input type="checkbox" name="CLIENT_TYPE">
                <span class="check-box_caption">
                    Зарплатный клиент
                </span>
            </label>

            <label class="check-box">
                <input type="checkbox" name="ENSURANCE" checked>
                <span class="check-box_caption">
                    Готов застраховаться
                </span>
            </label>

            <label class="check-box">
                <input type="checkbox" name="PLEDGE" checked>
                <span class="check-box_caption">
                    Залог или поручитель
                </span>
            </label>

        </div>

        <div class="credit-calc-results">

            <h3 class="page-title--2 page-title credit-name">
                <?=$arResult['SETTINGS']['CREDIT_NAME']?>
            </h3>

            <ul class="details">

                <li class="clearfix">

                    <div class="column">
                        Сумма кредита:
                    </div>

                    <div class="column">
                        <strong>
                            <span id="column-sum">200 000</span> <span class="cur">Руб.</span>
                        </strong>
                    </div>

                </li>

                <li class="clearfix">

                    <div class="column">
                        Процентная ставка:
                    </div>

                    <div class="column">
                        <strong>
                            <span id="column-percent"><?=$arResult['SETTINGS']['PERCENT_RUB']?></span>%
                        </strong>
                    </div>

                </li>
                
                <li class="clearfix">

                    <div class="column">
                        Срок кредитования:
                    </div>

                    <div class="column">
                        <strong>
                            <span id="column-date"></span> мес.
                        </strong>
                    </div>

                </li>

                <li class="clearfix">

                    <div class="column">
                        Ежемесячный платеж:
                    </div>

                    <div class="column">
                        <strong>
                            <span id="column-month"></span> <span class="cur">Руб.</span>
                        </strong>
                    </div>

                </li>

            </ul>

            <a href="#creditRequest" onclick="$('#CREDIT_NAME').val($('h3.credit-name').text());$('#CREDIT_PERCENT').val($('#column-percent').text());$('#CREDIT_TIME').val($('#column-date').text());$('#CREDIT_SUMM').val($('#column-sum').text());$('#CREDIT_SU').val($('#column-sum').text());$('#CREDIT_CURRENCY').val($('#column-sum + .cur').text());$('#CREDIT_PAYMENT').val($('#column-month').text())" data-fancybox class="button">
                оформить заявку на кредит
            </a>

            <div class="schedule">
                <a onclick="pdfCreacte()" href="javascript:void(0);">
                    ГРАФИК ПЛАТЕЖЕЙ
                </a>
            </div>

        </div>

    </div>

</form>