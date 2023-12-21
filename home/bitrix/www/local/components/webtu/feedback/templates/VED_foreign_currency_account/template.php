<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?// debugg($arResult); ?>
<?// debugg($arParams); ?>
<?// debugg($arParams["OPTIONS"]); ?>

<div class="v21-curraccount-form--top">
    <div class="v21-curraccount-form--bg"></div>
</div>
<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" id="fCurrencyForm" class="v21-curraccount-form">
    <input type="hidden" name="FORM_ID" value="<?= $arResult['FORM_ID'] ?>">
    <input type="hidden" name="SESSION_ID" value="<?= bitrix_sessid() ?>">

    <input type="hidden" id="CREDIT_NAME" name="CREDIT_NAME" value="">

    <input type="hidden" id="PARAMS" name="PARAMS" value='<?= json_encode($arParams["OPTIONS"]) ?>'>
    <input type="hidden" name="email2" value="">
    <div class="v21-curraccount-form__content">
        <h2 class="v21-h2 v21-curraccount-form__title"><?= GetMessage("WEBTU_FEEDBACK_8_HEADER") ?></h2>
        <div class="v21-curraccount-form__section">
            <div class="v21-grid__item-1 v21-grid__item--1x3@lg">
                <label class="v21-input-group">
                    <span class="v21-input-group__biglabel"><?= GetMessage("WEBTU_FEEDBACK_8_NAME") ?></span>
                    <input type="text" name="COMPANY" placeholder="Название" class="v21-input-group__field v21-field">
                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                </label>
            </div><!-- /.v21-grid__item -->

            <div class="v21-grid__item-2 v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                <label class="v21-input-group">
                    <span class="v21-input-group__biglabel"><?= GetMessage("WEBTU_FEEDBACK_8_FIO") ?></span>
                    <input type="text" name="FIO" placeholder="ФИО" class="v21-input-group__field v21-field">
                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                </label>
            </div><!-- /.v21-grid__item -->

            <!--div class="v21-grid"-->
                <?/*?>
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <label class="v21-input-group">
                        <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_SECOND_NAME") ?></span>
                        <input type="text" name="SECOND_NAME" placeholder="Сергеевич" class="v21-input-group__field v21-field">
                    </label>
                </div><!-- /.v21-grid__item -->
                <?*/?>

            <div class="v21-grid__item-3">
                <h3 class="v21-input-group__biglabel">Контактные данные</h3>
                <div class="v21-grid">
                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_CITY") ?></span>
                            <? CModule::IncludeModule('iblock'); ?>
                            <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y")); ?>
                            <select name="CITY" class="v21-input-group__field v21-select js-v21-select">
                                <? while ($city = $cities->Fetch()) { ?>
                                    <option value="<?= $city['NAME'] ?>">
                                        <?= $city['NAME'] ?>
                                    </option>
                                <? } ?>
                            </select>
                        </div>
                    </div>

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_PHONE") ?></span>
                            <input type="tel" name="PHONE" placeholder="+7 ___ _______" data-inputmask="'mask': '+7 999 9999999'" class="v21-input-group__field v21-field" required>
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_8_PHONE_LINE") ?></span>
                        </label>
                    </div>

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_8_EMAIL") ?></span>
                            <input type="email" name="EMAIL" placeholder="email@mail.com" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_8_EMAIL_LINE") ?></span>
                        </label>
                    </div>
                </div>

            </div>
        </div><!-- /.v21-curraccount-form__section -->

        <div class="v21-curraccount-form__section">
            <div class="v21-grid">
                <div class="v21-grid__item v21-grid__item--2x3@lg">
                    <div class="captcha_image">
                        <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                        <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="">
                    </div>

                    <a id="reloadCaptchaCallback" title="Обновить капчу"></a>

                    <div class="captcha_input v21-input-group">
                        <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="v21-input-group__field v21-field v21-input-captcha" id="CAPTCHA_WORD">
                        <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                    </div>
                </div>

                <div class="v21-grid__item">
                    <?/*?>
                    <div class="v21-checkbox">
                        <label class="v21-checkbox__content">
                            <input type="checkbox" name="CITYZENSHIP" class="v21-checkbox__input">
                            <span class="v21-checkbox__text"><?= GetMessage("WEBTU_FEEDBACK_8_CITIZENSHIP") ?></span>
                        </label>
                    </div><!-- /.v21-checkbox -->
                    <?*/?>

                    <?
                    $politics = GetMessage("WEBTU_FEEDBACK_8_POLITICS");
                    $politics_1 = "<a href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank' class='v21-link'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_8_POLITICS_1") . "</span></a>";
                    $politics_2 = "<a href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank' class='v21-link'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_8_POLITICS_2") . "</span></a>";
                    $politics_output = sprintf($politics, $politics_1, $politics_2);
                    ?>

                    <div class="v21-checkbox">
                        <label class="v21-checkbox__content">
                            <input type="checkbox" checked name="" class="v21-checkbox__input" id="politics2">
                            <span class="v21-checkbox__text">
                                <?= $politics_output ?>
                            </span>
                        </label>
                        <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                    </div><!-- /.v21-checkbox -->
                </div><!-- /.v21-grid__item -->

                <div class="v21-grid__item">
                    <button class="v21-modal__button v21-button" name="WEBTU_FEEDBACK">
                        <?= GetMessage("WEBTU_FEEDBACK_8_BUTTON") ?>
                    </button>
                </div><!-- /.v21-grid__item -->
            </div><!-- /.v21-grid -->
        </div><!-- /.v21-curraccount-form__section -->
    </div>
</form><!-- /.v21-curraccount-form -->

<div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_alert_fCurrencyForm">
    <div class="v21-modal__window js-v21-modal-window">
        <a href="#v21_alert_fCurrencyForm" class="v21-modal__close js-v21-modal-toggle">
            <svg width="24" height="24">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
            </svg>
        </a>
    </div>
</div>