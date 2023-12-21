<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <h4 class="popup-form_title page-title--4 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_3_HEADER")?>
    </h4>

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
    <input type="hidden" id="typeCard" name="TYPE_CARD" value="">

    <??><input type="hidden" id="PARAMS" name="PARAMS" value='<?= json_encode($arParams["PROPERTIES"]) ?>'><??>
    <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
    <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">

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

            <? if (!empty($arResult['SUCCESS'])) {
                LocalRedirect('/thanks/');
            } ?>
        <? } ?>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_ORGANIZATION")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="ORGANIZATION" class="input-field" required
                    <? if (isset($arResult['POST']['ORGANIZATION'])) { ?> value="<?=$arResult['POST']['ORGANIZATION']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="NAME" class="input-field" required
                    <? if (isset($arResult['POST']['NAME'])) { ?> value="<?=$arResult['POST']['NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input type="tel" name="PHONE" data-mask="phone" class="input-field" required="" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_3_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_3_EMAIL_LINE")?>
                </span>

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_3_CITY")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box">

                    <? CModule::IncludeModule('iblock'); ?>
                    <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y")); ?>

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
                    <?=GetMessage("WEBTU_FEEDBACK_3_TYPE")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box select-box-type">

                    <select name="TYPE">

                        <?
                        if(isset($arParams["CARD_OPTION"])) {
                            echo '<option value="'.$arParams["CARD_OPTION"].'">';
                            echo $arParams["CARD_OPTION"];
                            echo '</option>';
                        } else {
                        $iblockId = 24;
//if ( strstr($_SERVER["REQUEST_URI"], 'tamozhennye-karty') ) {
if ( strstr($_SERVER["REQUEST_URI"], 'tamozhennaya-karta-mir') ) {
                            $iblockId = 82;
                        }
                        $arSelect = Array("ID", "NAME", "PROPERTY_TYPE");
                        $arFilter = Array("IBLOCK_ID"=>$iblockId, "ACTIVE"=>"Y");
                        $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();
                            echo '<option value="'.$arFields['NAME'].'">';
                                echo $arFields['NAME'];
                            echo '</option>';
                        }
                        }
                        ?>

                    </select>

                </div>

            </div>

        </div>

		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_3_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_2"). "</a>";
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
            <?=GetMessage("WEBTU_FEEDBACK_3_BUTTON")?>
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
   });

</script>

<script>

    $('a[data-fancybox]').on('click', function () {
        $('.select-box-type li').each(function () {
            console.log($(this).text());
            $(this).removeClass('is-active');
            if ($(this).text() === $('#typeCard').val()) {
                $(this).addClass('is-active');
                $('.select-box-type .cs-box_selected').text($(this).text());
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