<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<div class="feedback">

    <div class="page-container clearfix">

        <div class="feedback_brief">

            <h2 class="section-title page-title--2 page-title">
                <?=GetMessage('WEBTU_FEEDBACK_HEADER_1')?>
            </h2>

            <div class="note">
                <?=GetMessage('WEBTU_FEEDBACK_SUBHEADER_1')?>
            </div>

        </div>

        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="feedback_form">

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
            
            <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
            <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
            <input type="hidden" name="FOLDER" value="<?=$APPLICATION->GetTitle()?>">

            <textarea name="PREVIEW_TEXT" placeholder="<?=GetMessage('WEBTU_FEEDBACK_QUESTION_1')?>" class="message input-field" required=""><? if (isset($arResult['POST']['PREVIEW_TEXT'])) { ?><?=$arResult['POST']['PREVIEW_TEXT']?><? } ?></textarea>

            <div class="type">

                <div class="switch-box clearfix" id="feedbackFormInputType">

                    <label class="switch-box_caption">

                        <input type="radio" name="testName9" checked>

                        <span>
                            <?=GetMessage('WEBTU_FEEDBACK_PHONE_1')?>
                        </span>

                    </label>

                    <div class="switch-box_lever"></div>

                    <label class="switch-box_caption">

                        <input type="radio" name="testName9">

                        <span>
                            <?=GetMessage('WEBTU_FEEDBACK_EMAIL_1')?>
                        </span>

                    </label>

                </div>

            </div>

            <input type="tel" name="PHONE" placeholder="+7 (___) ___-__-__" class="phone input-field" id="feedbackFormInputPhone" data-mask="phone" required=""
                <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
            >

            <input type="email"  name="EMAIL" placeholder="example@site.ru" class="email input-field hidden" id="feedbackFormInputEmail"
                <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
            >

            <div class="captcha clearfix">

                <div class="captcha_image">
                    <input type="hidden" id="captchaSidFooter" name="CAPTCHA_ID" value="<?=$arResult['CAPTCHA']?>" />
                    <img id="captchaImgFooter" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" alt="">
                </div>

                <a id="reloadCaptchaFooter" title="Обновить капчу"></a>

                <div class="captcha_input">
                    <input type="text" name="CAPTCHA_WORD" placeholder="<?=GetMessage('WEBTU_FEEDBACK_CAPTCHA')?>" class="input-field">
                </div>

            </div>

            <button class="button" name="WEBTU_FEEDBACK">
                <?=GetMessage('WEBTU_FEEDBACK_BUTTON_1')?>
            </button>

        </form>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#reloadCaptchaFooter').click(function(){
            $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
                $('#captchaImgFooter').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
                $('#captchaSidFooter').val(data);
            });
            return false;
        });
    });
</script>

<script>
    $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');
    
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
</script>