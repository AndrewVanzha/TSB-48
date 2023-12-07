<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?php
$postTemplateID = 0;
$rs_mess = CEventMessage::GetList($by="id", $order="desc", Array("TYPE_ID" => array($arParams['ADMIN_EVENT'])));
while($arMess = $rs_mess->GetNext()) { // нахожу ID почтового шаблона
    $postTemplateID = $arMess['ID'];
}
//debugg($postTemplateID);
?>

<div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_depositOrder">
    <div class="v21-modal__window js-v21-modal-window">
        <a href="#v21_depositOrder" class="v21-modal__close js-v21-modal-toggle">
            <svg width="24" height="24">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
            </svg>
        </a>
        <h2 class="v21-modal__title v21-h2"><?= GetMessage("WEBTU_FEEDBACK_8_HEADER") ?></h2>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" class="v21-service-form" id="depositOrder">
            <input type="hidden" name="FORM_ID" value="<?= $arResult['FORM_ID'] ?>">
            <input type="hidden" name="SESSION_ID" value="<?= bitrix_sessid() ?>">
            <input type="hidden" id="CREDIT_NAME" name="CREDIT_NAME" value="">

            <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
            <?/*?><input type="hidden" name="email2" value=""><?*/?>
            <input type="hidden" name="REQ_URI" value="<?= $_SERVER['SCRIPT_URL'] ?>">
            <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">
            <??><input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'><??>

            <div class="v21-service-form__section">
                <h3 class="v21-h5">Контактные данные</h3>
                <div class="v21-grid">
                    <div class="v21-grid__item v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_LAST_NAME") ?></span>
                            <input type="text" name="LAST_NAME" placeholder="Пушкин" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_FIRST_NAME") ?></span>
                            <input type="text" name="FIRST_NAME" placeholder="Александр" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_SECOND_NAME") ?></span>
                            <input type="text" name="SECOND_NAME" placeholder="Сергеевич" class="v21-input-group__field v21-field">
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_PHONE") ?></span>
                            <input type="tel" name="PHONE" placeholder="+7 ___ _______" data-inputmask="'mask': '+7 999 9999999'" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_8_PHONE_LINE") ?></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_EMAIL") ?></span>
                            <input type="email" name="EMAIL" placeholder="email@mail.com" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_8_EMAIL_LINE") ?></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label">Откуда Вы узнали о нас</span>
                            <input type="text" name="FROM_WHERE" placeholder=""
                                <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                                class="v21-input-group__field v21-field"
                            >
                        </label>
                    </div><!-- /.v21-grid__item -->
                </div><!-- /.v21-grid -->

                <div class="v21-grid">
                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_CITY") ?></span>
                            <? CModule::IncludeModule('iblock'); ?>
                            <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114)); ?>
                            <select name="CITY" class="v21-input-group__field v21-select js-v21-select">
                                <? while ($city = $cities->Fetch()) { ?>
                                    <option value="<?= $city['NAME'] ?>">
                                        <?= $city['NAME'] ?>
                                    </option>
                                <? } ?>
                            </select>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_BIRTHDATE") ?></span>
                            <input type="text" inputmode="numeric" name="BIRTHDATE" data-inputmask="'mask': '99.99.9999'" placeholder="__.__.____" class="v21-input-group__field v21-field v21-datepicker js-v21-datepicker">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@md v21-grid__item--1x3@lg">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_SEX") ?></span>
                            <div class="v21-switch">
                                <label for="v21_genderMale" class="v21-switch__label">
                                    <?= GetMessage("WEBTU_FEEDBACK_8_SEX_MALE") ?>
                                    <input type="radio" name="SEX" id="v21_genderMale" value="Мужской" class="v21-switch__input v21-switch__input--left" <?/* if (!isset($arResult['POST']['SEX'])) { ?> checked <? } */?> <? if (isset($arResult['POST']['SEX'])) { ?> <? if ($arResult['POST']['SEX'] == 'Мужской') { ?> checked <? } ?> <? } ?>>
                                </label>
                                <label for="v21_genderFemale" class="v21-switch__label">
                                    <?= GetMessage("WEBTU_FEEDBACK_8_SEX_FEMALE") ?>
                                    <input type="radio" name="SEX" id="v21_genderFemale" value="Женский" class="v21-switch__input v21-switch__input--right" <? if (isset($arResult['POST']['SEX'])) { ?> <? if ($arResult['POST']['SEX'] == 'Женский') { ?> checked <? } ?> <? } ?>>
                                </label>
								<?/*?>
                                <input type="radio" name="SEX" id="v21_genderMale" value="Мужской" checked class="v21-switch__input">
                                <label for="v21_genderMale" class="v21-switch__label"><?= GetMessage("WEBTU_FEEDBACK_8_SEX_MALE") ?></label>
                                <input type="radio" name="SEX" id="v21_genderFemale" value="Женский" class="v21-switch__input">
                                <label for="v21_genderFemale" class="v21-switch__label"><?= GetMessage("WEBTU_FEEDBACK_8_SEX_FEMALE") ?></label>
                                <div class="v21-switch__handle"></div>
								<?*/?>
                            </div>
                        </div>
                    </div><!-- /.v21-grid__item -->
                </div><!-- /.v21-grid -->
            </div><!-- /.v21-service-form__section -->

            <div class="v21-service-form__section">
                <h3 class="v21-h5"><?= GetMessage("WEBTU_FEEDBACK_8_SUM") ?></h3>
                <div class="v21-grid">
                    <div class="v21-grid__item v21-grid__item--2x3@lg">
                        <div class="v21-input-group">
                            <div class="v21-input-combo">
                                <input type="text" name="SUM" inputmode="numeric" placeholder="Укажите число" class="v21-input-combo__field v21-input-group__field v21-field js-v21-string-spaces">
                                <div class="v21-input-combo__select">
                                    <select name="CURRENCY" class="v21-select js-v21-select">
                                        <option value="RUB" selected>RUB</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="CNY">CNY</option>
                                    </select>
                                </div>
                            </div>
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--2x3@lg">
                        <div class="captcha_image">
                            <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                            <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="">
                        </div>

                        <a id="reloadCaptcha" title="Обновить капчу"></a>

                        <div class="captcha_input v21-input-group">
                            <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="v21-input-group__field v21-field" id="CAPTCHA_WORD">
                            <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                        </div>
                    </div>

                    <div class="v21-grid__item">
                        <div class="v21-checkbox">
                            <!-- добавить is-error для выделения при ошибке -->
                            <label class="v21-checkbox__content">
                                <input type="checkbox" name="CITYZENSHIP" class="v21-checkbox__input">
                                <span class="v21-checkbox__text"><?= GetMessage("WEBTU_FEEDBACK_8_CITIZENSHIP") ?></span>
                            </label>
                            <!-- <span class="v21-checkbox__warn">Пример сообщения об ошибке</span> -->
                        </div><!-- /.v21-checkbox -->

                        <?
                        $politics = GetMessage("WEBTU_FEEDBACK_8_POLITICS");
                        $politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank' class='v21-link'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_8_POLITICS_1") . "</span></a>";
                        $politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank' class='v21-link'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_8_POLITICS_2") . "</span></a>";
                        $politics_output = sprintf($politics, $politics_1, $politics_2);
                        ?>

                        <div class="v21-checkbox">
                            <label class="v21-checkbox__content">
                                <input type="checkbox" name="" class="v21-checkbox__input" id="politics">
                                <span class="v21-checkbox__text">
                                    <?= $politics_output ?>
                                </span>
                            </label>
                            <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                        </div><!-- /.v21-checkbox -->
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item">
                        <button class="v21-modal__button v21-button" name="WEBTU_FEEDBACK">
                            <?= GetMessage("WEBTU_FEEDBACK_8_BUTTON") ?>
                        </button>
                    </div><!-- /.v21-grid__item -->
                </div><!-- /.v21-grid -->
            </div><!-- /.v21-service-form__section -->
        </form><!-- /.v21-service-form -->
    </div><!-- /.v21-modal__window -->
