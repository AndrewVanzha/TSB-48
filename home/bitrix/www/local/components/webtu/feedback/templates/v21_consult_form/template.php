<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?// debugg($arResult); ?>
<?// debugg($arParams); ?>

<div class="ved-consult">
    <div class="ved-consult--img">
        <img class="ved-consult--img__266" src="images/airplane_226_226.png" alt="самолетик">
        <img class="ved-consult--img__277" src="images/airplane_277_277.png" alt="самолетик">
    </div>
    <?/*?><div class="ved-consult--text">
        <h2 class="ved-consult--text_title">
            <span>Консультации</span> по валютному законодательству
        </h2>
        <ul class="ved-consult--box"><span>Бесплатно проконсультируем по вопросам:</span>
            <li>валютного законодательства</li>
            <li>внешнеэкономической деятельности компании</li>
            <li>проведения сложных форм платежей согласно международной практике</li>
            <li>заполнения документов по валютному регулированию и контролю</li>
        </ul>
    </div><?*/?>

    <?/*?><div class="ved-consult--form"><?*/?>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" class="ved-consult--form" id="fValutnyKontrolConsultForm">

            <input type="hidden" name="FORM_ID" value="<?= $arResult['FORM_ID'] ?>">
            <input type="hidden" name="SESSION_ID" value="<?= bitrix_sessid() ?>">
            <input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'>
            <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
            <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle()?> ">
            <?//file_put_contents("/home/bitrix/www".'/currency/a_$_SERVER.json', json_encode($_SERVER));?>

            <div class="ved-consult--form__content">

                <?/* if (!empty($arResult['ERRORS'])) { ?>
                    <? foreach ($arResult['ERRORS'] as $error) { ?>
                        <div class="alert alert-danger">
                            <?=$error?>
                        </div>
                    <? } ?>
                <? } ?>

                <? if (!empty($arResult['SUCCESS'])) { ?>
                    <? foreach ($arResult['SUCCESS'] as $success) { ?>
                        <div class="alert alert-success">
                            <?=$success?>
                        </div>
                    <? } ?>
                <? } */?>

                <div class="ved-consult--form__section">
                    <div class="grid__item-1">
                        <label class="input-group">
                            <input type="text" name="NAME" placeholder="ФИО" class="input-group__field input_1"
                                <? if (isset($arResult['POST']['NAME'])) { ?> value="<?=$arResult['POST']['NAME']?>" <? } ?>
                            >
                            <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_2_NAME")?></span><?*/?>
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div>
                </div>

                <div class="ved-consult--form__section">
                    <div class="grid__item-1">
                        <label class="input-group">
                            <input type="tel" name="PHONE" placeholder="+7 (___) ___-__-__" data-inputmask="'mask': '+7 999 999 99 99'" class="input-group__field input_2"
                                <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                            >
                            <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_2_PHONE")?></span><?*/?>
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div>
                </div>

                <?
                $politics = GetMessage("WEBTU_FEEDBACK_2_POLITICS");
                $politics_1 = "<a href='/assets/docs/Правила оформления онлайн заявок.pdf' target='_blank' class='v21-link'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_2_POLITICS_1") . "</span></a>";
                $politics_2 = "<a href='/assets/docs/Согласие на обработку ПД для сайта.pdf' target='_blank' class='v21-link'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_2_POLITICS_2") . "</span></a>";
                $politics_output = sprintf($politics, $politics_1, $politics_2);
                ?>
                <div class="ved-consult--form__section ved-consult--form__captcha">
                    <div class="grid__item-1">
                        <div class="v21-checkbox">
                            <label class="v21-checkbox__content">
                                <input type="checkbox" checked name="" class="v21-checkbox__input" id="politics3">
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

                    <div class="grid__item-captcha">
                        <div class="grid__item-2">
                            <div class="captcha_image">
                                <input type="hidden" id="captchaSidVEDConsult" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                                <img id="captchaImgVEDConsult" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="капча">
                            </div>
                            <a id="reloadCaptchaConsult" title="Обновить капчу"></a>
                        </div>

                        <div class="grid__item-2">
                            <?/*?><div class="v21-input-group"><?*/?>
                            <label class="input-group">
                                <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="input-group__field input-captcha" id="CAPTCHA_WORD">
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_CAPTCHA")?></span><?*/?>
                                <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ved-consult--form__section">
                    <?/*?><div class="grid__item-1"><?*/?>
                        <button class="grid__item-button" name="WEBTU_FEEDBACK">
                            <?= GetMessage("WEBTU_FEEDBACK_2_BUTTON") ?>
                            <?/*?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M14.7307 1.51639C14.7307 0.964101 14.283 0.516386 13.7307 0.516386L4.73068 0.516387C4.1784 0.516386 3.73068 0.964102 3.73068 1.51639C3.73068 2.06867 4.1784 2.51639 4.73068 2.51639L12.7307 2.51639L12.7307 10.5164C12.7307 11.0687 13.1784 11.5164 13.7307 11.5164C14.283 11.5164 14.7307 11.0687 14.7307 10.5164L14.7307 1.51639ZM1.70711 14.9542L14.4378 2.22349L13.0236 0.80928L0.292893 13.54L1.70711 14.9542Z" fill="white"/>
                            </svg>
                            <?*/?>
                        </button>
                    <?/*?></div><?*/?>
                </div>

                <?/*?>
                <label class="ved-consult--form_input-group">
                    <span class="caption">
                        <span class="aligner">
                            <?=GetMessage("WEBTU_FEEDBACK_2_NAME")?>
                        </span>
                    </span>
                    <span class="content">
                        <input type="text" name="NAME" class="input-field" required
                            <? if (isset($arResult['POST']['NAME'])) { ?> value="<?=$arResult['POST']['NAME']?>" <? } ?>
                        >
                    </span>
                </label>

                <label class="ved-consult--form_input-group">
                    <span class="caption">
                        <span class="aligner">
                            <?=GetMessage("WEBTU_FEEDBACK_2_PHONE")?>
                        </span>
                    </span>
                    <span class="content">
                        <input type="tel" name="PHONE" data-mask="phone" class="input-field" required placeholder="+7 (___) ___-__-__"
                            <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                        >
                    </span>
                </label>
                <?*/?>

                <?/*?>
                <label class="ved-consult--form_agreement check-box">
                    <input type="checkbox" name="" checked required="">
                    <span class="check-box_caption"><?=$politics_output?></span>
                </label>
                <?*/?>

                <?/*?>
                <!--div class="v21-checkbox"-->
                    <label class="v21-checkbox__content ved-consult--form_agreement">
                        <input type="checkbox" checked name="" class="v21-checkbox__input">
                        <span class="check-box_captionn v21-checkbox__text"><?= $politics_output ?></span>
                        <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span><?// не работает?>
                    </label>
                <!--/div-->

                <div class="ved-consult--form_captcha">
                    <div class="captcha_image">
                        <input type="hidden" id="captchaSidVEDConsult2" name="CAPTCHA_ID" value="<?=$arResult['CAPTCHA']?>" />
                        <img id="captchaImgVEDConsult2" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" alt="">
                    </div>
                    <a id="reloadCaptchaConsult" title="Обновить капчу"></a>

                    <div class="captcha_input">
                        <input type="text" name="CAPTCHA_WORD" placeholder="<?=GetMessage('WEBTU_FEEDBACK_CAPTCHA')?>" class="input-field">
                        <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                    </div>
                </div>

                <button class="v21-ved-contracts__button v21-button ved-consult--form_button" name="WEBTU_FEEDBACK">
                    <?=GetMessage("WEBTU_FEEDBACK_2_BUTTON")?>
                </button>
                <?*/?>

                <?/* if (!empty($arResult['SUCCESS'])) {
                    LocalRedirect('/thanks/');
                } */?>

            </div>
        </form>

    <?/*?></div><?*/?>
