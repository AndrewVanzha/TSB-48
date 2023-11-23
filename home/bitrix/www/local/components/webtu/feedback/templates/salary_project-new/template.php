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

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
    <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
    <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">

	<div class="zp-form__row">
		<input required type="text" name="NAME" class="zp-form__input" placeholder="<?=GetMessage("WEBTU_FEEDBACK_9_NAME")?>">
	</div>
	
	<div class="zp-form__row">
		<input required type="tel" name="PHONE" class="zp-form__input" data-mask="phone" placeholder="+7 (___) ___-__-__">
	</div>
	
	<div class="zp-form__row">
		<input type="email" name="EMAIL" class="zp-form__input" placeholder="example@site.ru">
	</div>

    <div class="zp-form__row">
        <input required type="text" name="FROM_WHERE" class="zp-form__input" placeholder="Откуда Вы узнали о нас">
    </div>

	<? 
		$politics = GetMessage("WEBTU_FEEDBACK_9_POLITICS");
		$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_9_POLITICS_1"). "</a>";
		$politics_2 = "<a href='/assets/docs/Согласие_на обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_9_POLITICS_2"). "</a>";
		$politics_output = sprintf($politics, $politics_1, $politics_2);
	?>

	<div class="zp-form__row policy">
		<input type="checkbox" id="zp-policy" required>
		<label for="zp-policy" class="zp-form__policy"><?=$politics_output?></label>
	</div>
	
	<div class="zp-form__row captcha clearfix">

            <div class="captcha_image">
                <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?=$arResult['CAPTCHA']?>" />
                <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" alt="">
            </div>

            <a id="reloadCaptcha" title="Обновить капчу"></a>

            <div class="captcha_input">
                <input type="text" name="CAPTCHA_WORD" placeholder="<?=GetMessage('WEBTU_FEEDBACK_CAPTCHA')?>" class="input-field">
            </div>

        </div>

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
	
	<div class="zp-form__row">
		<button class="zp-form__button" name="WEBTU_FEEDBACK"><?=GetMessage("WEBTU_FEEDBACK_9_BUTTON")?></button>
	</div>

</form>

<script type="text/javascript">

   $(document).ready(function(){
       // https://osipenkov.ru/tracking-fileds-yandex-metrika-gtm/
       // https://blog.targeting.school/kakie-byvayut-tseli-v-ya-metrike-i-kak-rabotaet-novaya-tsel-otpravka-formy/
       // https://www.yandex.ru/video/preview/17446571467160561628
       function yandexMetrikaForm() {
           //yaCounter49389685
           //yaCounter315345643.reachGoal('applicationForm'); // ошика
           //ym(315345643, 'reachGoal', 'applicationForm');

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
           //ym(316212751, 'reachGoal', 'depositOrder', formFields);

           return true;
       }

       $('#reloadCaptcha').click(function(){
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImg').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captchaSid').val(data);
        });
        return false;
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

       let pos = 1;
       $('.zp-form__wrapper .zp-form__button').click(function () {
           let entry = {
               'PRODUCT_ID': 0,
               'NAME': 'form',
               'PRICE': 1,
               'DETAIL_PAGE_URL': '<?= $_SERVER['REQUEST_URI'] ?>',
               'QUANTITY': 1,
               'XML_ID': 'xml'
           };
           let ar_product = [];
           let postTemplateID = <?= $postTemplateID; ?>;
           if(postTemplateID) {
               entry.PRODUCT_ID = postTemplateID; // ID почтового шаблона
           }
           ar_product.push(
               {
                   "id": entry.PRODUCT_ID,
                   "name": entry.NAME,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": 1,
                   "xml": entry.XML_ID,
               },
           );
           makeDataLayer(pos++, ar_product);
           console.log(window.dataLayer);
           //yandexMetrikaForm();

           $(".alert").remove();
       });
   });

</script>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');
    </script>
<? } ?>