</div>

<div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_alert_depositOrder">
    <div class="v21-modal__window js-v21-modal-window">
        <a href="#v21_alert_depositOrder" class="v21-modal__close js-v21-modal-toggle">
            <svg width="24" height="24">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
            </svg>
        </a>
    </div>
</div>

<script>
    $(document).ready(function() {
        function requiredFields() {
            let arFields = [
                'input[name="PHONE"]',
                'input[name="EMAIL"]',
                'input[name="FROM_WHERE"]',
                'input[name="LAST_NAME"]',
                'input[name="FIRST_NAME"]',
                'input[name="BIRTHDATE"]'
            ];

            let countErr = 0;
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

        function yandexMetrikaForm() {
            let formFields = {
                'Поля формы':
                    {
                        'LAST_NAME': $('input[name="LAST_NAME"]').val(),
                        'FIRST_NAME': $('input[name="FIRST_NAME"]').val(),
                        'SECOND_NAME': $('input[name="SECOND_NAME"]').val(),
                        'PHONE': $('input[name="PHONE"]').val(),
                        'EMAIL': $('input[name="EMAIL"]').val(),
                        'FROM_WHERE': $('input[name="FROM_WHERE"]').val(),
                        'BIRTHDATE': $('input[name="BIRTHDATE"]').val(),
                        'SUM': $('input[name="SUM"]').val(),
                        'CITY': $('select[name="CITY"] option:selected').val(),
                    }
            };
            //console.log(formFields);
            ym(317314390, 'reachGoal', 'depositOrder', formFields);

            return true;
        }

        function makeDataLayer(id, ar_product) {
            window.dataLayer.push({
                "ecommerce": {
                    "currencyCode": "RUB",
                    "purchase": {
                        "actionField": {
                            "id" : id
                        },
                        "products": ar_product,
                    }
                }
            });
        }

        function makeArProduct(data) {
            let pos = 0;
            let ar_product = [];
            let entry = {
                'PRODUCT_ID': '<?= $_SERVER['SCRIPT_URL'] ?>',
                'NAME': '<?= $_SERVER['SCRIPT_URL'] ?>',
                'PRICE': 1,
                'DETAIL_PAGE_URL': '<?= $_SERVER['REQUEST_URI'] ?>',
                'QUANTITY': 1,
                'XML_ID': 'xml'
            };

            ar_product.push(
                {
                    "id": 'CREDIT_NAME',
                    "name": data.CREDIT_NAME,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'SUM',
                    "name": data.SUM,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'CITY',
                    "name": data.CITY,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'FROM_WHERE',
                    "name": data.FROM_WHERE,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'REQ_URI',
                    "name": data.REQ_URI,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'UTM_CAMPAIGN',
                    "name": data.UTM_CAMPAIGN,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'UTM_CONTENT',
                    "name": data.UTM_CONTENT,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'UTM_MEDIUM',
                    "name": data.UTM_MEDIUM,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'UTM_SOURCE',
                    "name": data.UTM_SOURCE,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'UTM_TERM',
                    "name": data.UTM_TERM,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );

            return ar_product;
        }

        $('#depositOrder').submit(function (e) {
            e.preventDefault();
            let pos = 0;
            let ar_product = [];
            let postTemplateID = <?= $postTemplateID; ?>;

            if ($("#politics").prop("checked")) {
                console.log('form');
                $('#politics').parent().parent().removeClass("is-error");
                if (requiredFields()) {
                    $.ajax({
                        type: "POST",
                        url: '/local/components/webtu/feedback/templates/v21_vklad/ajax.customer.php',
                        data: {
                            'fields': $(this).serialize(),
                        },
                        dataType: "json",
                        success: function (data) {
                            //console.log(data);
                            if (data.message) {
                                let response = data.message[0];
                                if(response.type) {
                                    //console.log(response.data.APPLICATION_ID);
                                    ar_product = makeArProduct(response.data);
                                    makeDataLayer(response.data.APPLICATION_ID, ar_product);
                                    //console.log(window.dataLayer);
                                    yandexMetrikaForm();
                                }
                            }

                            $('#reloadCaptcha').click();
                            if (data.message && data.message.length > 0) {
                                $(".v21_alert_depositOrder_item").remove()
                                $.each(data.message, function (key, field) {
                                    $('#v21_alert_depositOrder .v21-modal__window').append(
                                        '<div class="v21-grid__item v21_alert_depositOrder_item" style="font-size: 20px; padding: 0; text-align: center;">' + field.text + '</div>'
                                    );

                                    if (!field.type) {
                                        $('.v21_alert_depositOrder_item').css("color", "red");
                                    }
                                });
                            }
                            if (data.status) {
                                $("#depositOrder")[0].reset();
                            }

                            if (!data.captcha){
                                $('input[name="CAPTCHA_WORD"]').parent().addClass("is-error");
                            } else {
                                $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                                tsb21.modal.toggleModal('v21_alert_depositOrder');
                            }
                        }
                    });
                }
            } else {
                $('#politics').parent().parent().addClass("is-error");
            }
        });

        $('a[href="#v21_depositOrder"].open').click(function () {
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
</script>