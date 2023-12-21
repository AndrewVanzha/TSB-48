<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <h4 class="popup-form_title page-title--9 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_9_HEADER")?>
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
                    <?=GetMessage("WEBTU_FEEDBACK_9_COMPANY_NAME")?>
                </span>
            </span>

            <span class="content">

                <input required type="text" name="COMPANY_NAME" class="input-field"
                    <? if (isset($arResult['POST']['COMPANY_NAME'])) { ?> value="<?=$arResult['POST']['COMPANY_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_9_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input required type="text" name="FIRST_NAME" class="input-field"
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                >

            </span>

        </label>


        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_9_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input required type="tel" name="PHONE" data-mask="phone" class="input-field" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_9_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_9_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_9_EMAIL_LINE")?>
                </span>

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_9_CITY")?>
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

            <input type="checkbox" name="POLITICS" checked required="">

            <span class="check-box_caption">
                <?=GetMessage("WEBTU_FEEDBACK_9_POLITICS")?>
                <a href="<?=route('user-politics')?>">
                    <?=GetMessage("WEBTU_FEEDBACK_9_POLITICS_MORE")?>
                </a>
            </span>

        </label>

        <div class="captcha clearfix">

            <div class="captcha_image">
                <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?=$arResult['CAPTCHA']?>" />
                <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" alt="">
            </div>

            <a id="reloadCaptcha" title="Обновить капчу"></a>

            <div class="captcha_input">
                <input type="text" name="CAPTCHA_WORD" placeholder="<?=GetMessage('WEBTU_FEEDBACK_CAPTCHA')?>" class="input-field">
            </div>

        </div>

        <button class="button" name="WEBTU_FEEDBACK">
            <?=GetMessage("WEBTU_FEEDBACK_9_BUTTON")?>
        </button>

    </div>

</form>

<script type="text/javascript">

   $(document).ready(function(){
      $('#reloadCaptcha').click(function(){
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImg').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captchaSid').val(data);
        });
        return false;
      });
   });

</script>

<script>

    function requiredContacts () {
        if ($('input[name="EMAIL"]').val() !== '') {
            $('input[name="EMAIL"]').attr('required', true);
            $('input[name="PHONE"]').attr('required', false);
        } else {
            $('input[name="PHONE"]').attr('required', true);
            $('input[name="EMAIL"]').attr('required', false);
        }
    }

    $('input[name="EMAIL"]').on('focusout', function () {
        requiredContacts ();
    });

    $('input[name="PHONE"]').on('focusout', function () {
        requiredContacts ();
    });

    

    function clearFields () {
        $('textarea').val('').css('box-shadow', 'none');
        $('input:not([type="hidden"])').val('').css('box-shadow', 'none');

        $('textarea').focusout(function () {   
            $(this).css('box-shadow', '');
        });
        $('input').focusout(function () {
            $(this).css('box-shadow', '');
        });
    }

    if ($('.alert-success').length > 0) {
        clearFields ();
    }

    $('.feedback_form .button').click(function () {
        $(".alert").remove();
    });



    $('.agreement input[required]').change(function () {
        if ( $(this).is(':checked') ) {
            $(this).closest('.agreement').css('box-shadow', '');
        } else {
            $(this).closest('.agreement').css('box-shadow', '0 0 2px 1px red');
        }
    });

</script>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');

        $('.select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>
