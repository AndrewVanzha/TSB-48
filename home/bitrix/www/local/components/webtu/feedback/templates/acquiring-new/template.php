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
    <input type="hidden" name="REQ_URI" value="<?= $_SERVER['SCRIPT_URL'] ?>">
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

       function makeDataLayer(id, ar_product) {
           window.dataLayer.push({
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

       function makeArProduct(data) {
           let pos = 0;
           let ar_product = [];
           let entry = {
               'PRODUCT_ID': '<?= $_SERVER['SCRIPT_URL'] ?>',
               'NAME': '<?= $_SERVER['SCRIPT_URL'] ?>',
               'PRICE': 1,
               'DETAIL_PAGE_URL': '<?= $_SERVER['REQUEST_URI'] ?>',
               'QUANTITY': 1,
               'XML_ID': 'xml'
           };

           ar_product.push(
               {
                   "id": 'REGION',
                   "name": data.REGION,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
           ar_product.push(
               {
                   "id": 'FROM_WHERE',
                   "name": data.FROM_WHERE,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
           ar_product.push(
               {
                   "id": 'REQ_URI',
                   "name": data.REQ_URI,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
           ar_product.push(
               {
                   "id": 'UTM_CAMPAIGN',
                   "name": data.UTM_CAMPAIGN,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
           ar_product.push(
               {
                   "id": 'UTM_CONTENT',
                   "name": data.UTM_CONTENT,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
           ar_product.push(
               {
                   "id": 'UTM_MEDIUM',
                   "name": data.UTM_MEDIUM,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
           ar_product.push(
               {
                   "id": 'UTM_SOURCE',
                   "name": data.UTM_SOURCE,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
           ar_product.push(
               {
                   "id": 'UTM_TERM',
                   "name": data.UTM_TERM,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );

           return ar_product;
       }

       function checkCommerce() {
           let ar_product = [];
           let result_data = <?= CUtil::PHPToJSObject($arResult); ?>; // данные для электронной коммерции
           //console.log(result_data);
           if (result_data['COMMERCE']) {
               //console.log(result_data['COMMERCE']);
               let commerce = result_data['COMMERCE'];
               if (commerce.type && result_data['ERRORS'].length == 0) {
                   //console.log(commerce.data);
                   console.log(commerce.data.APPLICATION_ID);
                   ar_product = makeArProduct(commerce.data);
                   makeDataLayer(commerce.data.APPLICATION_ID, ar_product);
                   //console.log(window.dataLayer);
               }
               else {
                   console.log('В массиве $POST нет коммерции');
               }
           }
       }

       checkCommerce();

       $('.eq-form__wrapper .eq-form__button').click(function () {
           $(".alert").remove();
       });
   });

</script>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');
    </script>
<? } ?>
