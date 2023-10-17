<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<style>
	.popup-form__or-link {display:flex;justify-content:space-between;margin-top:20px}
	.popup-form__dop-polya {display:none;margin-top:25px}
</style>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <h4 class="popup-form_title page-title--7 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_7_1_HEADER")?>
    </h4>

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">

    <div class="popup-form_content">

        <? if (!empty($arResult['ERRORS'])) { ?>
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
        <? } ?>

        <div class="popup-form_input-group clearfix popup-form_input-city">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_CITY")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box">

                    <? CModule::IncludeModule('iblock'); ?>
                    <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114)); ?>

                    <select name="CITY">

                        <? while ($city = $cities->Fetch()) {
                            if ($city['NAME'] != 'Санкт-Петербург') { // Санкт-Петербург - счета не открывают ?>
                        <option value="<?=$city['NAME']?>"
                            <? if (!empty($_SESSION['city']) && $_SESSION['city'] == $city['ID']) { ?>selected<? } ?>
                            <? if (!isset($arResult['POST']['CITY']) && $city['NAME'] == 'Москва') { ?>selected<? } ?>
                        >
                            <?=$city['NAME']?>
                        </option>
                        <? } } ?>

                    </select>
                </div>

            </div>

        </div>

		<div class="popup-form__or-link">
			<a href="javascript:" class="popup-form__or-link_consult"><?=GetMessage("WEBTU_FEEDBACK_7_LINK_CONSULT")?></a>
			<a href="https://rezervscheta.transstroybank.ru/sa/reg" target="_blank"><?=GetMessage("WEBTU_FEEDBACK_7_LINK_ASSIST")?></a>
		</div>

		<div class="popup-form__dop-polya">

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_NAME_COMPANY")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="NAME_COMPANY" class="input-field" required=""
                    <? if (isset($arResult['POST']['NAME_COMPANY'])) { ?> value="<?=$arResult['POST']['NAME_COMPANY']?>" <? } ?>
                >

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_LEGAL_FORM")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box">

                    <select name="LEGAL_FORM" required="">
                        
                        <option value="<?=GetMessage("WEBTU_FEEDBACK_7_LEGAL_FORM_INDIVIDUAL")?>">
                            <?=GetMessage("WEBTU_FEEDBACK_7_LEGAL_FORM_INDIVIDUAL")?>
                        </option>

                        <option value="<?=GetMessage("WEBTU_FEEDBACK_7_LEGAL_FORM_RESIDENT")?>">
                            <?=GetMessage("WEBTU_FEEDBACK_7_LEGAL_FORM_RESIDENT")?>
                        </option>

                        <option value="<?=GetMessage("WEBTU_FEEDBACK_7_LEGAL_FORM_NON_RESIDENT")?>">
                            <?=GetMessage("WEBTU_FEEDBACK_7_LEGAL_FORM_NON_RESIDENT")?>
                        </option>

                    </select>

                </div>

            </div>

        </div>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_INN")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="INN" class="input-field" required=""
                    <? if (isset($arResult['POST']['INN'])) { ?> value="<?=$arResult['POST']['INN']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">
        
            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_ADDRESS")?>
                </span>
            </span>
        
            <span class="content">
        
                <input type="text" name="ADDRESS" class="input-field" required=""
                    <? if (isset($arResult['POST']['ADDRESS'])) { ?> value="<?=$arResult['POST']['ADDRESS']?>" <? } ?>
                >
        
            </span>
        
        </label>


        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="FIRST_NAME" class="input-field" required=""
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                >

            </span>

        </label>


        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input type="tel" name="PHONE" data-mask="phone" class="input-field" required="" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_7_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_7_EMAIL_LINE")?>
                </span>

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_7_ONLINE_BANK")?>
                </span>
            </div>

            <div class="content">

                <div class="switch-box clearfix" id="feedbackFormInputType">

                    <label class="switch-box_caption">

                        <input type="radio" name="ONLINE_BANK" value="Да"
                            <? if (!isset($arResult['POST']['ONLINE_BANK'])) { ?> checked <? } ?>
                            <? if (isset($arResult['POST']['ONLINE_BANK'])) { ?>
                                <? if ($arResult['POST']['ONLINE_BANK'] == 'Да') { ?> checked <? } ?>
                            <? } ?>
                        >

                        <span>
                            <?=GetMessage("WEBTU_FEEDBACK_7_ONLINE_BANK_YES")?>
                        </span>

                    </label>

                    <span class="switch-box_lever"></span>

                    <label class="switch-box_caption">

                        <input type="radio" name="ONLINE_BANK" value="Нет"
                            <? if (isset($arResult['POST']['ONLINE_BANK'])) { ?>
                                <? if ($arResult['POST']['ONLINE_BANK'] == 'Нет') { ?> checked <? } ?>
                            <? } ?>
                        >

                        <span>
                            <?=GetMessage("WEBTU_FEEDBACK_7_ONLINE_BANK_NO")?>
                        </span>

                    </label>

                </div>

            </div>

        </div>

        <div class="type-2">

            <div>
                <?=GetMessage("WEBTU_FEEDBACK_7_CURRENCY")?>
            </div>

            <ul class="list">

                <? CModule::IncludeModule('iblock'); ?>
                <? $arCurrency = CIBlockElement::GetProperty(29, 153, Array("sort"=>"asc"), Array("CODE"=>"ATT_CURRENCY")); ?>

                <? while ($currency = $arCurrency->Fetch()) {?>
                    <li>
                        <label class="check-box">
                            <input value="<?=$currency['VALUE']?>" type="checkbox" name="CURRENCY[]">

                            <span class="check-box_caption">
                                <?=$currency['VALUE']?>
                            </span>
                        </label>
                    </li>
                <?}?>


            </ul>

        </div>

        <div class="type-2">
        
            <div>
                <?=GetMessage("WEBTU_FEEDBACK_7_TYPE")?>
            </div>
        
            <ul class="list">
        
                <? CModule::IncludeModule('iblock'); ?>
                <? $arType = CIBlockElement::GetProperty(29, 153, Array("sort"=>"asc"), Array("CODE"=>"ATT_TYPE")); ?>
        
        
                <? while ($type = $arType->Fetch()) {?>
        
                    <li>
                        <label class="check-box">
                            <input value="<?=$type['VALUE']?>" type="checkbox" name="TYPE[]">
                            <span class="check-box_caption">
                                <?=$type['VALUE']?>
                            </span>
                        </label>
                    </li>
                <?}?>
        
        
            </ul>
        
        </div>


		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_7_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_7_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_7_POLITICS_2"). "</a>";
			$politics_output = sprintf($politics, $politics_1, $politics_2);
		?>
		
		<label class="agreement check-box">
			<input type="checkbox" name="POLITICS" checked required="">
			<span class="check-box_caption"><?=$politics_output?></span>
		</label>

        <div class="captcha clearfix">

            <div class="captcha_image">
                <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?=$arResult['CAPTCHA']?>" />
                <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" alt="">
            </div>

            <a id="reloadCaptcha" title="Обновить капчу"></a>

            <div class="captcha_input">
                <input type="text" name="CAPTCHA_WORD" placeholder="<?=GetMessage('WEBTU_FEEDBACK_CAPTCHA')?>" class="input-field">
            </div>

        </div>

        <button class="button" name="WEBTU_FEEDBACK">
            <?=GetMessage("WEBTU_FEEDBACK_7_BUTTON")?>
        </button>

		</div>

    </div>

</form>

<script type="text/javascript">

   $(document).ready(function(){
      $('#reloadCaptcha').click(function(){
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImg').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captchaSid').val(data);
        });
        return false;
      });
   });

