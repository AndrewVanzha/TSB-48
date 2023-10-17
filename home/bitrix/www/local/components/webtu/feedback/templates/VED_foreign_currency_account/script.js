$(document).ready(function () {
    function requiredFields() {
        var arFields = [
            'input[name="COMPANY"]',
            'input[name="FIO"]',
            //'input[name="PHONE"]', // почему-то не берет value
            'input[name="EMAIL"]',
        ];

        var countErr = 0;

        arFields.forEach(function (value) {
            //console.log($(value).val());
            if ($(value).val() == '') {
                $(value).parent().addClass("is-error");
                countErr++;
            } else {
                $(value).parent().removeClass("is-error");
            }
        });

        /*if ($('input[name="SUM"]').val() == '') {
            $('input[name="SUM"]').parent().parent().addClass("is-error");
            countErr++;
        } else {
            $('input[name="SUM"]').parent().parent().removeClass("is-error");
        }*/

        return (countErr > 0) ? false : true;
    }

    $('#fCurrencyForm').submit(function (e) {
        e.preventDefault();
        if ($("#politics2").prop("checked")) {
            $('#politics2').parent().parent().removeClass("is-error");
            if (requiredFields()) {
                $.ajax({
                    type: "POST",
                    url: '/local/components/webtu/feedback/templates/VED_foreign_currency_account/ajax.customer.php',
                    data: {
                        'fields': $(this).serialize(),
                    },
                    dataType: "json",
                    success: function (data) {
                        $('#reloadCaptchaCallback').click();
                        console.log(data);

                        if (data.message && data.message.length > 0) {
                            $(".v21_alert_fCurrencyForm_item").remove()
                            $.each(data.message, function (key, field) {
                                $('#v21_alert_fCurrencyForm .v21-modal__window').append(
                                    '<div class="v21-grid__item v21_alert_fCurrencyForm_item" style="font-size: 20px; padding: 0; text-align: center;">' + field.text + '</div>'
                                );

                                if (!field.type) {
                                    $('.v21_alert_fCurrencyForm_item').css("color", "red");
                                }
                            });
                        }
                        if (data.status) {
                            $("#fCurrencyForm")[0].reset();
                        }

                        if (!data.captcha){
                            $('input[name="CAPTCHA_WORD"]').parent().addClass("is-error");
                        } else {
                            $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                            tsb21.modal.toggleModal('v21_alert_fCurrencyForm');
                        }
                    }
                });
            }
        } else {
            $('#politics').parent().parent().addClass("is-error");
        }
    });

    //$('input#CREDIT_NAME').val($('#VKLAD_NAME').html());

    $('#reloadCaptchaCallback').click(function () {
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function (data) {
            $('#captchaImg').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + data);
            $('#captchaSid').val(data);
        });
        return false;
    });
});

