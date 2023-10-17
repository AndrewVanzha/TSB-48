<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <h4 class="popup-form_title page-title--4 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_4_HEADER")?>
    </h4>

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
    <input type="hidden" id="CARD_TYPE" name="CARD_TYPE" value="">
    <input type="hidden" id="CARD_NAME" name="CARD_NAME" value="">

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

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_LAST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input required type="text" name="LAST_NAME" class="input-field"
                    <? if (isset($arResult['POST']['LAST_NAME'])) { ?> value="<?=$arResult['POST']['LAST_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input required type="text" name="FIRST_NAME" class="input-field"
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_SECOND_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="SECOND_NAME" class="input-field"
                    <? if (isset($arResult['POST']['SECOND_NAME'])) { ?> value="<?=$arResult['POST']['SECOND_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_SEX")?>
                </span>
            </div>

            <div class="content">

                <div class="switch-box clearfix" id="feedbackFormInputType">

                    <label class="switch-box_caption">

                        <input type="radio" name="SEX" value="Мужской"
                            <? if (!isset($arResult['POST']['SEX'])) { ?> checked <? } ?>
                            <? if (isset($arResult['POST']['SEX'])) { ?>
                                <? if ($arResult['POST']['SEX'] == 'Мужской') { ?> checked <? } ?>
                            <? } ?>
                        >

                        <span>
                            <?=GetMessage("WEBTU_FEEDBACK_4_SEX_MALE")?>
                        </span>

                    </label>

                    <span class="switch-box_lever"></span>

                    <label class="switch-box_caption">

                        <input type="radio" name="SEX" value="Женский"
                            <? if (isset($arResult['POST']['SEX'])) { ?>
                                <? if ($arResult['POST']['SEX'] == 'Женский') { ?> checked <? } ?>
                            <? } ?>
                        >

                        <span>
                            <?=GetMessage("WEBTU_FEEDBACK_4_SEX_FEMALE")?>
                        </span>

                    </label>

                </div>

            </div>

        </div>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_BIRTHDATE")?>
                </span>
            </span>

            <span class="content">

                <input required type="text" name="BIRTHDATE" data-mask="date" class="input-field" required placeholder="дд.мм.гггг"
                    <? if (isset($arResult['POST']['BIRTHDATE'])) { ?> value="<?=$arResult['POST']['BIRTHDATE']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input required type="tel" name="PHONE" data-mask="phone" class="input-field" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_4_EMAIL_LINE")?>
                </span>

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_CITY")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box">

                    <? CModule::IncludeModule('iblock'); ?>
                    <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114)); ?>

                    <select name="CITY">

                        <? while ($city = $cities->Fetch()) { ?>
                        <option value="<?=$city['NAME']?>"
                            <? if ($arResult['POST']['CITY'] == $city['NAME']) { ?>selected<? } ?>
                            <? if (!isset($arResult['POST']['CITY']) && $city['NAME'] == 'Москва') { ?>selected<? } ?>
                        >
                            <?=$city['NAME']?>
                        </option>
                        <? } ?>

                    </select>
                </div>

            </div>

        </div>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_TYPE")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box select-box-type">

                    <select name="TYPE">
						<option value=""><?=GetMessage("WEBTU_FEEDBACK_4_TYPE")?></option>

                        <?
                        /*$arSelect = Array("ID", "NAME", "PROPERTY_TYPE");
                        $arFilter = Array("IBLOCK_ID"=>21, "ACTIVE"=>"Y");
                        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();
                            echo '<option value="'.$arFields['NAME'].'">';
                                $type = explode(' ', $arFields['PROPERTY_TYPE_VALUE']);
                                echo $arFields['NAME']." (".$type[0].")";
                            echo '</option>';
                        }*/

                        $array_card = array(
							'Visa Gold', 
							'Visa Platinum', 
							'Visa Gold Moment Card', 
							'МИР Классическая', 
							'МИР Социальная'
						);

                        foreach ($array_card as $item_card){
                            echo '<option value="'.$item_card.'">';
                            echo $item_card;
                            echo '</option>';
                        }
                        ?>

                    </select>

                </div>

            </div>

        </div>

        <label class="popup-form_input-group double-offset clearfix translit_name_family">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_TRANSLIT")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="TRANSLIT" class="input-field" placeholder="IVAN IVANOV"
                    <? if (isset($arResult['POST']['TRANSLIT'])) { ?> value="<?=$arResult['POST']['TRANSLIT']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_4_TRANSLIT_DESC")?>
                </span>

            </span>

        </label>

        <label class="agreement check-box check-box-delivery">

            <input type="checkbox" name="DELIVERYCARD">

            <span class="check-box_caption">
                <?=GetMessage("WEBTU_FEEDBACK_4_DELIVERYCARD")?>
            </span>

        </label>

        <div class="popup-form_delivery">
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_TYPE_PASS")?>
                </span>
                </div>

                <div class="content">
                    <div class="select-box select-box-type-pass">
                        <select name="TYPE_PASS">
                            <option value="<?=GetMessage("WEBTU_FEEDBACK_4_PASS_RF")?>">
                                <?=GetMessage("WEBTU_FEEDBACK_4_PASS_RF")?>
                            </option>
                            <option value="<?=GetMessage("WEBTU_FEEDBACK_4_PASS_INOY")?>">
                                <?=GetMessage("WEBTU_FEEDBACK_4_PASS_INOY")?>
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="popup-form_input-group clearfix popup-form_pass_inoy">
                <div class="caption">
                </div>

                <div class="content">
                    <input type="text" name="TYPE_INOY" class="input-field" placeholder="<?=GetMessage("WEBTU_FEEDBACK_4_INOY_PLACE")?>">
                </div>
            </div>
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PASS_SERIYA")?>
                </span>
                </div>

                <div class="content">
                    <input type="text" name="PASS_SERIYA" class="input-field" placeholder="00 00">
                </div>
            </div>
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PASS_NUMBER")?>
                </span>
                </div>

                <div class="content">
                    <input type="text" name="PASS_NUMBER" class="input-field" placeholder="000000">
                </div>
            </div>
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PASS_KEM")?>
                </span>
                </div>

                <div class="content">
                    <input type="text" name="PASS_KEM" class="input-field">
                </div>
            </div>
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PASS_DATA")?>
                </span>
                </div>

                <div class="content">
                    <input type="text" name="PASS_DATA" data-mask="date" class="input-field" placeholder="дд.мм.гггг">
                </div>
            </div>
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PASS_COD")?>
                </span>
                </div>

                <div class="content">
                    <input type="text" name="PASS_COD" class="input-field" placeholder="000-000">
                </div>
            </div>
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PASS_MESTO")?>
                </span>
                </div>

                <div class="content">
                    <input type="text" name="PASS_MESTO" class="input-field">
                </div>
            </div>
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PASS_ADDR_R")?>
                </span>
                </div>

                <div class="content">
                    <input type="text" name="PASS_ADDR_R" class="input-field">
                </div>
            </div>
            <div class="popup-form_input-group clearfix">
                <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_4_PASS_ADDR_F")?>
                </span>
                </div>

                <div class="content">
                    <input type="text" name="PASS_ADDR_F" class="input-field">

                    <span class="note">
                    <label class="agreement check-box">
                        <input type="checkbox" name="PASS_ADDR_S">
                        <span class="check-box_caption">
                            <?=GetMessage("WEBTU_FEEDBACK_4_PASS_ADDR_S")?>
                        </span>
                    </label>
                    </span>
                </div>
            </div>
        </div>

        <label class="agreement check-box">

            <input type="checkbox" name="CITYZENSHIP" checked>

            <span class="check-box_caption">
                <?=GetMessage("WEBTU_FEEDBACK_4_CITIZENSHIP")?>
            </span>

        </label>

		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_4_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_4_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_4_POLITICS_2"). "</a>";
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
            <?=GetMessage("WEBTU_FEEDBACK_4_BUTTON")?>
        </button>

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

      // Доставка карты
      $('.check-box-delivery, .popup-form_delivery, .popup-form_pass_inoy, .translit_name_family').hide();
      checkDeliveryCard();

       $('.select-box select[name="CITY"], .select-box select[name="TYPE"]').on('change', function(){
           checkDeliveryCard();
       });

       $('.check-box-delivery input[type="checkbox"]').on('change', function(){
           if($(this).prop('checked')){
               $('.popup-form_delivery').show();
           } else {
               $('.popup-form_delivery').hide();
               $('.popup-form_delivery input').each(function(){
                   if($(this).attr('type') === 'checkbox'){
                       $(this).prop('checked', false);
                   } else {
                       $(this).val('');
                   }
               });
           }
       });

       $('.check-box input[name="PASS_ADDR_S"]').on('change', function(){
           if($(this).prop('checked')){
               $('.input-field[name="PASS_ADDR_F"]').prop('disabled', true);
           } else {
               $('.input-field[name="PASS_ADDR_F"]').prop('disabled', false);
           }
       });

       $('.select-box-type-pass select[name="TYPE_PASS"]').on('change', function(){
           if($(this).val() === 'Иной документ'){
               $('.popup-form_pass_inoy').show();
           } else {
               $('.popup-form_pass_inoy').hide();
               $('.popup-form_pass_inoy input[name="TYPE_INOY"]').val('');
           }
       });
   });

   function checkDeliveryCard() {
        let city = $('.select-box select[name="CITY"]').val();
        let typeCard = $('.select-box select[name="TYPE"]').val();

        if(city === 'Москва' && typeCard !== ''){
            $('.check-box-delivery').show();
            $('.check-box-delivery input[type="checkbox"]').prop("disabled", false).prop("checked", false);
        } else {
            $('.check-box-delivery').hide();
            $('.check-box-delivery input[type="checkbox"]').prop("disabled", true).prop("checked", false);
        }

	    if(typeCard === 'Visa Gold' || typeCard === 'Visa Platinum'){
            $('.translit_name_family').show();
        } else {
            $('.translit_name_family').hide();
            $('.translit_name_family input[name="TRANSLIT"]').val('');
        }

        $('.check-box-delivery input[type="checkbox"]').change();
   }

</script>

<script>

    $('.button[data-fancybox=""]').on('click', function () {

        if ($(this).closest('.product-item').length > 0) {
            cardType = $(this).closest('.product-item').attr('data-type');
            cardName = $(this).closest('.product-item').find('.page-title').text().trim();
        } else {
            cardType = $('#CARD_TYPE').val();
            cardName = $('#CARD_NAME').val();
        }

        filterCards ();

    });

    function filterCards () {
        $('.select-box-type li').each(function () {
            $(this).removeClass('is-active');
            let currentCardName = cardName.split(' ');
            currentCardName = currentCardName[0] + ' ' + currentCardName[1];
            if ($(this).text() === currentCardName) {
                $(this).addClass('is-active');
                $('.select-box-type .cs-box_selected').text($(this).text());
            }
        });
    }

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
