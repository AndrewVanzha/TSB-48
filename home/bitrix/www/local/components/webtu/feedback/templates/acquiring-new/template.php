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

    <div class="eq-form__row">
        <input required type="text" name="NAME" class="eq-form__input" placeholder="<?=GetMessage("WEBTU_FEEDBACK_9_NAME")?>"
            <? if (isset($arResult['POST']['NAME'])) { ?> value="<?=$arResult['POST']['NAME']?>" <? } ?>
        >
    </div>

    <div class="eq-form__row">
        <input required type="tel" name="PHONE" class="eq-form__input" data-mask="phone" placeholder="+7 (___) ___-__-__"
            <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
        >
    </div>

    <div class="eq-form__row">
        <input required type="text" name="COMPANY_INN" class="eq-form__input" placeholder="<?=GetMessage("WEBTU_FEEDBACK_9_COMPANY_INN")?>"
            <? if (isset($arResult['POST']['COMPANY_INN'])) { ?> value="<?=$arResult['POST']['COMPANY_INN']?>" <? } ?>
        >
    </div>

    <div class="eq-form__row">
        <input type="email" name="EMAIL" class="eq-form__input" placeholder="example@site.ru"
            <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
        >
    </div>

    <div class="eq-form__row">
        <input required type="text" name="REGION" class="eq-form__input" placeholder="<?=GetMessage("WEBTU_FEEDBACK_9_REGION")?>"
            <? if (isset($arResult['POST']['REGION'])) { ?> value="<?=$arResult['POST']['REGION']?>" <? } ?>
        >
    </div>

    <div class="eq-form__row">
        <input required type="text" name="FROM_WHERE" class="eq-form__input" placeholder="Откуда Вы узнали о нас"
            <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
        >
    </div>

	<? 
		$politics = GetMessage("WEBTU_FEEDBACK_9_POLITICS");
		$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_9_POLITICS_1"). "</a>";
		$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_9_POLITICS_2"). "</a>";
		$politics_output = sprintf($politics, $politics_1, $politics_2);
	?>

	<div class="eq-form__row policy">
		<input type="checkbox" id="eq-policy-online" required>
		<label for="eq-policy-online"><?=$politics_output?></label>
	</div>
	
	<div class="eq-form__row captcha clearfix">

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
	
	<div class="eq-form__row">
		<button class="eq-form__button" name="WEBTU_FEEDBACK"><?=GetMessage("WEBTU_FEEDBACK_9_BUTTON")?></button>
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

       $('.eq-form__wrapper .eq-form__button').click(function () {
           $(".alert").remove();
       });

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
   });

</script>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');
    </script>
<? } ?>
