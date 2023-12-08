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

    <h4 class="popup-form_title page-title--4 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_2_HEADER")?>
    </h4>

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
    <input type="hidden" name="FOLDER" value="<?=$APPLICATION->GetTitle()?>">
    <input type="hidden" name="REQ_URI" value="<?= $_SERVER['SCRIPT_URL'] ?>">

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
                    <?=GetMessage("WEBTU_FEEDBACK_2_NAME")?>
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
                    <?=GetMessage("WEBTU_FEEDBACK_2_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input type="tel" name="PHONE" data-mask="phone" class="input-field" required placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_2_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_2_TIME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="TIME" class="input-field"
                    <? if (isset($arResult['POST']['TIME'])) { ?> value="<?=$arResult['POST']['TIME']?>" <? } ?>
                >

            </span>

        </label>
		
		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_2_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_2_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_2_POLITICS_2"). "</a>";
			$politics_output = sprintf($politics, $politics_1, $politics_2);
		?>
		
		<label class="agreement check-box">
			<input type="checkbox" name="POLITICS" required>
			<span class="check-box_caption"><?=$politics_output?></span>
		</label>

        <div class="captcha clearfix">

            <div class="captcha_image">
                <input type="hidden" id="captchaSidCallback" name="CAPTCHA_ID" value="<?=$arResult['CAPTCHA']?>" />
                <img id="captchaImgCallback" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" alt="">
            </div>

            <a id="reloadCaptchaCallback" title="Обновить капчу"></a>

            <div class="captcha_input">
                <input type="text" name="CAPTCHA_WORD" placeholder="<?=GetMessage('WEBTU_FEEDBACK_CAPTCHA')?>" class="input-field">
            </div>

        </div>

        <button class="button" name="WEBTU_FEEDBACK">
            <?=GetMessage("WEBTU_FEEDBACK_2_BUTTON")?>
        </button>

    </div>

</form>

<script type="text/javascript">
   $(document).ready(function(){
      $('#reloadCaptchaCallback').click(function(){
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImgCallback').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captchaSidCallback').val(data);
        });
        return false;
      });

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
                   "id": 'TIME',
                   "name": data.TIME,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
           /*ar_product.push(
               {
                   "id": 'FROM_WHERE',
                   "name": data.FROM_WHERE,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );*/
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
   });
</script>
