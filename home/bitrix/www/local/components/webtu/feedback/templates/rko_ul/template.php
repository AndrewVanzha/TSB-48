<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <h4 class="popup-form_title page-title--4 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_15_HEADER")?>
    </h4>

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">



    <div class="popup-form_content">

        <? if (!empty($arResult['ERRORS'])) { ?>
            <? foreach ($arResult['ERRORS'] as $error) { ?>
                <div class="alert alert-danger">
                    <?=$error?>
                </div>
            <? } ?>
        <? } ?>

        <? if (!empty($arResult['SUCCESS'])) { ?>
            <? foreach ($arResult['SUCCESS'] as $success) { ?>
                <div class="alert alert-success">
                    <?=$success?>
                </div>
            <? } ?>
        <? } ?>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_15_INN")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="INN" class="input-field"
                    <? if (isset($arResult['POST']['INN'])) { ?> value="<?=$arResult['POST']['INN']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_15_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="FIRST_NAME" class="input-field"
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_15_ADDRESS")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="ADDRESS" class="input-field"
                    <? if (isset($arResult['POST']['ADDRESS'])) { ?> value="<?=$arResult['POST']['ADDRESS']?>" <? } ?>
                >

            </span>

        </label>


        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_15_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input type="tel" name="PHONE" data-mask="phone" class="input-field" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_15_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_15_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_15_EMAIL_LINE")?>
                </span>

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_15_CITY")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box">

                    <? CModule::IncludeModule('iblock'); ?>
                    <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y")); ?>

                    <select name="CITY">

                        <? while ($city = $cities->Fetch()) { ?>
                        <option value="<?=$city['NAME']?>"
                            <? if ($arResult['POST']['CITY'] == $city['NAME']) { ?>selected<? } ?>
                            <? if (!isset($arResult['POST']['CITY']) && $city['NAME'] == 'Москва') { ?>selected<? } ?>
                        >
                            <?=$city['NAME']?>
                        </option>
                        <? } ?>

                    </select>
                </div>

            </div>

        </div>

        <label class="agreement check-box">

            <input type="checkbox" name="ONLINE_BANK" checked>

            <span class="check-box_caption">
                Подключить Интернет-банк<?=GetMessage("WEBTU_FEEDBACK_15_ONLINE_BANK")?>
            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_15_ONLINE_BANK")?>
                </span>
            </div>

            <div class="content">

                <div class="switch-box clearfix" id="feedbackFormInputType">

                    <label class="switch-box_caption">

                        <input type="radio" name="ONLINE_BANK" value="Да"
                            <? if (!isset($arResult['POST']['ONLINE_BANK'])) { ?> checked <? } ?>
                            <? if (isset($arResult['POST']['ONLINE_BANK'])) { ?>
                                <? if ($arResult['POST']['ONLINE_BANK'] == 'Да') { ?> checked <? } ?>
                            <? } ?>
                        >

                        <span>
                            Да<?=GetMessage("WEBTU_FEEDBACK_15_ONLINE_BANK_YES")?>
                        </span>

                    </label>

                    <span class="switch-box_lever"></span>

                    <label class="switch-box_caption">

                        <input type="radio" name="ONLINE_BANK" value="Нет"
                            <? if (isset($arResult['POST']['ONLINE_BANK'])) { ?>
                                <? if ($arResult['POST']['ONLINE_BANK'] == 'Нет') { ?> checked <? } ?>
                            <? } ?>
                        >

                        <span>
                            Нет<?=GetMessage("WEBTU_FEEDBACK_15_ONLINE_BANK_NO")?>
                        </span>

                    </label>

                </div>

            </div>

        </div>

        <div class="type-2">

            <div>
                <?=GetMessage("WEBTU_FEEDBACK_15_CURRENCY")?>
            </div>

            <ul class="list">

                <? CModule::IncludeModule('iblock'); ?>
                <? $arCurrency = CIBlockElement::GetProperty(69, 267, Array("sort"=>"asc"), Array("CODE"=>"ATT_CURRENCY")); ?>


                <? while ($currency = $arCurrency->Fetch()) {?>

                    <li>
                        <label class="check-box">
                            <input value="<?=$currency['VALUE']?>" type="checkbox" name="CURRENCY[]"
                            <?if( stristr($arResult['POST']['CURRENCY'], $currency['VALUE'])){?>checked<?}?>
                            >

                            <span class="check-box_caption">
                                <?=$currency['VALUE']?>
                            </span>
                        </label>
                    </li>
                <?}?>


            </ul>

        </div>

        <div class="type-2">

            <div>
                <?=GetMessage("WEBTU_FEEDBACK_15_TYPE")?>
            </div>

            <ul class="list">

                <? CModule::IncludeModule('iblock'); ?>
                <? $arType = CIBlockElement::GetProperty(69, 267, Array("sort"=>"asc"), Array("CODE"=>"ATT_TYPE")); ?>


                <? while ($type = $arType->Fetch()) {?>

                    <li>
                        <label class="check-box">
                            <input value="<?=$type['VALUE']?>" type="checkbox" name="TYPE[]"
                            <?if( stristr($arResult['POST']['TYPE'], $type['VALUE'])){?>checked<?}?>
                            >
                            <span class="check-box_caption">
                                <?=$type['VALUE']?>
                            </span>
                        </label>
                    </li>
                <?}?>


            </ul>

        </div>



        <div class="captcha clearfix">

            <div class="captcha_image">
                <input type="hidden" name="CAPTCHA_ID" value="<?=$arResult['CAPTCHA']?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" alt="">
            </div>

            <div class="captcha_input">
                <input type="text" name="CAPTCHA_WORD" placeholder="<?=GetMessage("WEBTU_FEEDBACK_CAPTCHA")?>" class="input-field">
            </div>

        </div>

        <button class="button" name="WEBTU_FEEDBACK">
            <?=GetMessage("WEBTU_FEEDBACK_15_BUTTON")?>
        </button>

    </div>

</form>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('#creditRequest input[data-mask="phone"]').mask('+7 (999) 999-99-99');
        $('#creditRequest .select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>