</div>


<script type="text/javascript">
   $(document).ready(function(){
      $('#reloadCaptchaConsult').click(function(){
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImgVEDConsult').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captchaSidVEDConsult').val(data);
        });
        return false;
      });
   });
</script>

<script>
    $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');

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

    function requiredFields2() {
        let arFields = [
            '.input_1', //'input[name="NAME"]',
            '.input_2', //'input[name="PHONE"]',
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
        if($('#politics3').is(':checked')) {
            $('#politics3').parent().parent().removeClass("is-error");
        } else {
            countErr += 1;
            $('#politics3').parent().parent().addClass("is-error");
        }

        return (countErr > 0) ? false : true;
    }

    $('#fValutnyKontrolConsultForm').submit(function (e) {
        e.preventDefault();
        console.log('1');
        if ($("#politics3").prop("checked")) {
            $('#politics3').parent().parent().removeClass("is-error");
            //console.log('2');
            if (requiredFields2()) {
                //console.log('3');
                $.ajax({
                    type: "POST",
                    //url: '/local/components/webtu/feedback/templates/safes_fl/ajax.customer.php',
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
                            //console.log('not OK');
                            if (!data.captcha){
                                $('input[name="CAPTCHA_WORD"]').parent().addClass("is-error");
                            } else {
                                $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                            }
                        }
                    }
                });
            }
        } else {
            $('#politics3').parent().parent().addClass("is-error");
        }
    });

    /*$('.input-group input[required]').change(function () {
        if ( $(this).is(':checked') ) {
            $(this).closest('.input-group').css('box-shadow', '');
        } else {
            $(this).closest('.input-group').css('box-shadow', '0 0 2px 1px red');
        }
    });*/
</script>