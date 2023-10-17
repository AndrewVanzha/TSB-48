<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?php
if ($arResult['POST']['OPERATION']) {
    $nameString = $arResult['POST']['OPERATION'];
} else {
    $nameString = $arParams['TYPE_CHOICE'];
}
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
                <h2 class="v21-h2 card-application--header">Онлайн-заявка на конверсионные операции</h2>

                <div class="v21-grid grid-bottom" style="justify-content: space-between;">
                    <div class="v21-grid__item v21-grid__item--3x4@xl">
                        <label class="v21-input-group">
                            <? CModule::IncludeModule('iblock'); ?>
                            <?
                            $arSelect = Array("ID", "NAME", "PROPERTY_ADD_BLOCK_HEADER");
                            $arFilter = Array("IBLOCK_ID"=>78, "ACTIVE"=>"Y");
                            $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
                            ?>
                            <span class="v21-input-group__label"><b><?=GetMessage("WEBTU_FEEDBACK_4_OPERATION")?></b></span>
                            <select name="OPERATION" class="input-group__field v21-field select_field" id="konversionType">
                                <?
                                while ($ob = $res->GetNextElement()) :
                                    $arFields = $ob->GetFields();
                                    //$arProps = $ob->GetProperties();
                                    ?>
                                    <option value="<?= $arFields['PROPERTY_ADD_BLOCK_HEADER_VALUE'] ?>" data-idvalue="<?=$arFields['ID']?>" <?= ($_POST['OPERATION'] == $arFields['PROPERTY_ADD_BLOCK_HEADER_VALUE']) ? 'selected="selected"' : ''; ?> <?= ($_GET['q'] && $arParams['TYPE_CHOICE'] == $arFields['PROPERTY_ADD_BLOCK_HEADER_VALUE']) ? 'selected="selected"' : ''; ?>>
                                        <?= $arFields['PROPERTY_ADD_BLOCK_HEADER_VALUE'] ?>
                                    </option>
                                <? endwhile; ?>
                            </select>
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                        <?/*?><input type="hidden" name="NAME" value="<?=$nameString?>" id="<?= 'name_'.$arResult['FORM_ID']; ?>"><?*/?>
                    </div>

                    <div class="v21-grid__item v21-grid__item--1x2@lg v21-grid__item--1x4@xl">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><b>Откуда Вы узнали о нас</b></span>
                            <input type="text" name="FROM_WHERE" placeholder=""
                                <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                                   class="v21-input-group__field v21-field"
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

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
                    <input type="hidden" name="NAME" value="<?=($arResult['POST']['FIO'].$arResult['POST']['FIO'])?>" id="<?= 'name_'.$arResult['FORM_ID']; ?>">

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
                        </div>
                        <span class="v21-input-group__warn">Неверно введен код с картинки</span>
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
                                <input id="politics2" type="checkbox" checked name="politics" class="v21-checkbox__input" >
                                <span class="v21-checkbox__text">
                                    <?= $politics_output ?>
                                </span>
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
        $('.js-fKonversionForm').on('click', function() {
            let href = $(this).attr('href');
            let type = $(this).data('item');
            console.log(this.dataset.name);
            $('#konversionType').val(this.dataset.name);
            $('html, body').animate({
                scrollTop: $(href).offset().top - 120
            }, {
                duration: 800,   // по умолчанию «400»
                easing: "linear" // по умолчанию «swing»
            });
            $('input[name=NAME]').val($('select[name=OPERATION]').val()); // пишу в input[name=NAME] исходное значение из select[name=OPERATION]
            return false;
        });
    });
</script>

<script type="text/javascript">
   $(document).ready(function() {
       /*$('select[name=OPERATION]').on('change', function () {
           $('input[name=NAME]').val($('select[name=OPERATION]').val());
       });*/
       $('input[name=FIO]').on('change', function () {
           $('input[name=NAME]').val($('input[name=FIO]').val()); // пишу в input[name=NAME] исходное значение из input[name=COMPANY_NAME]
           console.log($('input[name=FIO]').val());
       });

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

    $('#applicationForm').submit(function (e) {
        e.preventDefault();
        console.log('1');
        if ($("#politics2").prop("checked")) {
            $('#politics2').parent().parent().removeClass("is-error");
            console.log('2');
            if (requiredFields()) {
                console.log('3');
                $.ajax({
                    type: "POST",
                    url: '/ajax_scripts/ajax.customer.php',
                    data: {
                        'fields': $(this).serialize(),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log('**');
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
        } else {
            $('#politics2').parent().parent().addClass("is-error");
        }
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
