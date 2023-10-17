<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <h4 class="popup-form_title page-title--4 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_14_HEADER")?>
    </h4>

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">

    <input type="hidden" name="DATE" value="<?=$arParams['DATE']?>">
    <input type="hidden" id="DEPOSIT_NAME" name="DEPOSIT_NAME" value="<?=$arParams['DEPOSIT_NAME']?>">
    <input type="hidden" name="INTEREST_RATE" value="<?=$arParams['INTEREST_RATE']?>">
    <input type="hidden" name="MONTH_SUM" value="<?=$arParams['MONTH_SUM']?>">
    <input type="hidden" name="REPLENISHABLE" value="<?=$arParams['REPLENISHABLE']?>">
    <input type="hidden" name="CUT" value="<?=$arParams['CUT']?>">
    <input type="hidden" name="CAPITALIZATION" value="<?=$arParams['CAPITALIZATION']?>">
    <input type="hidden" name="PAY" value="<?=$arParams['PAY']?>">


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
                    <?=GetMessage("WEBTU_FEEDBACK_14_COMPANY_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="COMPANY_NAME" class="input-field" required=""
                    <? if (isset($arResult['POST']['COMPANY_NAME'])) { ?> value="<?=$arResult['POST']['COMPANY_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_14_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="FIRST_NAME" class="input-field" required=""
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                >

            </span>

        </label>


        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_14_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input type="tel" name="PHONE" data-mask="phone" class="input-field" required="" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_14_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_14_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_14_EMAIL_LINE")?>
                </span>

            </span>

        </label>


        <div  class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_14_SUM")?>
                </span>
            </div>

            <div class="content">

                <div class="currency clearfix">

                    <input type="number" name="SUM" class="input-field" required=""
                        <? if (isset($arResult['POST']['SUM'])) { ?> value="<?=$arResult['POST']['SUM']?>" <? } else { ?> value="" <? } ?>
                    >

                    <div class="select-box">

                        <select name="CURRENCY">

                            <option value="RUB"
                                <? if ($arResult['POST']['CURRENCY'] == "RUB") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_14_CURRENCY_RUB")?>
                            </option>

                            <option value="EUR"
                                <? if ($arResult['POST']['CURRENCY'] == "EUR") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_14_CURRENCY_EUR")?>
                            </option>

                            <option value="USD"
                                <? if ($arResult['POST']['CURRENCY'] == "USD") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_14_CURRENCY_USD")?>
                            </option>

                            <option value="CNY"
                                <? if ($arResult['POST']['CURRENCY'] == "CNY") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_14_CURRENCY_CNY")?>
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_14_DATE")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="DATE" class="input-field"
                    <? if (isset($arResult['POST']['DATE'])) { ?> value="<?=$arResult['POST']['DATE']?>" <? } else { ?>value="<?=$arParams['DATE']?>"<?}?>
                >

            </span>

        </label>

		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_14_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_14_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_14_POLITICS_2"). "</a>";
			$politics_output = sprintf($politics, $politics_1, $politics_2);
		?>
		
		<label class="agreement check-box">
			<input type="checkbox" name="POLITICS" checked required="">
			<span class="check-box_caption"><?=$politics_output?></span>
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
            <?=GetMessage("WEBTU_FEEDBACK_14_BUTTON")?>
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
