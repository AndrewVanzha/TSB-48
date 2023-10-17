<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<? if (count($arResult['CITIES']) > 0) { ?>
    <select id="webtu-geotargeting">
        <? foreach ($arResult['CITIES'] as $city) { ?>
            <option
                value="<?=$city['ID']?>"
                data-lat="<?=$city['PROPERTY_LATITUDE_VALUE']?>"
                data-lng="<?=$city['PROPERTY_LONGITUDE_VALUE']?>"
                <? if ($city['SELECTED']) { ?>selected="selected"<? } ?>
            >
                <?=$city['NAME']?>
            </option>
        <? } ?>
    </select>
<? } ?>
