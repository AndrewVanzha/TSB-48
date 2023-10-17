<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) { ?>
    <? die(); ?>
<? } ?>
<? $officeId = htmlspecialchars($_GET['office']); ?>
<?
$phpSelf = $_SERVER['PHP_SELF'];
if (substr($phpSelf, -9) == "index.php") {
    $phpSelf = substr($phpSelf, 0, -9);
}
if (isset($_GET["city"]) && ($_GET["city"] != $_SESSION["city"])) {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . $phpSelf);
    exit();
}
?>
<?//debugg($arResult)?>
<form action="" method="get" class="v21_exchange-converter">
    <input type="hidden" name="city" value="<?= $_SESSION["city"] ?>">

    <div class="v21-section v21-section--border">
        <div class="v21-intro-card v21-intro-card--exchange">
            <div class="v21-intro-card__image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-exchange.png" alt="">
            </div><!-- /.intro-card__image -->
            <div class="v21-intro-card__content">
                <h2 class="v21-h5 v21-intro-card__title v21-intro-card__width v21-intro-card__width--xs">
                    Обмен наличной иностранной валюты возможен только в кассах Банка
                </h2>
                <div class="v21-exchange-location js-v21-tabs">
                    <div>Выберите удобный для вас офис банка для обмена валюты</div>
                    <div class="v21-exchange-location__select">
                        <select name="office" class="v21-select js-v21-select" onchange="$('.v21_exchange-converter').submit();">
                            <?
                            foreach ($arResult['OFFICE'] as $arOffice) {
                                if ($arOffice['NAME'] != 'iSimple') {
                                    $officeName = $arOffice['NAME'];
                                } else {
                                    $officeName = 'ТСБ-онлайн';
                                }
                            ?>

                                <option value="<?= $arOffice['ID'] ?>" <? if ($arOffice['ID'] == $officeId) echo 'selected'; ?>>
                                    <?= $officeName ?>
                                </option>

                            <? } ?>
                        </select>
                    </div>

                    <div class="v21-tabs-content">

                        <div data-tab-id="office9" class="v21-exchange-location__info v21-tabs-content__item v21-fade is-active">
                            <? if (!empty($arResult['ADDRESS_OFFICE'])) { ?>
                                <div class="v21-exchange-location__item">
                                    <svg width="14" height="14" class="v21-exchange-location__icon">
                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#address"></use>
                                    </svg>
                                    <div class="v21-exchange-location__title">Адрес</div>
                                    <div class="v21-exchange-location__address"><?= $arResult['ADDRESS_OFFICE'] ?></div>
                                </div><!-- /.v21-exchange-location__item -->
                            <? } ?>
                            <? if (!empty($arResult['ADDRESS_OFFICE'])) { ?>
                                <div class="v21-exchange-location__item">
                                    <svg width="14" height="14" class="v21-exchange-location__icon">
                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#phone"></use>
                                    </svg>
                                    <div class="v21-exchange-location__title">Телефон</div>
                                    <div class="v21-exchange-location__phone"><?= $arResult['PHONE_OFFICE'] ?></div>
                                </div><!-- /.v21-exchange-location__item -->
                            <? } ?>
                        </div><!-- /.v21-exchange-location__info -->

                    </div><!-- /.v21-tabs-content -->
                </div><!-- /.v21-exchange-location -->
            </div><!-- /.v21-intro-card__content -->
        </div><!-- /.v21-intro-card -->
    </div><!-- /.v21-section -->
</form>

<? $APPLICATION->IncludeComponent(
    "webtu:synch.currency",
    "def",
    array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CBR_IBLOCK_ID" => "116",
        "OFFICE_IBLOCK_ID" => "115"
    )
); ?>

