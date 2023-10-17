$(document).ready(function () {
    function requiredFields() {
        var arFields = [
            'input[name="PHONE"]',
            'input[name="EMAIL"]',
            'input[name="LAST_NAME"]',
            'input[name="FIRST_NAME"]',
            'input[name="BIRTHDATE"]'
        ];

        var countErr = 0;

        arFields.forEach(function (value) {
            if ($(value).val() == '') {
                $(value).parent().addClass("is-error");
                countErr++;
            } else {
                $(value).parent().removeClass("is-error");
            }
        });

        if ($('input[name="SUM"]').val() == '') {
            $('input[name="SUM"]').parent().parent().addClass("is-error");
            countErr++;
        } else {
            $('input[name="SUM"]').parent().parent().removeClass("is-error");
        }

        return (countErr > 0) ? false : true;
    }

    $('#investOrder').submit(function (e) {
        e.preventDefault();
        if ($("#politics").prop("checked")) {
            $('#politics').parent().parent().removeClass("is-error");
            if (requiredFields()) {
                $.ajax({
                    type: "POST",
                    url: '/local/components/webtu/feedback/templates/v21_deposit_fiz/ajax.customer.php',
                    data: {
                        'fields': $(this).serialize(),
                    },
                    dataType: "json",
                    success: function (data) {
                        $('#reloadCaptcha').click();

                        if (data.message && data.message.length > 0) {
                            $(".v21_alert_investOrder_item").remove()
                            $.each(data.message, function (key, field) {
                                $('#v21_alert_investOrder .v21-modal__window').append(
                                    '<div class="v21-grid__item v21_alert_investOrder_item" style="font-size: 20px; padding: 0; text-align: center;">' + field.text + '</div>'
                                );

                                if (!field.type) {
                                    $('.v21_alert_investOrder_item').css("color", "red");
                                }
                            });
                        }
                        if (data.status) {
                            $("#investOrder")[0].reset();
                        }

                        if (!data.captcha){
                            $('input[name="CAPTCHA_WORD"]').parent().addClass("is-error");
                        } else {
                            $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                            tsb21.modal.toggleModal('v21_alert_investOrder');
                        }
                    }
                });
            }
        } else {
            $('#politics').parent().parent().addClass("is-error");
        }
    });

    $('a[href="#v21_investOrder"].open').click(function () {
        $('input#CREDIT_NAME').val($(this).data('name'));
    });

    $('#reloadCaptcha').click(function () {
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function (data) {
            $('#captchaImg').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + data);
            $('#captchaSid').val(data);
        });
        return false;
    });
});

