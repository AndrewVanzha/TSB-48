<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <h4 class="popup-form_title page-title--4 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_3_HEADER")?>
    </h4>

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">

    <input type="hidden" id="CREDIT_NAME" name="CREDIT_NAME" value="">
    <input type="hidden" id="CREDIT_SUMM" name="CREDIT_SUMM" value="">
    <input type="hidden" id="CREDIT_CURRENCY" name="CREDIT_CURRENCY" value="">
    <input type="hidden" id="CREDIT_PERCENT" name="CREDIT_PERCENT" value="">
    <input type="hidden" id="" name="CREDIT_CLIENT_TYPE" value="">
    <input type="hidden" id="" name="CREDIT_ENSURANCE" value="">
    <input type="hidden" id="" name="CREDIT_PLEDGE" value="">
    <input type="hidden" id="CREDIT_TIME" name="CREDIT_TIME" value="">
    <input type="hidden" id="CREDIT_PAYMENT" name="CREDIT_PAYMENT" value="">
    <input type="hidden" id="" name="CREDIT_CLIENT_TYPE_VALUE" value="">
    <input type="hidden" id="" name="CREDIT_ENSURANCE_VALUE" value="">
    <input type="hidden" id="" name="CREDIT_PLEDGE_VALUE" value="">

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
                    <?=GetMessage("WEBTU_FEEDBACK_3_LAST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="LAST_NAME" class="input-field" required
                    <? if (isset($arResult['POST']['LAST_NAME'])) { ?> value="<?=$arResult['POST']['LAST_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="FIRST_NAME" class="input-field" required
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_SECOND_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="SECOND_NAME" class="input-field"
                    <? if (isset($arResult['POST']['SECOND_NAME'])) { ?> value="<?=$arResult['POST']['SECOND_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_SEX")?>
                </span>
            </div>

            <div class="content">

                <div class="switch-box clearfix" id="feedbackFormInputType">

                    <label class="switch-box_caption">

                        <input type="radio" name="SEX" value="Мужской"
                            <? if (!isset($arResult['POST']['SEX'])) { ?> checked <? } ?>
                            <? if (isset($arResult['POST']['SEX'])) { ?>
                                <? if ($arResult['POST']['SEX'] == 'Мужской') { ?> checked <? } ?>
                            <? } ?>
                        >

                        <span>
                            <?=GetMessage("WEBTU_FEEDBACK_3_SEX_MALE")?>
                        </span>

                    </label>

                    <span class="switch-box_lever"></span>

                    <label class="switch-box_caption">

                        <input type="radio" name="SEX" value="Женский"
                            <? if (isset($arResult['POST']['SEX'])) { ?>
                                <? if ($arResult['POST']['SEX'] == 'Женский') { ?> checked <? } ?>
                            <? } ?>
                        >

                        <span>
                            <?=GetMessage("WEBTU_FEEDBACK_3_SEX_FEMALE")?>
                        </span>

                    </label>

                </div>

            </div>

        </div>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_BIRTHDATE")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="BIRTHDATE" data-mask="date" class="input-field" required placeholder="дд.мм.гггг"
                    <? if (isset($arResult['POST']['BIRTHDATE'])) { ?> value="<?=$arResult['POST']['BIRTHDATE']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input type="tel" name="PHONE" data-mask="phone" class="input-field" required="" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_3_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_3_EMAIL_LINE")?>
                </span>

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_CREDIT_SUMM")?>
                </span>
            </div>

            <div class="content">

                <div class="currency clearfix">

                    <input type="text" name="CREDIT_SUMM" class="input-field" id="CREDIT_SU" required=""
                        <? if (isset($arResult['POST']['CREDIT_SUMM'])) { ?> value="<?=$arResult['POST']['CREDIT_SUMM']?>" <? } else { ?> value="" <? } ?>
                    >

                    <div class="select-box">

                        <select name="CREDIT_CURRENCY">

                            <option value="RUB"
                                <? if ($arResult['POST']['CREDIT_CURRENCY'] == "RUB") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_3_CURRENCY_RUB")?>
                            </option>

                            <option value="EUR" 
                                <? if ($arResult['POST']['CREDIT_CURRENCY'] == "EUR") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_3_CURRENCY_EUR")?>
                            </option>

                            <option value="USD"
                                <? if ($arResult['POST']['CREDIT_CURRENCY'] == "USD") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_3_CURRENCY_USD")?>
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <label class="agreement check-box">

            <input type="checkbox" name="CITIZENSHIP" checked>

            <span class="check-box_caption">
                <?=GetMessage("WEBTU_FEEDBACK_3_CITIZENSHIP")?>
            </span>

        </label>

		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_3_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_2"). "</a>";
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
            <?=GetMessage("WEBTU_FEEDBACK_3_BUTTON")?>
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

    $('.button[data-fancybox=""]').on('click', function () {

        $('.currency li').removeClass('is-active');

        if ($('#CREDIT_CURRENCY').val() === '$') {
            $('.currency li:last-child').addClass('is-active');
        }
        if ($('#CREDIT_CURRENCY').val() === '€') {
            $('.currency li:nth-child(2)').addClass('is-active');
        }
        if ($('#CREDIT_CURRENCY').val() === 'Руб.') {
            $('.currency li:first-child').addClass('is-active');
        }
        if ($('.currency li.is-active').length > 0) {
            $('.cs-box_selected').text($('.currency li.is-active').text());
        }



        if ($('input[name="CLIENT_TYPE"]:checkbox:checked').length > 0) {
            $('input[name="CREDIT_CLIENT_TYPE"]').val('Да');
        } else {
            $('input[name="CREDIT_CLIENT_TYPE"]').val('');
        }
        if ($('input[name="ENSURANCE"]:checkbox:checked').length > 0) {
            $('input[name="CREDIT_ENSURANCE"]').val('Да');
        } else {
            $('input[name="CREDIT_ENSURANCE"]').val('');
        }
        if ($('input[name="PLEDGE"]:checkbox:checked').length > 0) {
            $('input[name="CREDIT_PLEDGE"]').val('Да');
        } else {
            $('input[name="CREDIT_PLEDGE"]').val('');
        }
    });



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



    function setSwitchBoxLever(obj) {

        if ( obj.find('input[type="radio"]:checked').parent().next().length ) {

            obj.find('.switch-box_lever').addClass('is-active-left').removeClass('is-active-right');

        } else if ( obj.find('input[type="radio"]:checked').parent().prev().length ) {

            obj.find('.switch-box_lever').addClass('is-active-right').removeClass('is-active-left');

        }

    }

    $('.switch-box').each( function() {

        setSwitchBoxLever( $(this) );

    } );

    $('.switch-box input[type="radio"]').change( function() {

        setSwitchBoxLever( $(this).parents('.switch-box') );

    } );

    $('.switch-box_lever').click( function() {

        if ( $(this).siblings().find('input[type="radio"]').length ) {

            if ( $(this).hasClass('is-active-left') ) {

                $(this).removeClass('is-active-left').addClass('is-active-right');
                $(this).prev().find('input[type="radio"]').prop('checked', false);
                $(this).next().find('input[type="radio"]').prop('checked', true);

            } else {

                $(this).removeClass('is-active-right').addClass('is-active-left');
                $(this).prev().find('input[type="radio"]').prop('checked', true);
                $(this).next().find('input[type="radio"]').prop('checked', false);

            }

            $(this).siblings().find('input[type="radio"]').change();

        }

    } );

    function toggleFeedbackFormInputType() {

        if ( $('.page-bottom .switch-box_lever').hasClass('is-active-left') ){
            $('#feedbackFormInputPhone').removeClass('hidden');
            $('#feedbackFormInputPhone').prop('required',true);
            $('#feedbackFormInputEmail').addClass('hidden');
            $('#feedbackFormInputEmail').prop('required',false);
        } else {
            $('#feedbackFormInputPhone').addClass('hidden');
            $('#feedbackFormInputPhone').prop('required',false);
            $('#feedbackFormInputEmail').removeClass('hidden');
            $('#feedbackFormInputEmail').prop('required',true);
        }
    }

    toggleFeedbackFormInputType();

    $('.feedback_form .switch-box input[type="radio"]').change( function() {

        toggleFeedbackFormInputType();

    } );



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
        $('input[data-mask="date"]').mask( '99.99.9999', {
            placeholder: 'дд.мм.гггг'
        } );
        $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');

        $('.select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>