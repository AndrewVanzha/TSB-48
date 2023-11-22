<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
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

    <style>
        div[id^="wait_"] { display: none !important; background: none !important; border: 0 !important; }
    </style>

<div class="v21-credit-application--top">
    <div class="v21-credit-application--bg"></div>
</div>
<? //echo $_POST["CREDIT_NAME"] ?>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="v21-credit-application--form" id="fBusinessCreditForm">
    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
    <?
    if (isset($_POST['CREDIT_NAME'])) { $creditName = $_POST['CREDIT_NAME']; } else { $creditName = ''; }
    ?>
    <input type="hidden" name="CREDIT_NAME" id="credit_name" value="<?=$creditName?>">
    <input type="hidden" name="CREDIT_CURRENCY" value="RUB">
    <input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'>
    <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
    <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
    <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">

    <div class="v21-credit-application--content">
        <h2 class="v21-h2 v21-credit-application--header">
            <?=GetMessage("WEBTU_FEEDBACK_3_HEADER")?>
        </h2>

        <div class="v21-grid__item-3">
            <div class="v21-grid">
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <label class="v21-input-group">
                        <span class="v21-input-group__biglabel"><?=GetMessage("WEBTU_FEEDBACK_3_ORGANIZATION")?></span>
                        <input type="text" name="ORGANIZATION" placeholder="ИП/ЮЛ" class="v21-input-group__field v21-field"
                            <? if (isset($arResult['POST']['ORGANIZATION'])) { ?> value="<?=$arResult['POST']['ORGANIZATION']?>" <? } ?>
                        >
                        <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                    </label>
                </div>

                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <label class="v21-input-group">
                        <span class="v21-input-group__biglabel"><?=GetMessage("WEBTU_FEEDBACK_3_CREDIT_SUMM")?></span>
                        <input type="text" name="CREDIT_SUMM" placeholder="10 000 000" class="v21-input-group__field v21-field"
                            <? if (isset($arResult['POST']['CREDIT_SUMM'])) { ?> value="<?=$arResult['POST']['CREDIT_SUMM']?>" <? } ?>
                        >
                        <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        <span class="v21-input-group__add">RUB</span>
                    </label>
                </div>

                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <label class="v21-input-group">
                        <span class="v21-input-group__biglabel">Откуда Вы узнали о нас</span>
                        <input type="text" name="FROM_WHERE" placeholder=""
                               class="v21-input-group__field v21-field"
                            <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                        >
                        <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="v21-grid__item-3">
            <h3 class="v21-input-group__biglabel">Контактные данные</h3>
            <div class="v21-grid">
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <label class="v21-input-group">
                        <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_NAME") ?></span>
                        <input type="text" name="NAME" placeholder="ФИО" class="v21-input-group__field v21-field"
                            <? if (isset($arResult['POST']['NAME'])) { ?> value="<?=$arResult['POST']['NAME']?>" <? } ?>>
                        <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                    </label>
                </div>

                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <label class="v21-input-group">
                        <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_PHONE") ?></span>
                        <input type="tel" name="PHONE" placeholder="+7 ___ _______" data-inputmask="'mask': '+7 999 9999999'" class="v21-input-group__field v21-field"
                            <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                        >
                        <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_3_PHONE_LINE") ?></span>
                    </label>
                </div>

                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <label class="v21-input-group">
                        <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_EMAIL") ?></span>
                        <input type="email" name="EMAIL" placeholder="email@mail.com" class="v21-input-group__field v21-field"
                            <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                        >
                        <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_3_EMAIL_LINE") ?></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="v21-credit-application--form__section">
            <div class="v21-grid">
                <div class="v21-grid__item v21-grid__item--2x3@lg">
                    <div class="captcha_image">
                        <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                        <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="капча">
                    </div>

                    <a id="reloadCaptcha" title="Обновить капчу"></a>

                    <div class="captcha_input v21-input-group">
                        <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="v21-input-group__field v21-field v21-input-captcha" id="CAPTCHA_WORD">
                    </div>
                    <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                </div><!-- /.v21-grid__item -->

                <?
                $politics = GetMessage("WEBTU_FEEDBACK_3_POLITICS");
                $politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank' class='v21-link'><span class='v21-link__text'>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_1"). "</span></a>";
                $politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank' class='v21-link'><span class='v21-link__text'>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_2"). "</span></a>";
                $politics_output = sprintf($politics, $politics_1, $politics_2);
                ?>

                <div class="v21-grid__item">
                    <div class="v21-checkbox">
                        <label class="v21-checkbox__content">
                            <input type="checkbox" name="" class="v21-checkbox__input" id="politics2">
                            <span class="v21-checkbox__text"><?= $politics_output ?></span>
                        </label>
                        <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                    </div><!-- /.v21-checkbox -->
                </div><!-- /.v21-grid__item -->

                <div class="v21-grid__item">
                    <button class="v21-modal__button v21-button" name="WEBTU_FEEDBACK">
                        <?= GetMessage("WEBTU_FEEDBACK_3_BUTTON") ?>
                    </button>
                </div>

            </div><!-- /.v21-grid -->
        </div><!-- /.v21-curraccount-form__section -->

    </div><!-- v21-credit-application--form__section -->
</form>

