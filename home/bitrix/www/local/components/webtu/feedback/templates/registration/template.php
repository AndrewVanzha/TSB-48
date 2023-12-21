<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">

    <h6 class="popup-form_title page-title--6 page-title">
        <?=GetMessage("WEBTU_FEEDBACK_10_HEADER")?>
    </h6>

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


        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_10_COMPANY_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="COMPANY_NAME" class="input-field"
                    <? if (isset($arResult['POST']['COMPANY_NAME'])) { ?> value="<?=$arResult['POST']['COMPANY_NAME']?>" <? } ?>
                >

            </span>

        </label>

        <label class="popup-form_input-group clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_10_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="FIRST_NAME" class="input-field"
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
                >

            </span>

        </label>


        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_10_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input type="tel" name="PHONE" data-mask="phone" class="input-field" placeholder="+7 (___) ___-__-__"
                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_10_PHONE_LINE")?>
                </span>

            </span>

        </label>

        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_10_EMAIL")?>
                </span>
            </span>

            <span class="content">

                <input type="email" name="EMAIL" class="input-field" placeholder="example@site.ru"
                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                >

                <span class="note">
                    <?=GetMessage("WEBTU_FEEDBACK_10_EMAIL_LINE")?>
                </span>

            </span>

        </label>

        <div class="popup-form_input-group clearfix">

            <div class="caption">
                <span class="aligner">
                    <?=GetMessage("WEBTU_FEEDBACK_10_CITY")?>
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
                    <?=GetMessage("WEBTU_FEEDBACK_10_TAXATION")?>
                </span>
            </div>

            <div class="content">

                <div class="select-box">

                    <select name="TAXATION">


                        <option selected value="Нужна консультация"
                            <? if ($arResult['POST']['TAXATION'] == "Нужна консультация" || empty($arResult['POST']['TAXATION'])) { ?>selected<? } ?>
                        >
                            <?=GetMessage("WEBTU_FEEDBACK_10_TAXATION_DEFAULT")?>
                        </option>

                        <option value="Классическая (ОСНО)"
                            <? if ($arResult['POST']['TAXATION'] == "Классическая (ОСНО)") { ?>selected<? } ?>
                        >
                            <?=GetMessage("WEBTU_FEEDBACK_10_TAXATION_CLASSIC")?>
                        </option>

                        <option value="УСН 6% (Дохода)"
                            <? if ($arResult['POST']['TAXATION'] == "УСН 6% (Дохода)") { ?>selected<? } ?>
                        >
                            <?=GetMessage("WEBTU_FEEDBACK_10_TAXATION_USN6")?>
                        </option>

                        <option value="УСН 15% (Доходы - расходы)"
                            <? if ($arResult['POST']['TAXATION'] == "УСН 15% (Доходы - расходы)") { ?>selected<? } ?>
                        >
                            <?=GetMessage("WEBTU_FEEDBACK_10_TAXATION_USN15")?>
                        </option>

                        <option value="ЕНВД"
                            <? if ($arResult['POST']['TAXATION'] == "ЕНВД") { ?>selected<? } ?>
                        >
                            <?=GetMessage("WEBTU_FEEDBACK_10_TAXATION_ENVD")?>
                        </option>


                    </select>
                </div>

            </div>

        </div>

        <label class="agreement check-box">

            <input type="checkbox" name="OPENING" checked>

            <span class="check-box_caption">
                <?=GetMessage("WEBTU_FEEDBACK_10_OPENING")?>
            </span>

        </label>
		
		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_10_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_10_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_10_POLITICS_2"). "</a>";
			$politics_output = sprintf($politics, $politics_1, $politics_2);
		?>
		
		<label class="agreement check-box">
			<input type="checkbox" name="POLITICS" checked required="">
			<span class="check-box_caption"><?=$politics_output?></span>
		</label>

        <div class="captcha clearfix">

            <div class="captcha_image">
                <input type="hidden" name="CAPTCHA_ID" value="<?=$arResult['CAPTCHA']?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA']?>" alt="">
            </div>

            <div class="captcha_input">
                <input type="text" name="CAPTCHA_WORD" placeholder="<?=GetMessage("WEBTU_FEEDBACK_CAPTCHA")?>" class="input-field">
            </div>

        </div>

        <button class="button" name="WEBTU_FEEDBACK">
            <?=GetMessage("WEBTU_FEEDBACK_10_BUTTON")?>
        </button>

    </div>

</form>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('#cardRequest input[data-mask="phone"]').mask('+7 (999) 999-99-99');
        $('#cardRequest .select-box select').customSelect({
            speed: 660
        });
    </script>
<? } ?>
