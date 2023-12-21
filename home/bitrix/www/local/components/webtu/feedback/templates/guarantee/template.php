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
        <?=GetMessage("WEBTU_FEEDBACK_12_HEADER")?>
    </h4>

    <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
    <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
    <input type="hidden" name="REQ_URI" value="<?= $_SERVER['SCRIPT_URL'] ?>">
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
        <? } ?>


        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_COMPANY_NAME")?>
                </span>
            </span>

            <span class="content">

                <input required type="text" name="COMPANY_NAME" class="input-field"
                    <? if (isset($arResult['POST']['COMPANY_NAME'])) { ?> value="<?=$arResult['POST']['COMPANY_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input required type="text" name="FIRST_NAME" class="input-field"
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                >

            </span>

        </label>



        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input required type="tel" name="PHONE" data-mask="phone" class="input-field" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_12_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_12_EMAIL_LINE")?>
                </span>

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_CITY")?>
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


        <div class="popup-form_input-group clearfix" style="margin-bottom: 30px;">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_SUM")?>
                </span>
            </div>

            <div class="content">

                <div class="currency clearfix">

                    <input required type="number" name="SUM" class="input-field"
                        <? if (isset($arResult['POST']['SUM'])) { ?> value="<?=$arResult['POST']['SUM']?>" <? } else { ?> value="" <? } ?>
                    >

                    <div class="select-box">

                        <select name="CURRENCY">

                            <option value="RUB"
                                <? if ($arResult['POST']['CURRENCY'] == "RUB") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_12_CURRENCY_RUB")?>
                            </option>

                            <option value="EUR"
                                <? if ($arResult['POST']['CARD_CURRENCY'] == "EUR") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_12_CURRENCY_EUR")?>
                            </option>

                            <option value="USD"
                                <? if ($arResult['POST']['CARD_CURRENCY'] == "USD") { ?>selected<? } ?>
                            >
                                <?=GetMessage("WEBTU_FEEDBACK_12_CURRENCY_USD")?>
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_DATE")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="DATE" class="input-field" required=""
                    <? if (isset($arResult['POST']['DATE'])) { ?> value="<?=$arResult['POST']['DATE']?>" <? } ?>
                >

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_PROVISION")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box">

                    <select name="PROVISION">

                        <? CModule::IncludeModule('iblock'); ?>
                        <? $arProvision = CIBlockElement::GetProperty(37, 172, Array("sort"=>"asc"), Array("CODE"=>"ATT_PROVISION")); ?>


                        <? while ($provision = $arProvision->Fetch()) {?>

                            <option value="<?=$provision['VALUE']?>"
                                <? if ($arResult['POST']['PROVISION'] == $provision['VALUE']) { ?>selected<? } ?>
                                <? if (!isset($arResult['POST']['PROVISION']) && $provision['VALUE'] == 'Недвижимость') { ?>selected<? } ?>
                            >
                                <?=$provision['VALUE']?>
                            </option>


                        <?}?>

                    </select>

                </div>

            </div>

        </div>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_12_TARGET")?>
                </span>
            </span>

            <span class="content">

                <input required type="text" name="TARGET" class="input-field"
                    <? if (isset($arResult['POST']['TARGET'])) { ?> value="<?=$arResult['POST']['TARGET']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix" style="margin-top: 40px;">
            <span class="caption">
                <span class="aligner">Откуда Вы узнали о нас</span>
            </span>
            <span class="content">
                <input required type="text" name="FROM_WHERE" class="input-field"
                    <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                >
            </span>
        </label>


		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_12_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_12_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_12_POLITICS_2"). "</a>";
			$politics_output = sprintf($politics, $politics_1, $politics_2);
		?>
		
		<label class="agreement check-box">
			<input type="checkbox" name="POLITICS" required="" style="visibility: visible;">
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
            <?=GetMessage("WEBTU_FEEDBACK_12_BUTTON")?>
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
            $('input:not([type="hidden"]').val('').css('box-shadow', 'none');

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

        function yandexMetrikaForm() {
            let formFields = {
                'Поля формы':
                    {
                        'CITY': $('select[name="CITY"] option:selected').val(),
                        'DATE': $('input[name="LAST_NAME"]').val(),
                        'TARGET': $('input[name="FIRST_NAME"]').val(),
                        'PROVISION': $('input[name="BIRTHDATE"]').val(),
                        'SUM': $('input[name="SUM"]').val(),
                        //'PHONE': $('input[name="PHONE"]').val(),
                        //'EMAIL': $('input[name="EMAIL"]').val(),
                        'FROM_WHERE': $('input[name="FROM_WHERE"]').val(),
                    }
            };
            //console.log(formFields);
            //ym(316212751, 'reachGoal', 'depositOrder', formFields);

            return true;
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
                    "id": 'CITY',
                    "name": data.CITY,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'SUM',
                    "name": data.SUM,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'DATE',
                    "name": data.DATE,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'TARGET',
                    "name": data.TARGET,
                    "price": entry.PRICE,
                    "category": entry.DETAIL_PAGE_URL,
                    "quantity": entry.QUANTITY,
                    "position": pos++,
                    "xml": entry.XML_ID,
                },
            );
            ar_product.push(
                {
                    "id": 'PROVISION',
                    "name": data.PROVISION,
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

        //$('.feedback_form .button').click(function () {
        $('.popup-form_content .button').click(function () {
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

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');

        $('.select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>
