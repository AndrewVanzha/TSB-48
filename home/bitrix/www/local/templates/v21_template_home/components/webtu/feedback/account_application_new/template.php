<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<!--div class="v21-container"-->
    <?//debugg($arResult);?>
    <div class="form-block">
        <div class="form-block--left">
            <div class="form-block--image">
                <img src="images/airplane_250.png" class="form-block--image-768" alt="самолетик">
                <img src="images/airplane_400.png" class="form-block--image-1024" alt="самолетик">
                <img src="images/airplane_539.png" class="form-block--image-1366" alt="самолетик">
            </div>
            <!--p class="form-block--thank">Спасибо <i>за&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;обращение</i></p-->
        </div>
        <div class="form-block--right">
            <?/*?><form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="v21-card-application--form" id="fBusinessCreditForm"><?*/?>
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="card-application--form" id="applicationForm">
                <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
                <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
                <input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'>
                <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
                <?
                if (isset($_POST['CREDIT_NAME'])) { $creditName = $_POST['CREDIT_NAME']; } else { $creditName = 'MIR'; }
                ?>
                <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
                <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">

                <div class="card-application--content">
                    <?/*?><h2 class="card-application--header"><?= GetMessage("WEBTU_FEEDBACK_3_HEADER") ?></h2><?*/?>
                    <h2 class="card-application--header"><?= $arParams['FORM_HEADER'] ?></h2>

                    <?/* if (!empty($arResult['ERRORS'])) { ?>
                        <? foreach ($arResult['ERRORS'] as $error) { ?>
                            <div class="alert alert-danger"><?=$error?></div>
                        <? } ?>
                    <? } ?>

                    <? if (!empty($arResult['SUCCESS'])) { ?>
                        <? foreach ($arResult['SUCCESS'] as $success) { ?>
                            <div class="alert alert-success"><?=$success?></div>
                        <? } ?>
                    <? } */?>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input class="input-group__field"
                                        type="text"
                                        name="COMPANY_NAME"
                                        placeholder="Название организации"
                                        <?// value пишу в input[name=NAME]?>
                                        onchange="javascript:document.getElementById('name_'+'<?=$arResult['FORM_ID']?>').value = this.value;"
                                    <? if (isset($arResult['POST']['COMPANY_NAME'])) { ?> value="<?=$arResult['POST']['COMPANY_NAME']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_ORGANIZATION")?></span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="NAME" value="<?=$arResult['POST']['COMPANY_NAME']?>" id="<?= 'name_'.$arResult['FORM_ID']; ?>">

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input class="input-group__field"
                                        type="text"
                                        name="COMPANY_INN"
                                        placeholder="ИНН компании"
                                    <? if (isset($arResult['POST']['COMPANY_INN'])) { ?> value="<?=$arResult['POST']['COMPANY_INN']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_INN")?></span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_NAME")?></span><?*/?>
                                <input class="input-group__field"
                                        type="text" name="FIO"
                                        placeholder="ФИО"
                                    <? if (isset($arResult['POST']['FIO'])) { ?> value="<?=$arResult['POST']['FIO']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_NAME")?></span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                            </label>
                        </div>
                    </div>

                    <??>
                    <div class="card-application--form__section">
                        <?// debugg($arResult["CITIES"]); ?>
                        <div class="grid__item-2">
                            <div class="input-group js-change-input-color">
                                <?/*?><span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span><?*/?>
                                <?// CModule::IncludeModule('iblock'); ?>
                                <?/*?><? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114)); ?>
                                <select name="CITY" class="input-group__field select_field">
                                    <? while ($city = $cities->Fetch()) : ?>
                                        <option value="<?= $city['NAME'] ?>">
                                            <?= $city['NAME'] ?>
                                        </option>
                                    <? endwhile; ?>
                                </select>
                                <?*/?>
                                <?/*?><span class="input-group__label input-group__label--city"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span><?*/?>
                                <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y")); ?>
                                <select name="CITY" class="v21-input-group__field v21-select js-v21-select city-select">
                                    <? foreach ($arResult['CITIES'] as $city) : ?>
                                        <option value="<?= $city ?>"
                                                <? if ($arResult['POST']['CITY'] == $city) { ?>selected<? } ?>
                                                <?/* if (!isset($arResult['POST']['CITY']) && $city == $arResult['SPECIAL_CITY']) { ?>selected<? } */?>>
                                            <?= $city ?>
                                        </option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <? //debugg($arResult['ACCOUNT_CURRENCY']); ?>
                        <div class="grid__item-2">
                            <div class="input-group js-change-input-color">
                                <?/*?><span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span><?*/?>
                                <?/*?><span class="input-group__label input-group__label--city"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span><?*/?>
                                <select name="CURRENCY" class="v21-input-group__field v21-select js-v21-select city-select">
                                    <? foreach ($arResult['ACCOUNT_CURRENCY'] as $curr) : ?>
                                        <option value="<?= $curr ?>"
                                                <? if ($arResult['POST']['CURRENCY'] == $curr) { ?>selected<? } ?>
                                                <?/* if (!isset($arResult['POST']['CURRENCY']) && $city['CURRENCY'] == $arResult['SPECIAL_CITY']) { ?>selected<? } */?>>
                                            <?= $curr ?>
                                        </option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <??>

                    <div class="card-application--form__section">
                    <div class="grid__item-2">
                            <label class="input-group">
                                <input class="input-group__field"
                                    type="email" name="EMAIL"
                                    placeholder="Электронная почта"
                                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                                <?/*?><span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_EMAIL") ?></span><?*/?>
                                <?/*?><span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_3_EMAIL_LINE") ?></span><?*/?>
                            </label>
                        </div>

                        <div class="grid__item-2">
                            <label class="input-group">
                                <input class="input-group__field"
                                    type="tel" name="TEL"
                                    <?/*?>placeholder="+7 ___ ___ __ __"<?*/?>
                                    placeholder="Мобильный телефон"
                                    data-inputmask="'mask': '+7 999 999 99 99'"
                                    <? if (isset($arResult['POST']['TEL'])) { ?> value="<?=$arResult['POST']['TEL']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_PHONE") ?></span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                                <?/*?><span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_3_PHONE_LINE") ?></span><?*/?>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input class="input-group__field"
                                        type="text"
                                        name="FROM_WHERE"
                                        placeholder="Откуда Вы узнали о нас"
                                    <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label">Откуда Вы узнали о нас</span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section card-application--form__captcha">
                        <?
                        $politics = GetMessage("WEBTU_FEEDBACK_3_POLITICS");
                        $politics_1 = "<a href='/assets/docs/Правила оформления онлайн заявок.pdf' target='_blank' class='v21-link'><span>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_1"). "</span></a>";
                        $politics_2 = "<a href='/assets/docs/Согласие на обработку ПД для сайта.pdf' target='_blank' class='v21-link'><span>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_2"). "</span></a>";
                        $politics_output = sprintf($politics, $politics_1, $politics_2);
                        ?>

                        <div class="grid__item-1 grid__item-48">
                            <div class="v21-checkbox">
                                <label class="v21-checkbox__content">
                                    <input type="checkbox" name="" class="v21-checkbox__input" id="politics2">
                                    <div class="v21-checkbox__text"><?= $politics_output ?></div>
                                </label>
                                <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                                <?/*?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M4.35462 8.83905L9.85267 2.93903C9.94763 2.8316 10 2.6933 10 2.55005C10 2.4068 9.94763 2.26846 9.85267 2.16104C9.8081 2.11044 9.75321 2.06988 9.6917 2.04211C9.63019 2.01434 9.56345 2 9.49594 2C9.42842 2 9.36168 2.01434 9.30017 2.04211C9.23866 2.06988 9.18378 2.11044 9.1392 2.16104L4.00291 7.67303L0.861593 4.16403C0.816839 4.11355 0.76184 4.07313 0.700259 4.04544C0.638677 4.01776 0.571911 4.00345 0.50437 4.00345C0.436829 4.00345 0.370062 4.01776 0.308481 4.04544C0.246899 4.07313 0.191901 4.11355 0.147146 4.16403C0.0523127 4.27171 0 4.41017 0 4.55353C0 4.69689 0.0523127 4.83537 0.147146 4.94305L3.64519 8.84305C3.69037 8.89218 3.74535 8.93132 3.80659 8.95798C3.86783 8.98464 3.93395 8.99821 4.00076 8.99783C4.06758 8.99746 4.13358 8.98316 4.19451 8.95581C4.25545 8.92846 4.31001 8.88869 4.35462 8.83905Z" fill="#FFFFFF"/>
                                    </svg>
                                <?*/?>
                            </div>
                        </div>

                        <div class="grid__item-captcha grid__item-48">
                            <div class="grid__item-2">
                                <div class="captcha_image">
                                    <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                                    <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="капча">
                                </div>

                                <a id="reloadCaptcha" title="Обновить капчу"></a>
                            </div>

                            <div class="grid__item-2">
                                <?/*?><div class="captcha_input v21-input-group"><?*/?>
                                <div class="v21-input-group">
                                    <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="input-group__field input-captcha" id="CAPTCHA_WORD">
                                    <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                                    <?/* if (in_array("Неверно введен код с картинки", $arResult['ERRORS'])) : ?>
                                        <span class="v21-input-group__warn" style="display: block;">Неверно введен код с картинки</span>
                                    <? endif; */?>
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

                    <?/* if (!empty($arResult['SUCCESS'])) {
                        LocalRedirect('/thanks/');
                    } */?>

                </div><!-- v21-card-application--form__section -->
            </form>
        </div>
    </div>

