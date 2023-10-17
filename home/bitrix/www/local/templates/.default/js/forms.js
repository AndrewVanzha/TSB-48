/*------------------------------------------------*/
/* CAPTCHA */
/*------------------------------------------------*/
$(document).ready(function(){
    $('#reloadCaptcha').click(function(){
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImg').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captchaSid').val(data);
        });
        return false;
    });
});

$(document).ready(function(){
    $('#reloadCaptchaFooter').click(function(){
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImgFooter').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captchaSidFooter').val(data);
        });
        return false;
    });
});

/*------------------------------------------------*/
/* EMAIL / PHONE REQUIRED */
/*------------------------------------------------*/

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

/*------------------------------------------------*/
/* SWITCH BOX */
/*------------------------------------------------*/

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

/*------------------------------------------------*/
/* CLEAR FIELDS */
/*------------------------------------------------*/

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

/*------------------------------------------------*/
/* MASK */
/*------------------------------------------------*/

$('input[data-mask="date"]').mask( '99.99.9999', {
    placeholder: 'дд.мм.гггг'
} );
$('input[data-mask="phone"]').mask('+7 (999) 999-99-99');

/*------------------------------------------------*/
/* CUSTOM SELECT */
/*------------------------------------------------*/

function getCustomSelect () {
    if ( $('.cs-box').length < $('select').length ) {
        $('.select-box select').customSelect({
            speed: 360
        });
    }
}

getCustomSelect ();

setTimeout(function () {
    getCustomSelect ();
}, 2000);

/*------------------------------------------------*/
/* INVALID AGREEMENT */
/*------------------------------------------------*/

$('.agreement input').change(function () {
    if ( $(this).is(':checked') ) {
        $(this).closest('.agreement').css('box-shadow', '');
    } else {
        $(this).closest('.agreement').css('box-shadow', '0 0 2px 1px red');
    }
});