<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?php
$arSections = [];
$ar_filter = Array('IBLOCK_ID'=>217, 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE'=>'Y'); // Страхование физлиц
$ar_select = Array('ID', 'NAME', 'CODE', 'DESCRIPTION');
$rsSection = \Bitrix\Iblock\SectionTable::getList(array(
    'order' => array('LEFT_MARGIN'=>'ASC'),
    'filter' => $ar_filter,
    'select' => $ar_select,
));
while ($ar_section=$rsSection->fetch()) {
    $arSections[] = $ar_section;
}
//debugg($arSections);
?>
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

<?//debugg($arResult);?>
<div class="form-block">
    <div class="form-block--right">
        <div class="form-block--img">
            <img src="/local/templates/v21_template_home/img/v21_v21-service-form.png" alt="самолетик">
        </div>
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="card-application--form" id="applicationForm">
            <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
            <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
            <input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'>
            <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
            <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">

            <div class="card-application--content">
                <h2 class="v21-h2 card-application--header">Онлайн-заявка на депозит</h2>

                <div class="v21-grid grid-bottom">
                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label"><b><?=GetMessage("WEBTU_FEEDBACK_4_ORGANIZATION")?></b></span>
                            <input
                                    type="text"
                                    name="COMPANY_NAME"
                                    placeholder="Организация"
                                    class="v21-input-group__field v21-field"
                                <?// value пишу в input[name=NAME]?>
                                    <??>onchange="javascript:document.getElementById('name_'+'<?=$arResult['FORM_ID']?>').value = this.value;"<??>
                                <? if (isset($arResult['POST']['COMPANY_NAME'])) { ?> value="<?=$arResult['POST']['COMPANY_NAME']?>" <? } ?>
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div>
                    <input type="hidden" name="NAME" value="<?=$arResult['POST']['COMPANY_NAME']?>" id="<?= 'name_'.$arResult['FORM_ID']; ?>">

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <? CModule::IncludeModule('iblock'); ?>
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><b><?= GetMessage("WEBTU_FEEDBACK_4_CITY") ?></b></span>
                            <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114)); ?>
                            <select name="CITY" class="v21-input-group__field v21-field jjs-v21-select">
                                <? while ($city = $cities->Fetch()) { ?>
                                    <option value="<?= $city['NAME'] ?>" <? if ($arResult['POST']['CITY'] == $city['NAME']) { ?>selected<? } ?> <? if (!isset($arResult['POST']['CITY']) && $city['NAME'] == 'Москва') { ?>selected<? } ?>>
                                        <?= $city['NAME'] ?>
                                    </option>
                                    <? if ($city['ID'] != 400) : // Исключаем Санкт-Петербург ?>
                                    <? endif; ?>
                                <? } ?>
                            </select>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><b><?= GetMessage("WEBTU_FEEDBACK_4_DEPOSIT_SUM") ?></b></span>
                            <input
                                    type="text" name="DEPOSIT_SUM"
                                    placeholder="Сумма"
                                <? if (isset($arResult['POST']['DEPOSIT_SUM'])) { ?> value="<?=$arResult['POST']['DEPOSIT_SUM']?>" <? } ?>
                                    class="v21-input-group__field v21-field"
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->
                    <input type="hidden" name="CURRENCY" value="руб.">

                </div>

                <h3 class="card-application--subheader">Контактные данные</h3>

                <div class="v21-grid grid-bottom">
                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_FIO") ?></span>
                            <input
                                type="text" name="FIO"
                                placeholder="ФИО"
                                <? if (isset($arResult['POST']['FIO'])) { ?> value="<?=$arResult['POST']['FIO']?>" <? } ?>
                                class="v21-input-group__field v21-field"
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PHONE") ?></span>
                            <input
                                    type="tel" name="PHONE"
                                    placeholder="+7 ___ ___ __ __"
                                    data-inputmask="'mask': '+7 999 999 99 99'"
                                    class="v21-input-group__field v21-field"
                                <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_4_PHONE_LINE") ?></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_EMAIL") ?></span>
                            <input
                                    type="email" name="EMAIL"
                                    placeholder="email@mail.com"
                                    class="v21-input-group__field v21-field"
                                <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_4_EMAIL_LINE") ?></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label">Откуда Вы узнали о нас</span>
                            <input
                                    type="text" name="FROM_WHERE"
                                    placeholder=""
                                <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                                    class="v21-input-group__field v21-field"
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                </div><!-- /.v21-grid -->

                <div class="v21-grid">
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

                    <?
                    $politics = GetMessage("WEBTU_FEEDBACK_4_POLITICS");
                    $politics_1 = "<a class='v21-link' href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_4_POLITICS_1") . "</span></a>";
                    $politics_2 = "<a class='v21-link' href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_4_POLITICS_2") . "</span></a>";
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

                    <div class="v21-plastic-form__controls v21-grid__item">
                        <button class="v21-plastic-form__submit v21-button" name="WEBTU_FEEDBACK">
                            <?= GetMessage("WEBTU_FEEDBACK_4_BUTTON") ?>
                        </button>
                    </div><!-- /.v21-plastic-form__controls -->
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.js-fDepositForm').on('click', function() {
            let href = $(this).attr('href');
            let type = $(this).data('item');
            $('html, body').animate({
                scrollTop: $(href).offset().top - 120
            }, {
                duration: 800,   // по умолчанию «400»
                easing: "linear" // по умолчанию «swing»
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
   $(document).ready(function() {
       $('input[name=NAME]').val($('input[name=COMPANY_NAME]').val()); // пишу в input[name=NAME] исходное значение из input[name=COMPANY_NAME]

       $('#reloadCaptcha').click(function() {
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImg').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
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
        let arFields = [
            'input[name="COMPANY_NAME"]',
            'input[name="CITY"]',
            'input[name="DEPOSIT_SUM"]',
            'input[name="FIO"]',
            'input[name="PHONE"]',
            'input[name="EMAIL"]',
            'input[name="FROM_WHERE"]',
        ];

        let countErr = 0;

        arFields.forEach(function (value) {
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
            'DETAIL_PAGE_URL': '/corporative-clients/razmeshchenie-sredstv/depozity/',
            'QUANTITY': 1,
            'XML_ID': 'xml'
        };
        let postTemplateID = <?= $postTemplateID; ?>;
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

    $('#applicationForm').submit(function (e) {
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
        $('input[data-mask="date"]').mask( '99.99.9999', {
            placeholder: 'дд.мм.гггг'
        } );
        $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');
        $('input[data-mask="seriya"]').mask('99 99', {
            placeholder: 'SS SS'
        } );
        $('.select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>
