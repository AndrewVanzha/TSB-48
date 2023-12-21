<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

    <style>
        div[id^="wait_"] { display: none !important; background: none !important; border: 0 !important; }
    </style>

<!--div class="v21-container"-->
    <?//debugg($arResult);?>
    <div class="form-block">
        <div class="form-block--left">
            <div class="form-block--image">
                <img src="/images/airplane_polygons_1280.png" class="form-block--image-1280">
                <img src="/images/airplane_polygons_1440.png" class="form-block--image-1440">
            </div>
            <!--p class="form-block--thank">Спасибо <i>за&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;обращение</i></p-->
        </div>
        <div class="form-block--right">
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="card-application--form" id="applicationForm">
                <input type="hidden" name="FORM_ID" value="<?= $arResult['FORM_ID'] ?>">
                <input type="hidden" name="SESSION_ID" value="<?= bitrix_sessid() ?>">

                <input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'>
                <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
                <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
                <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">

                <div class="card-application--content">
                    <h2 class="card-application--header"><?=GetMessage("WEBTU_FEEDBACK_3_HEADER")?></h2>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input
                                        type="text"
                                        name="COMPANY_NAME"
                                        placeholder="организация"
                                        class="input-group__field"
                                        <?// value пишу в input[name=NAME]?>
                                        onchange="javascript:document.getElementById('name_'+'<?=$arResult['FORM_ID']?>').value = this.value;"
                                    <? if (isset($arResult['POST']['COMPANY_NAME'])) { ?> value="<?=$arResult['POST']['COMPANY_NAME']?>" <? } ?>
                                >
                                <span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_ORGANIZATION")?></span>
                                <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            </label>
                        </div>
                    </div>
                    <??>
                    <input type="hidden" name="NAME" value="<?=$arResult['POST']['COMPANY_NAME']?>" id="<?= 'name_'.$arResult['FORM_ID']; ?>">

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input type="text" name="COMPANY_INN" placeholder="инн" class="input-group__field"
                                    <? if (isset($arResult['POST']['COMPANY_INN'])) { ?> value="<?=$arResult['POST']['COMPANY_INN']?>" <? } ?>
                                >
                                <??><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_INN")?></span>
                                <??>
                                <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input type="text" name="FIO" placeholder="ФИО" class="input-group__field"
                                    <? if (isset($arResult['POST']['FIO'])) { ?> value="<?=$arResult['POST']['FIO']?>" <? } ?>
                                >
                                <??><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_NAME")?></span><??>
                                <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            </label>
                        </div>
                    </div>

                    <??>
                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <div class="input-group">
                                <??><? CModule::IncludeModule('iblock'); ?>
                                <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y")); ?>
                                <select name="CITY" class="input-group__field select_field">
                                    <? while ($city = $cities->Fetch()) : ?>
                                        <option value="<?= $city['NAME'] ?>">
                                            <?= $city['NAME'] ?>
                                        </option>
                                    <? endwhile; ?>
                                </select>
                                <span class="input-group__label input-group__label--city"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span>
                            </div>
                        </div>
                    </div>
                    <??>

                    <div class="card-application--form__section">
                        <div class="grid__item-2">
                            <label class="input-group">
                                <input type="tel" name="TEL" placeholder="+7 ___ ___ __ __" data-inputmask="'mask': '+7 999 999 99 99'" class="input-group__field input_phone"
                                    <? if (isset($arResult['POST']['TEL'])) { ?> value="<?=$arResult['POST']['TEL']?>" <? } ?>
                                >
                                <span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_PHONE") ?></span>
                                <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            </label>
                        </div>

                        <div class="grid__item-2">
                            <label class="input-group">
                                <input type="email" name="EMAIL" placeholder="email@mail.com" class="input-group__field"
                                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                                >
                                <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                                <span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_EMAIL") ?></span>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input type="text" name="FROM_WHERE" placeholder=" " class="input-group__field"
                                    <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                                >
                                <??><span class="input-group__label">Откуда Вы узнали о нас</span><??>
                                <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section card-application--form__captcha">
                        <?
                        $politics = GetMessage("WEBTU_FEEDBACK_3_POLITICS");
                        $politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank' class='v21-link'><span>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_1"). "</span></a>";
                        $politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank' class='v21-link'><span>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_2"). "</span></a>";
                        $politics_output = sprintf($politics, $politics_1, $politics_2);
                        ?>

                        <div class="grid__item-1">
                            <div class="v21-checkbox">
                                <label class="v21-checkbox__content">
                                    <input type="checkbox" name="" class="v21-checkbox__input" id="politics1">
                                    <div class="v21-checkbox__text"><?= $politics_output ?></div>
                                </label>
                                <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                            </div>
                        </div>

                        <div class="grid__item-captcha">
                            <div class="grid__item-2">
                                <div class="captcha_image">
                                    <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                                    <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="капча">
                                </div>

                                <a id="reloadCaptchaAccount" title="Обновить капчу"></a>
                            </div>

                            <div class="grid__item-2">
                                <div class="v21-input-group">
                                    <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="input-group__field input-captcha" id="CAPTCHA_WORD">
                                    <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <button class="grid__item-button" name="WEBTU_FEEDBACK">
                                <?= GetMessage("WEBTU_FEEDBACK_3_BUTTON") ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <path d="M14.7307 1.51639C14.7307 0.964101 14.283 0.516386 13.7307 0.516386L4.73068 0.516387C4.1784 0.516386 3.73068 0.964102 3.73068 1.51639C3.73068 2.06867 4.1784 2.51639 4.73068 2.51639L12.7307 2.51639L12.7307 10.5164C12.7307 11.0687 13.1784 11.5164 13.7307 11.5164C14.283 11.5164 14.7307 11.0687 14.7307 10.5164L14.7307 1.51639ZM1.70711 14.9542L14.4378 2.22349L13.0236 0.80928L0.292893 13.54L1.70711 14.9542Z" fill="white"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div><!-- v21-card-application--form__section -->
            </form>
        </div>
    </div>

