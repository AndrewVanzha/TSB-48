
$(document).ready(function () {
    function requiredFields() {
        var fields = [
            {
                nameField: 'input[name="PHONE"]',
                firstPage: true,
                activePage: false
            },
            {
                nameField: 'input[name="EMAIL"]',
                firstPage: true,
                activePage: false
            },
            {
                nameField: 'input[name="LAST_NAME"]',
                firstPage: true,
                activePage: false
            },
            {
                nameField: 'input[name="FIRST_NAME"]',
                firstPage: true,
                activePage: false
            },
            {
                nameField: 'input[name="TRANSLIT"]',
                firstPage: true,
                activePage: false
            },
            {
                nameField: 'input[name="FROM_WHERE"]',
                firstPage: true,
                activePage: false
            },
            {
                nameField: 'input[name="PASS_SERIYA"]',
                firstPage: false,
                activePage: false,
            },
            {
                nameField: 'input[name="PASS_NUMBER"]',
                firstPage: false,
                activePage: false
            },
            {
                nameField: 'input[name="PASS_DATA"]',
                firstPage: false,
                activePage: false
            },
            {
                nameField: 'input[name="PASS_KEM"]',
                firstPage: false,
                activePage: false
            },
            {
                nameField: 'input[name="PASS_COD"]',
                firstPage: false,
                activePage: false
            },
            {
                nameField: 'input[name="PASS_MESTO"]',
                firstPage: false,
                activePage: false
            },
            {
                nameField: 'input[name="BIRTHDATE"]',
                firstPage: false,
                activePage: false
            },
            {
                nameField: 'input[name="PASS_ADDR_R"]',
                firstPage: false,
                activePage: false
            },
            {
                nameField: 'input[name="PASS_ADDR_F"]',
                firstPage: false,
                activePage: false
            },

        ];

        fields.forEach(function (value) {
            if ($(value.nameField).val() == '') {
                $(value.nameField).parent().addClass("is-error");
                value.activePage = true;
            } else {
                $(value.nameField).parent().removeClass("is-error");
                value.activePage = false;
            }
        });

        for (let i = 0; i < fields.length; i++) {
            if (fields[i].activePage == true) {
                if (fields[i].firstPage == true) {
                    if ($('#v21_plasticOrder2').hasClass("is-active")) {
                        tsb21.modal.toggleModal('v21_plasticOrder1');
                    }
                }
                return false;
            }
        }

        return true;
    }

    $('#orderCard').submit(function (e) {
        if ($("#politics").prop("checked")) {
            $('#politics').parent().parent().removeClass("is-error");
            if (requiredFields()) {
                $.ajax({
                    type: "POST",
                    url: '/local/components/webtu/feedback/templates/v21_card/ajax.customer.php',
                    data: {
                        'fields': $(this).serialize(),
                    },
                    dataType: "json",
                    success: function (data) {
                        $('#reloadCaptcha').click();

                        if (data.message && data.message.length > 0) {
                            $(".v21_alert_orderCard_item").remove()
                            $.each(data.message, function (key, field) {
                                $('#v21_alert_orderCard .v21-modal__window').append(
                                    '<div class="v21-grid__item v21_alert_orderCard_item" style="font-size: 20px; padding: 0; text-align: center;">' + field.text + '</div>'
                                );

                                if (!field.type) {
                                    $('.v21_alert_orderCard_item').css("color", "red");
                                }
                            });
                        }
                        if (data.status) {
                            $("#orderCard")[0].reset();
                        }

                        if (!data.captcha) {
                            $('input[name="CAPTCHA_WORD"]').parent().addClass("is-error");
                        } else {
                            $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                            tsb21.modal.toggleModal('v21_alert_orderCard');
                        }
                    }
                });
            }
        } else {
            $('#politics').parent().parent().addClass("is-error");
        }
        e.preventDefault();
    });

    // Доставка карты
    $('.block_deliveryHome').hide();
    checkDeliveryCard();

    $('select[name="CITY"]').on('change', function () {
        checkDeliveryCard();
    });

    const newSelect = new tsb21.choices('select[name="TYPE"]', {
        searchEnabled: false,
        itemSelectText: '',
        shouldSort: false,
    });

    $('a[href="#v21_plasticOrder1"].open').on('click', function () {
        let cardName = $(this).data('name');
        newSelect.setChoiceByValue([cardName]);
        tsb21.tabs.showTab(cardName);
    });

    $('#reloadCaptcha').click(function () {
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function (data) {
            $('#captchaImg').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + data);
            $('#captchaSid').val(data);
        });
        return false;
    });
});

function checkDeliveryCard() {
    let city = $('select[name="CITY"]').val();
    let typeCard = $('select[name="TYPE"]').val();

    if (city === 'Москва' && typeCard !== '') {
        $('.block_deliveryHome').show();
        $('input#v21_deliveryHome').prop("disabled", false).prop("checked", false);

    } else {
        $('.block_deliveryHome').hide();
        $('input#v21_deliveryHome').prop("disabled", true).prop("checked", false);
    }

    /*if (typeCard === 'Visa Gold' || typeCard === 'Visa Platinum') {
        $('.v21-grid__item .translit').show();
    } else {
        $('.v21-grid__item .translit').hide();
        $('input[name="TRANSLIT"]').val('');
    }*/

    $('input#v21_deliveryHome').change();
}