</script>

<script>

	$(document).ready(function(){
		checkStatusDop();

		$('.popup-form__or-link_consult').click(function(){
			$('.popup-form__dop-polya').show();
		});

		$('.select-box select[name="CITY"]').change(function(){
			checkStatusDop();
		});

		$('.popup-form_content').on('click', function(){
			setTimeout(function(){
				if($('.popup-form_input-city .cs-box_selected').hasClass('is-opened')){
					$('.popup-form_content').css({'minHeight':'230px'});
				} else {
					$('.popup-form_content').css({'minHeight':'0'});
				}
			}, 100);
		});
	});

	function checkStatusDop(){
		let city = $('.select-box select[name="CITY"]').val();
		if(city === 'Москва'){
			$('.popup-form__or-link').show();
			$('.popup-form__dop-polya').hide();
		} else {
			$('.popup-form__or-link').hide();
			$('.popup-form__dop-polya').show();
		}
	}

    $('.button[data-fancybox=""]').on('click', function () {
        var creditName = $('#CREDIT_NAME').val();
        $('.select-box-type li').each(function () {
            if ($(this).text() == creditName) {
                $(this).addClass('is-active');
                $('.select-box-type .cs-box_selected').text(creditName);
            } else {
                $(this).removeClass('is-active');
            }
        });
    });



    function requiredContacts () {
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
    });



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

    function toggleFeedbackFormInputType() {

        if ( $('.page-bottom .switch-box_lever').hasClass('is-active-left') ){
            $('#feedbackFormInputPhone').removeClass('hidden');
            $('#feedbackFormInputPhone').prop('required',true);
            $('#feedbackFormInputEmail').addClass('hidden');
            $('#feedbackFormInputEmail').prop('required',false);
        } else {
            $('#feedbackFormInputPhone').addClass('hidden');
            $('#feedbackFormInputPhone').prop('required',false);
            $('#feedbackFormInputEmail').removeClass('hidden');
            $('#feedbackFormInputEmail').prop('required',true);
        }
    }

    toggleFeedbackFormInputType();

    $('.feedback_form .switch-box input[type="radio"]').change( function() {

        toggleFeedbackFormInputType();

    } );



    function clearFields () {
        $('textarea').val('').css('box-shadow', 'none');
        $('input[type="text"]').val('').css('box-shadow', 'none');
        $('input[type="number"]').val('').css('box-shadow', 'none');
        $('input[type="tel"]').val('').css('box-shadow', 'none');
        $('input[type="email"]').val('').css('box-shadow', 'none');
        $('input[type="radio"]').val('').css('box-shadow', 'none');

        $('textarea').focusout(function () {   
            $(this).css('box-shadow', '');
        });
        $('input').focusout(function () {
            $(this).css('box-shadow', '');
        });
    }

    if ($('.alert-success').length > 0) {
        clearFields ();
    }

    $('.feedback_form .button').click(function () {
        $(".alert").remove();
    });



    $('.agreement input[required]').change(function () {
        if ( $(this).is(':checked') ) {
            $(this).closest('.agreement').css('box-shadow', '');
        } else {
            $(this).closest('.agreement').css('box-shadow', '0 0 2px 1px red');
        }
    });

</script>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');

        $('.select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>