<div class="v21-section">
    <div class="v21-exchange-calc" id="v21_exCalc">
        <div class="v21-exchange-calc__content">
            <h2 class="v21-exchange-calc__title v21-h2">Калькулятор обмена</h2>
            <div class="v21-exchange-calc__brief">
                <? if ($arResult['NAME_OFFICE'] != 'iSimple') {
                    $officeName = $arResult['NAME_OFFICE'];
                } else {
                    $officeName = 'ТСБ-онлайн';
                } ?>
                Данные для офиса «<?= $officeName; ?>»<br>
                по&nbsp;состоянию на&nbsp;<span id="exchange-date"></span>
            </div>

            <div class="v21-exchange-calc__type">
                <div class="v21-switch">
                    <input type="radio" name="v21_exCalcType" id="v21_exCalcBuy" value="sell" checked class="v21-switch__input">
                    <label for="v21_exCalcBuy" class="v21-exchange-calc__type-label v21-switch__label">Продать</label>
                    <input type="radio" name="v21_exCalcType" id="v21_exCalcSell" value="buy" class="v21-switch__input">
                    <label for="v21_exCalcSell" class="v21-exchange-calc__type-label v21-switch__label">Купить</label>
                    <div class="v21-switch__handle"></div>
                </div>
            </div><!-- /.v21-exchange-calc__type -->
            <div class="v21-exchange-calc__fields">
                <div class="v21-exchange-calc__side">
                    <div class="v21-input-combo">
                        <input type="text" value="1000" name="v21_exCalcLeftInput" class="v21-input-combo__field v21-input-group__field v21-field">
                        <div class="v21-input-combo__select">
                            <select name="v21_exCalcLeftSelect" class="v21-select">
                                <option value="RUB">RUB</option>
                                <?
                                $i = 0;
                                foreach ($arResult['CUR'] as $currency) { ?>
                                    <? if ($currency['BUY'] > 0) { ?>
                                        <? if ($i++ == 0) $curVar = $currency['SELL']; ?>
                                        <option value="<?= $currency['NAME'] ?>">
                                            <?= $currency['NAME'] ?>
                                        </option>
                                    <? } ?>
                                <? } ?>
                            </select>
                        </div>
                    </div><!-- /.v21-input-combo -->
                    <div class="v21-exchange-calc__slider">
                        <div class="js-v21-exchange-calc-left-slider"></div>
                        <div class="v21-exchange-calc__marks">
                            <div class="js-v21-exchange-calc-left-min"></div>
                            <div class="js-v21-exchange-calc-left-max"></div>
                        </div>
                    </div><!-- /.v21-exchange-calc__slider -->
                </div><!-- /.v21-exchange-calc__side -->

                <div class="v21-exchange-calc__swap v21-button js-v21-exchange-calc-swap">
                    <svg width="32" height="32">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#swap"></use>
                    </svg>
                </div>

                <div class="v21-exchange-calc__side">
                    <div class="v21-input-combo">
                        <input type="text" name="v21_exCalcRightInput" class="v21-input-combo__field v21-input-group__field v21-field">
                        <div class="v21-input-combo__select">
                            <select name="v21_exCalcRightSelect" class="v21-select">
                                <option value="RUB" selected>RUB</option>
                                <?
                                $i = 0;
                                foreach ($arResult['CUR'] as $currency) { ?>
                                    <? if ($currency['BUY'] > 0) { ?>
                                        <? if ($i++ == 0) $curVar = $currency['SELL']; ?>
                                        <option value="<?= $currency['NAME'] ?>">
                                            <?= $currency['NAME'] ?>
                                        </option>
                                    <? } ?>
                                <? } ?>
                            </select>
                        </div>
                    </div><!-- /.v21-input-combo -->
                    <div class="v21-exchange-calc__slider">
                        <div class="js-v21-exchange-calc-right-slider"></div>
                        <div class="v21-exchange-calc__marks">
                            <div class="js-v21-exchange-calc-right-min"></div>
                            <div class="js-v21-exchange-calc-right-max"></div>
                        </div>
                    </div><!-- /.v21-exchange-calc__slider -->
                </div><!-- /.v21-exchange-calc__side -->
            </div><!-- /.v21-exchange-calc__fields -->

            <div class="v21-exchange-calc__course">
                <svg width="18" height="18" class="v21-exchange-calc__course-icon">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#info"></use>
                </svg>
                <div class="v21-exchange-calc__course-text">По курсу <span class="js-v21-exchange-calc-course"><?= $curVar ?></span></div>
            </div><!-- /.v21-exchange-calc__course -->

            <div class="v21-exchange-calc__note">
                Просим дополнительно ознакомиться с
                <a href="https://www.transstroybank.ru/chastnym-klientam/drugie-uslugi/raschetno-kassovoe-obsluzhivanie" class="v21-link">
                    <span class="v21-link__text">
                        "Тарифами на проведение валютно-обменных операций"
                    </span>
                </a>
            </div><!-- /.v21-exchange-calc__note -->

			<?php/* if (empty($_SESSION["city"]) || $_SESSION["city"] == 399) : ?>
                <a href="/chastnym-klientam/rezervirovanie-kursa/" class="v21-exchange-calc__button v21-button">Зарезервировать курс&nbsp;валют</a>
			<?php endif; */?>
        </div><!-- /.v21-exchange-calc__content -->
    </div><!-- /.v21-exchange-calc -->
</div><!-- /.v21-section -->

<script>
    var monetaryRate = <?= $arResult["monetaryRate"] ?>;
</script>