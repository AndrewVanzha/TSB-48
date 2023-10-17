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
                    <?=GetMessage("WEBTU_FEEDBACK_4_FIRST_NAME")?>
                </span>
            </span>

            <span class="content">

                <input type="text" name="FIRST_NAME" class="input-field"
                    <? if (isset($arResult['POST']['FIRST_NAME'])) { ?> value="<?=$arResult['POST']['FIRST_NAME']?>" <? } ?>
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


        <label class="popup-form_input-group double-offset clearfix">

            <span class="caption">
                <span class="aligner">
                	<?=GetMessage("WEBTU_FEEDBACK_4_PHONE")?>
                </span>
            </span>

            <span class="content">

                <input type="tel" name="PHONE" data-mask="phone" class="input-field" placeholder="+7 (___) ___-__-__"
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

		<? 
			$politics = GetMessage("WEBTU_FEEDBACK_4_POLITICS");
			$politics_1 = "<a href='/assets/docs/Правила_оформления онлайн_заявок.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_4_POLITICS_1"). "</a>";
			$politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'>" .GetMessage("WEBTU_FEEDBACK_4_POLITICS_2"). "</a>";
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
            <?=GetMessage("WEBTU_FEEDBACK_4_BUTTON")?>
        </button>

    </div>

</form>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('#cardRequest input[data-mask="phone"]').mask('+7 (999) 999-99-99');
        $('#cardRequest .select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>