<!--/div-->

<script type="text/javascript">
    $(document).ready(function() {
        $('input[name=NAME]').val($('input[name=COMPANY_NAME]').val()); // пишу в input[name=NAME] исходное значение из input[name=COMPANY_NAME]

        function changeColors(scrollTop) {
            let opacityLevel = 1;
            let param1;  // rgba(21,24,45,1);
            let param2;  // rgba(0,52,94,1);
            const inversionOffset = 100; // метка первой смены цвета, привязана к блоку - не нужна
            const opacityOffset = 0; // метка отмены смены цвета, привязана к блоку - не нужна
            const classOffset = 150; // не нужна
            const windowInnerWidth = window.innerWidth;
            let formBlockTop = $('.card-application--form').offset().top;
            let fixLevel1 = formBlockTop - windowInnerWidth * .17; // уровень первого переключения было .35
            let fixLevel2 = formBlockTop + $('.card-application--form').height() * .6 - opacityOffset; // уровень второго переключения
            let fixLevel3 = formBlockTop - inversionOffset + classOffset; // не нужен
            let fixLevel = (fixLevel1 - scrollTop) / opacityOffset; // диапазон смены прозрачности - не нужен

            if(scrollTop > fixLevel2) {
                $('.ved-page__background-blue').css('opacity', '0');
                $('.v21 .v21-card-application').removeClass('js-color-switch');
                $('.v21 .v21-ved-hedge').removeClass('js-color-switch');
                $('.v21 .v21-block-interests').removeClass('js-color-switch');
            } else if(scrollTop > fixLevel1) {
                $('.ved-page__background-blue').css('opacity', '1');
                $('.v21 .v21-card-application').addClass('js-color-switch');
                $('.v21 .v21-ved-hedge').addClass('js-color-switch');
                $('.v21 .v21-block-interests').addClass('js-color-switch');
            } else {
                //$('.v21-card-application').css('background', 'linear-gradient(106.11deg, '+param1+' 27.82%, '+param2+' 100%)');
                $('.ved-page__background-blue').css('opacity', '0');
                $('.v21 .v21-card-application').removeClass('js-color-switch');
                $('.v21 .v21-ved-hedge').removeClass('js-color-switch');
                $('.v21 .v21-block-interests').removeClass('js-color-switch');
            }
        }
        changeColors($(window).scrollTop());

        $(window).on('scroll',function(){
            let $window = $(window);
            let scrollTop = $window.scrollTop();

            changeColors(scrollTop);
        });

        $('#reloadCaptchaAccount').click(function() {
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
        let arFields = [
            'input[name="COMPANY_NAME"]',
            'input[name="COMPANY_INN"]',
            'input[name="FIO"]',
            'input[name="CITY"]',
            'input[name="TEL"]', // влияет вторая форма на странице
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
        if($('#politics1').is(':checked')) {
            $('#politics1').parent().parent().removeClass("is-error");
        } else {
            countErr += 1;
            $('#politics1').parent().parent().addClass("is-error");
        }

        return (countErr > 0) ? false : true;
    }

    $('#applicationForm').submit(function (e) {
        e.preventDefault();
        //console.log('form');
        //if ($("#politics1").prop("checked")) {
            //$('#politics1').parent().parent().removeClass("is-error");
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
                            $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                            document.location.href = "/thanks/";
                        } else {
                            console.log('not OK');
                            if (!data.captcha){
                                $('input[name="CAPTCHA_WORD"]').parent().addClass("is-error");
                            } else {
                                $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                            }
                        }
                    }
                });
            }
        //} else {
        //    $('#politics1').parent().parent().addClass("is-error");
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