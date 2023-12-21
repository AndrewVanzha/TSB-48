<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?php
$arSections = [];
$ar_filter = Array('IBLOCK_ID'=>214, 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE'=>'Y'); // Страхование физлиц
$ar_select = Array('ID', 'NAME', 'CODE', 'DESCRIPTION');
$rsSection = \Bitrix\Iblock\SectionTable::getList(array(
    'order' => array('LEFT_MARGIN'=>'ASC'),
    'filter' => $ar_filter,
    'select' => $ar_select,
));
while ($ar_section=$rsSection->fetch()) {
    $arSections[] = $ar_section;
}
?>
<?php
$postTemplateID = 0;
$rs_mess = CEventMessage::GetList($by="id", $order="desc", Array("TYPE_ID" => array($arParams['ADMIN_EVENT'])));
while($arMess = $rs_mess->GetNext()) { // нахожу ID почтового шаблона
    $postTemplateID = $arMess['ID'];
}
//debugg($postTemplateID);
?>

<style>
    div[id^="wait_"] { display: none !important; background: none !important; border: 0 !important; }
</style>

<?//debugg($arResult);?>
<div class="form-block">
    <div class="form-block--right">
        <div class="form-block--img">
            <img src="/local/templates/v21_template_home/img/v21_v21-service-form.png" alt="самолетик">
        </div>
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="card-application--form" id="applicationForm">
            <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
            <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
            <input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'>
            <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
            <input type="hidden" name="REQ_URI" value="<?= $_SERVER['SCRIPT_URL'] ?>">
            <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">

            <input type="hidden" name="NAME" value="<?=($arResult['POST']['LAST_NAME'].$arResult['POST']['FIRST_NAME'])?>" id="<?= 'name_'.$arResult['FORM_ID']; ?>">

            <div class="card-application--content">
                <h2 class="v21-h2 card-application--header"><?=GetMessage("WEBTU_FEEDBACK_4_HEADER")?></h2>

                <h3 class="card-application--subheader">Контактные данные</h3>

                <div class="v21-grid grid-bottom">
                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_LAST_NAME") ?></span>
                            <input
                                type="text" name="LAST_NAME"
                                placeholder="Пушкин"
                                <??>onchange="javascript:document.getElementById('name_'+'<?=$arResult['FORM_ID']?>').value = this.value;"<??>
                                <? if (isset($arResult['POST']['LAST_NAME'])) { ?> value="<?=$arResult['POST']['LAST_NAME']?>" <? } ?>
                                class="v21-input-group__field v21-field"
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_FIRST_NAME") ?></span>
                            <input
                                type="text" name="FIRST_NAME"
                                placeholder="Александр"
                                <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                                class="v21-input-group__field v21-field"
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_SECOND_NAME") ?></span>
                            <input
                                type="text" name="SECOND_NAME"
                                placeholder="Сергеевич"
                                <? if (isset($arResult['POST']['SECOND_NAME'])) { ?> value="<?=$arResult['POST']['SECOND_NAME']?>" <? } ?>
                                class="v21-input-group__field v21-field"
                            >
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PHONE") ?></span>
                            <input
                                type="tel" name="PHONE"
                                placeholder="+7 ___ ___ __ __"
                                data-inputmask="'mask': '+7 999 999 99 99'"
                                class="v21-input-group__field v21-field"
                                <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_4_PHONE_LINE") ?></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_EMAIL") ?></span>
                            <input
                                type="email" name="EMAIL"
                                placeholder="email@mail.com"
                                class="v21-input-group__field v21-field"
                                <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_4_EMAIL_LINE") ?></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label">Откуда Вы узнали о нас</span>
                            <input type="text" name="FROM_WHERE" placeholder=" " class="v21-input-group__field v21-field"
                                <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <? CModule::IncludeModule('iblock'); ?>
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_CITY") ?></span>
                            <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y")); ?>
                            <select name="CITY" class="v21-input-group__field v21-field jjs-v21-select">
                                <? while ($city = $cities->Fetch()) { ?>
                                    <? if ($city['ID'] != 400) : // Исключаем Санкт-Петербург ?>
                                        <option value="<?= $city['NAME'] ?>" <? if ($arResult['POST']['CITY'] == $city['NAME']) { ?>selected<? } ?> <? if (!isset($arResult['POST']['CITY']) && $city['NAME'] == 'Москва') { ?>selected<? } ?>>
                                            <?= $city['NAME'] ?>
                                        </option>
                                    <? endif; ?>
                                <? } ?>
                            </select>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_BIRTHDATE") ?></span>
                            <input
                                type="text" inputmode="numeric"
                                name="BIRTHDATE"
                                data-inputmask="'mask': '99.99.9999'"
                                placeholder="__.__.____"
                                <? if (isset($arResult['POST']['BIRTHDATE'])) { ?> value="<?=$arResult['POST']['BIRTHDATE']?>" <? } ?>
                                class="v21-input-group__field v21-field v21-datepicker js-v21-datepicker"
                            >
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@md v21-grid__item--1x3@lg">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_SEX") ?></span>
                            <div class="v21-switch">
                                <input type="radio" name="SEX" id="v21_genderMale" value="Мужской" class="v21-switch__input" <? if (!isset($arResult['POST']['SEX'])) { ?> checked <? } ?> <? if (isset($arResult['POST']['SEX'])) { ?> <? if ($arResult['POST']['SEX'] == 'Мужской') { ?> checked <? } ?> <? } ?>>
                                <label for="v21_genderMale" class="v21-switch__label"><?= GetMessage("WEBTU_FEEDBACK_4_SEX_MALE") ?></label>
                                <input type="radio" name="SEX" id="v21_genderFemale" value="Женский" class="v21-switch__input" <? if (isset($arResult['POST']['SEX'])) { ?> <? if ($arResult['POST']['SEX'] == 'Женский') { ?> checked <? } ?> <? } ?>>
                                <label for="v21_genderFemale" class="v21-switch__label"><?= GetMessage("WEBTU_FEEDBACK_4_SEX_FEMALE") ?></label>
                                <div class="v21-switch__handle"></div>
                            </div>
                        </div>
                    </div><!-- /.v21-grid__item -->
                </div><!-- /.v21-grid -->

                <h3 class="card-application--subheader">Страхование</h3>

                <div class="v21-grid">
                    <div class="v21-grid__item v21-grid__item--2x3@lg select_field">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <div class="v21-input-group">
                                <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_TRANSLIT_DESC") ?></span>
                                <select name="TYPE" class="v21-input-group__field v21-field" id="type_select">
                                    <? for ($ii=0; $ii<count($arSections); $ii++) { ?>
                                        <option value="<?= $arSections[$ii]['DESCRIPTION'] ?>" <? if ($arResult['POST']['TYPE'] == $arSections[$ii]['DESCRIPTION']) { ?>selected<? } ?> <? if (!isset($arResult['POST']['TYPE']) && $arSections[$ii]['DESCRIPTION'] == $arSections[0]['DESCRIPTION']) { ?>selected<? } ?>>
                                            <?= $arSections[$ii]['DESCRIPTION'] ?>
                                        </option>
                                    <? } ?>
                                </select>
                            </div>
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--2x3@lg">
                        <div class="captcha_image">
                            <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                            <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="">
                        </div>

                        <a id="reloadCaptcha" title="Обновить капчу"></a>

                        <div class="captcha_input v21-input-group">
                            <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="v21-input-group__field v21-field" id="CAPTCHA_WORD">
                        </div>
                        <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                    </div>

                    <div class="v21-grid__item">
                        <div class="v21-checkbox">
                            <label class="v21-checkbox__content">
                                <input
                                        type="checkbox" id="politics"
                                        name="CITYZENSHIP"
                                        class="v21-checkbox__input"
                                >
                                <span class="v21-checkbox__text">
                                    <?= GetMessage("WEBTU_FEEDBACK_4_CITIZENSHIP") ?>
                                </span>
                            </label>
                            <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                        </div><!-- /.v21-checkbox -->
                    </div><!-- /.v21-grid__item -->

                    <?
                    $politics = GetMessage("WEBTU_FEEDBACK_4_POLITICS");
                    $politics_1 = "<a class='v21-link' href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_4_POLITICS_1") . "</span></a>";
                    $politics_2 = "<a class='v21-link' href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_4_POLITICS_2") . "</span></a>";
                    $politics_output = sprintf($politics, $politics_1, $politics_2);
                    ?>
                    <div class="v21-grid__item">
                        <div class="v21-checkbox">
                            <label class="v21-checkbox__content">
                                <input id="politics2" type="checkbox" name="politics" class="v21-checkbox__input">
                                <span class="v21-checkbox__text">
                                    <?= $politics_output ?>
                                </span>
                            </label>
                            <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                        </div><!-- /.v21-checkbox -->
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-plastic-form__controls v21-grid__item">
                        <button class="v21-plastic-form__submit v21-button" name="WEBTU_FEEDBACK">
                            <?= GetMessage("WEBTU_FEEDBACK_4_BUTTON") ?>
                        </button>
                    </div><!-- /.v21-plastic-form__controls -->
                </div>

            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

   $(document).ready(function() {
       $('.js-fInsuranceForm').on('click', function() {
           let href = $(this).attr('href');
           let type = $(this).data('item');
           //console.log(href);
           //console.log(type);
           $('html, body').animate({
               scrollTop: $(href).offset().top - 120
           }, {
               duration: 800,   // по умолчанию «400»
               easing: "linear" // по умолчанию «swing»
           });
           let insurance = cnangeInsuranceForm(type);
           $(`#type_select option[value="${insurance.description}"]`).prop('selected', true);
           return false;
       });

       function cnangeInsuranceForm(type) {
           let arSections = <?php echo json_encode($arSections) ?>;
           let result = new Object();
           arSections.forEach((item, ix) => {
               if (item.CODE == type) {
                   result.code = item.CODE;
                   result.description = item.DESCRIPTION;
               }
           });
           return result;
       }

       $('#reloadCaptcha').click(function() {
        $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
            $('#captchaImg').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captchaSid').val(data);
        });
        return false;
      });

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

       function requiredFields() {
           let arFields = [
               'input[name="LAST_NAME"]',
               'input[name="FIRST_NAME"]',
               'input[name="BIRTHDATE"]',
               'input[name="PHONE"]',
               'input[name="EMAIL"]',
               'input[name="FROM_WHERE"]',
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
           if($('#politics2').is(':checked')) {
               $('#politics2').parent().parent().removeClass("is-error");
           } else {
               countErr += 1;
               $('#politics2').parent().parent().addClass("is-error");
           }

           return (countErr > 0) ? false : true;
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
                   "id": 'TYPE',
                   "name": data.TYPE,
                   "price": entry.PRICE,
                   "category": entry.DETAIL_PAGE_URL,
                   "quantity": entry.QUANTITY,
                   "position": pos++,
                   "xml": entry.XML_ID,
               },
           );
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

       $('#applicationForm').submit(function (e) {
           let ar_product = [];
           let postTemplateID = <?= $postTemplateID; ?>;

           e.preventDefault();
           console.log('insurance');
           //if ($("#politics2").prop("checked")) {
           //$('#politics2').parent().parent().removeClass("is-error");
           //console.log('2');
           if (requiredFields()) {
               //console.log('3');
               $.ajax({
                   type: "POST",
                   url: '/ajax_scripts/ajax.customer.php',
                   data: {
                       'fields': $(this).serialize(),
                   },
                   dataType: "json",
                   success: function (data) {
                       //console.log('**');
                       if (data.status) {
                           let response = data.message[0];
                           if(response.type) {
                               //console.log(response.data.APPLICATION_ID);
                               ar_product = makeArProduct(response.data);
                               makeDataLayer(response.data.APPLICATION_ID, ar_product);
                               //console.log(window.dataLayer);
                               //yandexMetrikaForm();
                           }

                           clearFields ();
                           $('input[name="CAPTCHA_WORD"]').parent().parent().removeClass("is-error");
                           $('input[name="CAPTCHA_WORD"]').css('border-color', 'rgba(32, 32, 32, 0.12)');
                           document.location.href = "/thanks/";
                       } else {
                           console.log('not OK');
                           if (!data.captcha){
                               $('input[name="CAPTCHA_WORD"]').parent().parent().addClass("is-error");
                               $('input[name="CAPTCHA_WORD"]').css('border-color', '#aa0000');
                           } else {
                               $('input[name="CAPTCHA_WORD"]').parent().parent().removeClass("is-error");
                               $('input[name="CAPTCHA_WORD"]').css('border-color', 'rgba(32, 32, 32, 0.12)');
                           }
                       }
                   }
               });
           }
           //} else {
           //    $('#politics2').parent().parent().addClass("is-error");
           //}
       });
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
