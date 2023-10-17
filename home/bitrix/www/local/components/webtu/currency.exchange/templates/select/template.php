<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<?
$currencyTitle = $arParams["CURRENCY"]; // первоначальный выбор
$currencyCode = $arParams["CURRENCY"];
?>
    <h4>Выберите валюту для обмена</h4>
    <form action="" method="get" class="currency-form" id="currency_select">
        <input type="hidden" name="city" value="<?=$arParams["CITY_CODE"]?>">

        <div class="currency-wrap">
            <select name="currency" class="v21-select js-v21-select" onchange="$('.currency-form').submit();">
                <? foreach ($arResult['CITY']['CURRENCY_CODES'] as $arCurr) : ?>
                    <option value="<?= $arCurr['UF_CURR_CODE'] ?>" <? if ($arCurr['UF_CURR_CODE'] == $currencyTitle) echo 'selected'; ?>>
                        &nbsp;&nbsp;<?=$arCurr['UF_CURR_TEXT_RU2'] . ' (' . $arCurr['UF_CURR_CODE'] . ')'?>
                    </option>
                <? endforeach; ?>
            </select>

        </div>
    </form>