<!--/div-->

<script type="text/javascript">
    $(document).ready(function() {
        $('input[name=NAME]').val($('input[name=COMPANY_NAME]').val()); // пишу в input[name=NAME] исходное значение из input[name=COMPANY_NAME]

        $('.js-change-input-color').click(function () {
            console.log('click');
            console.log($(this));
            $(this).addClass('input-black-color');
        });

        function changeColors(scrollTop) {
            let opacityLevel = 1;
            let param1;  // rgba(21,24,45,1);
            let param2;  // rgba(0,52,94,1);
            const inversionOffset = 100; // метка первой смены цвета, привязана к блоку - не нужна
            const opacityOffset = 0; // метка отмены смены цвета, привязана к блоку - не нужна
            const classOffset = 150; // не нужна
            const windowInnerWidth = window.innerWidth;
            let formBlockTop = $('.card-application--form').offset().top;
            let fixLevel1 = formBlockTop - windowInnerWidth * .35; // уровень первого переключения
            let fixLevel2 = formBlockTop + $('.card-application--form').height() * .6 - opacityOffset; // уровень второго переключения
            let fixLevel3 = formBlockTop - inversionOffset + classOffset; // не нужен
            let fixLevel = (fixLevel1 - scrollTop) / opacityOffset; // диапазон смены прозрачности - не нужен
            //console.log('scrollTop=' + scrollTop);
            //console.log('formBlockTop=' + formBlockTop);
            //console.log('fixLevel1=' + fixLevel1);
            //console.log('fixLevel2=' + fixLevel2);
            //console.log('windowInnerWidth=' + windowInnerWidth);

            if(scrollTop > fixLevel2) {
                //console.log('scrollTop=' + scrollTop);
                /*if(fixLevel < 0) {
                    opacityLevel = 1;
                } else if(fixLevel >= 1) {
                    opacityLevel = 0;
                } else {
                    opacityLevel = 1 - fixLevel;
                }*/
                //$('.v21-card-application').css('background', 'linear-gradient(106.11deg, '+param1+' 27.82%, '+param2+' 100%)');
                $('.scheta-page__background-blue').css('opacity', '0');
                $('.v21 .v21-card-application').removeClass('js-color-switch');
                $('.v21 .v21-scheta-block4').removeClass('js-color-switch');
                $('.v21 .v21-block-interests').removeClass('js-color-switch');
            } else if(scrollTop > fixLevel1) {
                $('.scheta-page__background-blue').css('opacity', '1');
                $('.v21 .v21-card-application').addClass('js-color-switch');
                $('.v21 .v21-scheta-block4').addClass('js-color-switch');
                $('.v21 .v21-block-interests').addClass('js-color-switch');
            } else {
                //$('.v21-card-application').css('background', 'linear-gradient(106.11deg, '+param1+' 27.82%, '+param2+' 100%)');
                $('.scheta-page__background-blue').css('opacity', '0');
                $('.v21 .v21-card-application').removeClass('js-color-switch');
                $('.v21 .v21-scheta-block4').removeClass('js-color-switch');
                $('.v21 .v21-block-interests').removeClass('js-color-switch');
            }

            /*if(scrollTop > (fixLevel2+200)) {
                $('.scheta-page__background-blue').css('position', 'unset'); // для нижний блоков отработать стилем z-index
            } else if(scrollTop > (fixLevel1-200)) {
                $('.scheta-page__background-blue').css('position', 'fixed');
            } else {
                $('.scheta-page__background-blue').css('position', 'unset');
            }*/

            /*if(scrollTop > fixLevel3) {
                $('.v21-card-application').addClass('js-color-switch');
            } else {
                $('.v21-card-application').removeClass('js-color-switch');
            }*/
        }
        changeColors($(window).scrollTop());

        $(window).on('scroll',function(){
            let $window = $(window);
            let scrollTop = $window.scrollTop();
            //console.log('scrollTop='+scrollTop);

            changeColors(scrollTop);
        });

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
    /*function requiredContacts () {
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
    });*/


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


    /*$('.agreement input[required]').change(function () {
        if ( $(this).is(':checked') ) {
            $(this).closest('.agreement').css('box-shadow', '');
        } else {
            $(this).closest('.agreement').css('box-shadow', '0 0 2px 1px red');
        }
    });*/

    function requiredFields() {
        let arCheckFields = [
            'input[name="COMPANY_NAME"]',
            'input[name="COMPANY_INN"]',
            'input[name="FIO"]',
            'input[name="CITY"]',
            'input[name="CURRENCY"]',
            'input[name="TEL"]',
            'input[name="EMAIL"]',
            'input[name="FROM_WHERE"]',
        ];

        let countErr = 0;

        arCheckFields.forEach(function (value) {
            if ($(value).val() == '' || $(value).val() == NaN) {
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
        //if ($("#politics2").prop("checked")) {
            //$('#politics2').parent().parent().removeClass("is-error");
            //console.log('2');
            if (requiredFields()) {
                //console.log('3');
                $.ajax({
                    type: "POST",
                    //url: '/local/templates/v21_template_home/components/webtu/feedback/account_application/ajax.customer.php',
                    url: '/ajax_scripts/ajax.customer.php',
                    data: {
                        'fields': $(this).serialize(),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log('**');
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