<script type="text/javascript">
   $(document).ready(function() {
      $('#reloadCaptcha').click(function() {
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImg').attr('src','/bitrix/tools/captcha.php?captcha_sid=' + data);
            $('#captchaSid').val(data);
        });
        return false;
      });
   });
</script>

<script>
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
        //document.location.href = "/thanks/";
    }

    /*$('.feedback_form .button').click(function () {
        $(".alert").remove();
    });*/

    function requiredFields() {
        let arCheckFields = [
            'input[name="ORGANIZATION"]',
            'input[name="CREDIT_SUMM"]',
            'input[name="NAME"]',
            'input[name="PHONE"]',
            'input[name="EMAIL"]',
            'input[name="FROM_WHERE"]',
        ];

        let countErr = 0;

        arCheckFields.forEach(function (value) {
            if ($(value).val() == '') {
                $(value).parent().addClass("is-error");
                countErr += 1;
            } else {
                $(value).parent().removeClass("is-error");
            }
        });
        if($('#politics2').is(':checked')) {
            $('#politics2').parent().parent().removeClass("is-error");
        } else {
            countErr += 1;
            $('#politics2').parent().parent().addClass("is-error");
        }

        return (countErr > 0) ? false : true;
    }

    // https://osipenkov.ru/tracking-fileds-yandex-metrika-gtm/
    // https://blog.targeting.school/kakie-byvayut-tseli-v-ya-metrike-i-kak-rabotaet-novaya-tsel-otpravka-formy/
    // https://www.yandex.ru/video/preview/17446571467160561628
    function yandexMetrikaForm() {
        //yaCounter49389685
        //yaCounter315345643.reachGoal('applicationForm'); // ошика
        //ym(315345643, 'reachGoal', 'applicationForm');

        let formFields = {
            'Отправка формы':
                {
                    //'Имя получателя': {{Поле JS - Имя получателя}},
                    'Имя получателя': 'Имя получателя',
                    //'Email получателя': {{Поле JS - Email получателя}},
                    'Email получателя': 'Email получателя',
                    //'Ваше имя': {{Поле JS - Ваше имя}},
                    'Ваше имя': 'Ваше имя',
                    //'Ваш Email': {{Поле JS - Ваш email}},
                    'Ваш Email': 'Поле JS - Ваш email',
                    //'Тема подарочного сертификата': {{Поле JS - Тема подарочного сертификат}},
                    'Тема подарочного сертификата': 'Поле JS - Тема подарочного сертификат',
                    //'Сообщение': {{Поле JS - Сообщение}},
                    'Сообщение': 'Поле JS - Сообщение',
                    //'Сумма': {{Поле JS - Сумма}},
                    'Сумма': 'Поле JS - Сумма',
                }
        };
        //ym(955, 'reachGoal', 'applicationForm', formFields);

        let entry = {
            'PRODUCT_ID': 0,
            'NAME': 'form',
            'PRICE': 11,
            'DETAIL_PAGE_URL': '<?= $_SERVER['REQUEST_URI'] ?>',
            'QUANTITY': 1,
            'XML_ID': 'xml'
        };
        let postTemplateID = '<?= $postTemplateID; ?>';
        if(postTemplateID) {
            entry.PRODUCT_ID = postTemplateID; // ID почтового шаблона
        }
        //console.log('postTemplateID');
        //console.log(postTemplateID);
        let pos = 1;
        let ar_product = [];
        ar_product.push(
            {
                "id": entry.PRODUCT_ID,
                "name": entry.NAME,
                "price": entry.PRICE,
                "category": entry.DETAIL_PAGE_URL,
                "quantity": entry.QUANTITY,
                "position": pos++,
                "xml": entry.XML_ID,
            },
        );
        makeDataLayer(1, ar_product);
        //console.log(window.dataLayer);

        return true;
    }

    function makeDataLayer(id, ar_product) {
        window.dataLayer.push({
            //local_dataLayer.push({
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

    $('#fBusinessCreditForm').submit(function (e) {
        e.preventDefault();
        console.log('form');
        //if ($("#politics2").prop("checked")) {
            //$('#politics2').parent().parent().removeClass("is-error");
            //console.log('2');
            if (requiredFields()) {
                //console.log('3');
                $.ajax({
                    type: "POST",
                    url: '/ajax_scripts/ajax.customer.php',
                    data: {
                        'fields': $(this).serialize(),
                    },
                    dataType: "json",
                    success: function (data) {
                        //console.log('**');
                        if (data.status) {
                            clearFields ();
                            $('input[name="CAPTCHA_WORD"]').parent().parent().removeClass("is-error");
                            $('input[name="CAPTCHA_WORD"]').css('border-color', 'rgba(32, 32, 32, 0.12)');
                            document.location.href = "/thanks/";
                        } else {
                            console.log('not OK');
                            if (!data.captcha){
                                $('input[name="CAPTCHA_WORD"]').parent().parent().addClass("is-error");
                                $('input[name="CAPTCHA_WORD"]').css('border-color', '#aa0000');
                            } else {
                                $('input[name="CAPTCHA_WORD"]').parent().parent().removeClass("is-error");
                                $('input[name="CAPTCHA_WORD"]').css('border-color', 'rgba(32, 32, 32, 0.12)');
                            }
                        }
                    }
                });
            }
        //} else {
        //    $('#politics2').parent().parent().addClass("is-error");
        //}
    });
</script>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('input[data-mask="phone"]').mask('+7 999 9999999');

        $('.select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>