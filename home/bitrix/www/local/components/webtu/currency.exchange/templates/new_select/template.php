<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<?
//debugg($arParams);
//debugg($arResult);
//debugg($arResult['COURSES']);
//debugg($arResult['CITY']);

//debugg($_SERVER);
//$path_parts = pathinfo($_SERVER['template.php']);
//debugg($path_parts);

//$currencyTitle = 'all'; // валюта не выбрана
$currencyTitle = $arParams["CURRENCY"]; // первоначальный выбор
$currencyCode = $arParams["CURRENCY"];
//debugg('$currencyTitle=');
//debugg($currencyTitle);
//debugg($currencyCode);
//debugg($arResult);
//debugg($arResult['CITY']);
?>
    <h4>Выберите валюту для обмена</h4>
    <form action="" method="get" class="currency-form" id="currency_select">
        <?/*?><input type="hidden" name="city" value="<?=$arParams["CITY_CODE"]?>"><?*/?>
        <?/*?><input type="hidden" name="select" id="select" value="<?=$currencyTitle?>"><?*/?>

        <div class="currency-wrap">
            <select name="currency" class="v21-select js-v21-select" onchange="$('.currency-form').submit();">
                <? foreach ($arResult['CITY']['CURRENCY_CODES'] as $arCurr) : ?>
                    <option value="<?= $arCurr['UF_CURR_CODE'] ?>" <? if ($arCurr['UF_CURR_CODE'] == $currencyTitle) echo 'selected'; ?>>
                        &nbsp;&nbsp;<?=$arCurr['UF_CURR_TEXT_RU2'] . ' (' . $arCurr['UF_CURR_CODE'] . ')'?>
                    </option>
                <? endforeach; ?>
            </select>

            <?/*?>
            <div class="currency__link-icon">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21_currency-1.svg">
            </div>
            <?*/?>
        </div>
    </form>
