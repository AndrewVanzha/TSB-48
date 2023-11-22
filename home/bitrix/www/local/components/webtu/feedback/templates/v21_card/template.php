<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
IncludeTemplateLangFile(__FILE__);
//$specialCity = "Не выбрано"; // для Санкт-Петербурга
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
    .special-height .choices__list--dropdown {
        top: auto;
        bottom: 100%;
    }
</style>

<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" id="orderCard">

    <input type="hidden" name="FORM_ID" value="<?= $arResult['FORM_ID'] ?>">
    <input type="hidden" name="SESSION_ID" value="<?= bitrix_sessid() ?>">
    <input type="hidden" id="CARD_TYPE" name="CARD_TYPE" value="">
    <input type="hidden" id="CARD_NAME" name="CARD_NAME" value="">
    <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
    <?/*?><input type="hidden" name="email2" value=""><?*/?>
    <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
    <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">
    <input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'>

    <div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_plasticOrder1">
        <div class="v21-modal__window js-v21-modal-window">
            <a href="#v21_plasticOrder1" class="v21-modal__close js-v21-modal-toggle">
                <svg width="24" height="24">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
                </svg>
            </a>
            <h2 class="v21-modal__title v21-h2 page-header"><?= GetMessage("WEBTU_FEEDBACK_4_HEADER") ?></h2>
            <div class="v21-plastic-form">
                <div class="v21-plastic-form__heading">
                    <div class="v21-plastic-form__heading-count v21-plastic-form__count">
                        <span class="v21-plastic-form__count-current">1</span>
                        /
                        <span>2</span>
                    </div><!-- /.v21-plastic-form__heading-count -->
                    <h3 class="v21-plastic-form__heading-title v21-h5"><?= GetMessage("WEBTU_FEEDBACK_4_CONTACT_DETAIL") ?></h3>
                </div><!-- /.v21-plastic-form__heading -->

                <div class="v21-grid">
                    <div class="v21-grid__item v21-grid__item--2x3@lg">
                        <div class="v21-plastic-form__card js-v21-tabs">
                            <div class="v21-plastic-form__card-select v21-input-group">
                                <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_SELECTED_CARD") ?></span>
                                <select name="TYPE" class="v21-input-group__field v21-select js-v21-tabs-selector">
                                    <? if ($arResult['DEBETS_CARDS']) {
                                        foreach ($arResult['DEBETS_CARDS'] as $key => $card) {
                                            $selected = $key === 0 ? "selected" : "";
                                    ?>
                                            <option value="<?= $card["NAME"] ?>" <?= $selected ?>><?= $card["NAME"] ?></option>
                                    <?
                                        }
                                    } ?>
                                </select>
                            </div>

                            <div class="v21-plastic-form__card-image v21-tabs-content">
                                <? if ($arResult['DEBETS_CARDS']) {
                                    foreach ($arResult['DEBETS_CARDS'] as $key => $card) {
                                        $isActive = $key === 0 ? " is-active" : "";
                                ?>
                                        <div data-tab-id="<?= $card["NAME"] ?>" class="v21-tabs-content__item v21-fade<?= $isActive ?>">
                                            <img src="<?= CFile::GetPath($card["PREVIEW_PICTURE"]) ?>" alt="<?= $card["NAME"] ?>">
                                        </div>
                                <?
                                    }
                                }
                                ?>
                            </div>
                        </div><!-- /.v21-plastic-form__card -->
                    </div><!-- /.v21-grid__item -->
                </div> <!-- /.v21-grid -->

                <div class="v21-grid">
                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PHONE") ?></span>
                            <input type="tel" name="PHONE" placeholder="+7 ___ _______" data-inputmask="'mask': '+7 999 9999999'" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_4_PHONE_LINE") ?></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_EMAIL") ?></span>
                            <input type="email" name="EMAIL" placeholder="example@gmail.com" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_4_EMAIL_LINE") ?></span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_CITY") ?></span>

                            <select name="CITY" class="v21-input-group__field v21-select js-v21-select city-select">
                                <? foreach ($arResult['CITIES_MOD'] as $city) :  // Исключаем Санкт-Петербург ?>
                                    <option value="<?= $city['NAME'] ?>"
                                            <? if ($arResult['POST']['CITY'] == $city['NAME']) { ?>selected<? } ?>
                                            <? if (!isset($arResult['POST']['CITY']) && $city['NAME'] == $arResult['SPECIAL_CITY']) { ?>selected<? } ?>>
                                        <?= $city['NAME'] ?>
                                    </option>
                                <? endforeach; ?>
                            </select>

                            <?/*?>
                            <? CModule::IncludeModule('iblock'); ?>
                            <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114)); ?>
                            <select name="CITY" class="v21-input-group__field v21-select js-v21-select city-select">
                                <? while ($city = $cities->Fetch()) { ?>
                                    <? if ($city['ID'] != 400) : // Исключаем Санкт-Петербург ?>
                                    <option value="<?= $city['NAME'] ?>"
                                        <? if ($arResult['POST']['CITY'] == $city['NAME']) { ?>selected<? } ?>
                                        <? if (!isset($arResult['POST']['CITY']) && $city['NAME'] == 'Москва') { ?>selected<? } ?>>
                                        <?= $city['NAME'] ?>
                                    </option>
                                    <? endif; ?>
                                    <? if ($city['ID'] == 400) : // Санкт-Петербург - особый случай ?>
                                        <option value=<?=$specialCity?>
                                            <? if ($arResult['POST']['CITY'] == $city['NAME'] && $city['NAME'] == 'Санкт-Петербург') { ?>selected<? } ?>>
                                            <?=$specialCity?>
                                        </option>
                                    <? endif; ?>
                                <? } ?>
                            </select>
                            <?*/?>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_LAST_NAME") ?></span>
                            <input type="text" name="LAST_NAME" placeholder="Пушкин" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_FIRST_NAME") ?></span>
                            <input type="text" name="FIRST_NAME" placeholder="Александр" class="v21-input-group__field v21-field">
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_SECOND_NAME") ?></span>
                            <input type="text" name="SECOND_NAME" placeholder="Сергеевич" class="v21-input-group__field v21-field">
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item translit v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_TRANSLIT") ?></span>
                            <input type="text" name="TRANSLIT" placeholder="ALEXANDR PUSHKIN" style="text-transform: uppercase;" class="v21-input-group__field v21-field">
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                            <span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_4_TRANSLIT_DESC") ?></span>
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                        <label class="v21-input-group">
                            <span class="v21-input-group__label">Откуда Вы узнали о нас</span>
                            <input type="text" name="FROM_WHERE" placeholder=""
                                <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                                   class="v21-input-group__field v21-field"
                            >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-plastic-form__controls v21-grid__item">
                        <a href="#v21_plasticOrder2" class="v21-plastic-form__next v21-button js-v21-modal-toggle">
                            <span><?= GetMessage("WEBTU_FEEDBACK_4_NEXT") ?></span>
                            <?/*?>
                            <svg width="10" height="10" class="v21-plastic-form__next-icon">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#chevronRight"></use>
                            </svg>
                            <?*/?>
                        </a>
                        <div class="v21-plastic-form__controls-count v21-plastic-form__count">
                            <span class="v21-plastic-form__count-current">1</span>
                            /
                            <span>2</span>
                        </div><!-- /.v21-plastic-form__controls-count -->
                    </div><!-- /.v21-plastic-form__controls -->
                </div><!-- /.v21-grid -->
            </div><!-- /.v21-plastic-form -->
        </div><!-- /.v21-modal__window -->
    </div><!-- /.v21-modal -->

    <div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_plasticOrder2">
        <div class="v21-modal__window js-v21-modal-window">
            <a href="#v21_plasticOrder2" class="v21-modal__close js-v21-modal-toggle">
                <svg width="24" height="24">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
                </svg>
            </a>
            <h2 class="v21-modal__title v21-h2"><?= GetMessage("WEBTU_FEEDBACK_4_HEADER") ?></h2>
            <div class="v21-plastic-form js-v21-tabs">
                <div class="v21-plastic-form__heading">
                    <div class="v21-plastic-form__heading-count v21-plastic-form__count">
                        <span class="v21-plastic-form__count-current">2</span>
                        /
                        <span>2</span>
                    </div><!-- /.v21-plastic-form__heading-count -->
                    <h3 class="v21-plastic-form__heading-title v21-h5"><?= GetMessage("WEBTU_FEEDBACK_4_DATA_REGISTRATION") ?></h3>
                </div><!-- /.v21-plastic-form__heading -->

                <div class="v21-grid">
                    <div class="v21-grid__item v21-grid__item--1x2@md v21-grid__item--1x3@lg">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_TYPE_PASS") ?></span>
                            <select name="TYPE_PASS" class="v21-input-group__field v21-select js-v21-select">
                                <option value="<?= GetMessage("WEBTU_FEEDBACK_4_PASS_RF") ?>">
                                    <?= GetMessage("WEBTU_FEEDBACK_4_PASS_RF") ?>
                                </option>
                                <option value="<?= GetMessage("WEBTU_FEEDBACK_4_PASS_INOY") ?>">
                                    <?= GetMessage("WEBTU_FEEDBACK_4_PASS_INOY") ?>
                                </option>
                            </select>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@md v21-grid__item--1x3@lg">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_SEX") ?></span>
                            <div class="v21-switch">
                                <label for="v21_genderMale" class="v21-switch__label">
                                    <?= GetMessage("WEBTU_FEEDBACK_4_SEX_MALE") ?>
                                    <input type="radio" name="SEX" id="v21_genderMale" value="Мужской" class="v21-switch__input v21-switch__input--left" <?/* if (!isset($arResult['POST']['SEX'])) { ?> checked <? } */?> <? if (isset($arResult['POST']['SEX'])) { ?> <? if ($arResult['POST']['SEX'] == 'Мужской') { ?> checked <? } ?> <? } ?>>
                                </label>
                                <label for="v21_genderFemale" class="v21-switch__label">
                                    <?= GetMessage("WEBTU_FEEDBACK_4_SEX_FEMALE") ?>
                                    <input type="radio" name="SEX" id="v21_genderFemale" value="Женский" class="v21-switch__input v21-switch__input--right" <? if (isset($arResult['POST']['SEX'])) { ?> <? if ($arResult['POST']['SEX'] == 'Женский') { ?> checked <? } ?> <? } ?>>
                                </label>
                                <?/*?><input type="radio" name="SEX" id="v21_genderMale" value="Мужской" class="v21-switch__input" <? if (!isset($arResult['POST']['SEX'])) { ?> checked <? } ?> <? if (isset($arResult['POST']['SEX'])) { ?> <? if ($arResult['POST']['SEX'] == 'Мужской') { ?> checked <? } ?> <? } ?>>
                                <label for="v21_genderMale" class="v21-switch__label"><?= GetMessage("WEBTU_FEEDBACK_4_SEX_MALE") ?></label>
                                <input type="radio" name="SEX" id="v21_genderFemale" value="Женский" class="v21-switch__input" <? if (isset($arResult['POST']['SEX'])) { ?> <? if ($arResult['POST']['SEX'] == 'Женский') { ?> checked <? } ?> <? } ?>>
                                <label for="v21_genderFemale" class="v21-switch__label"><?= GetMessage("WEBTU_FEEDBACK_4_SEX_FEMALE") ?></label>
                                <div class="v21-switch__handle"></div><?*/?>
                            </div>
                        </div>
                    </div><!-- /.v21-grid__item -->
                </div><!-- /.v21-grid -->

                <div class="v21-plastic-form__tabs v21-tabs-content">
                    <div data-tab-id="document1" class="v21-tabs-content__item v21-fade is-active">
                        <div class="v21-grid">
                            <?/*?><div class="v21-grid__item v21-grid__item--1x3@sm"><?*/?>
                            <div class="v21-grid__item v21-grid__item--1x4@sm">
                                <label class="v21-input-group">
                                    <!-- добавить is-error для выделения при ошибке -->
                                    <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_SERIYA") ?></span>
                                    <input type="text" name="PASS_SERIYA" inputmode="numeric" placeholder="__-__" data-inputmask="'mask': '99 99'" class="v21-input-group__field v21-field">
                                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                                    <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                                </label>
                            </div><!-- /.v21-grid__item -->

                            <?/*?><div class="v21-grid__item v21-grid__item--1x3@sm"><?*/?>
                            <div class="v21-grid__item v21-grid__item--1x4@sm">
                                <label class="v21-input-group">
                                    <!-- добавить is-error для выделения при ошибке -->
                                    <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_NUMBER") ?></span>
                                    <input type="text" name="PASS_NUMBER" inputmode="numeric" placeholder="______" data-inputmask="'mask': '999999'" class="v21-input-group__field v21-field">
                                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                                    <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                                </label>
                            </div><!-- /.v21-grid__item -->

                            <?/*?><div class="v21-grid__item v21-grid__item--1x3@sm"><?*/?>
                            <div class="v21-grid__item v21-grid__item--1x4@sm">
                                <div class="v21-input-group">
                                    <!-- добавить is-error для выделения при ошибке -->
                                    <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_DATA") ?></span>
                                    <input type="text" inputmode="numeric" name="PASS_DATA" data-inputmask="'mask': '99.99.9999'" placeholder="__.__.____" class="v21-input-group__field v21-field v21-datepicker js-v21-datepicker" >
                                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                                    <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                                </div>
                            </div><!-- /.v21-grid__item -->

                            <?/*?>
                            <div class="v21-grid__item v21-grid__item--2x3@sm">
                                <label class="v21-input-group">
                                    <!-- добавить is-error для выделения при ошибке -->
                                    <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_KEM") ?></span>
                                    <input type="text" name="PASS_KEM" class="v21-input-group__field v21-field" required>
                                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                                    <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                                </label>
                            </div><!-- /.v21-grid__item -->
                            <?*/?>

                            <?/*?><div class="v21-grid__item v21-grid__item--1x3@sm"><?*/?>
                            <div class="v21-grid__item v21-grid__item--1x4@sm">
                                <label class="v21-input-group">
                                    <!-- добавить is-error для выделения при ошибке -->
                                    <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_COD") ?></span>
                                    <input type="text" name="PASS_COD" inputmode="numeric" placeholder="___-___" data-inputmask="'mask': '999-999'" class="v21-input-group__field v21-field" >
                                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                                    <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                                </label>
                            </div><!-- /.v21-grid__item -->

                            <?// new?>
                            <div class="v21-grid__item v21-grid__item--2x3@sm">
                                <label class="v21-input-group">
                                    <!-- добавить is-error для выделения при ошибке -->
                                    <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_KEM") ?></span>
                                    <input type="text" name="PASS_KEM" class="v21-input-group__field v21-field" >
                                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                                    <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                                </label>
                            </div><!-- /.v21-grid__item -->

                            <?// new?>
                            <?/*?><div class="v21-grid__item v21-grid__item--2x3@sm"><?*/?>
                            <div class="v21-grid__item v21-grid__item--1x3@sm">
                                <label class="v21-input-group">
                                    <!-- добавить is-error для выделения при ошибке -->
                                    <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_MESTO") ?></span>
                                    <input type="text" name="PASS_MESTO" class="v21-input-group__field v21-field" >
                                    <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                                    <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                                </label>
                            </div><!-- /.v21-grid__item -->

                        </div><!-- /.v21-grid -->
                    </div><!-- /.v21-tabs-content__item -->
                </div><!-- /.v21-tabs-content -->

                <div class="v21-grid">
                    <?// new?>
                    <div class="v21-grid__item v21-grid__item--2x3@md">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_ADDR_R") ?></span>
                            <input type="text" name="PASS_ADDR_R" class="v21-input-group__field v21-field" >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <?/*?>
                    <div class="v21-grid__item v21-grid__item--2x3@sm">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_MESTO") ?></span>
                            <input type="text" name="PASS_MESTO" class="v21-input-group__field v21-field" required>
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </label>
                    </div><!-- /.v21-grid__item -->
                    <?*/?>

                    <div class="v21-grid__item v21-grid__item--1x3@sm">
                        <div class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_BIRTHDATE") ?></span>
                            <input type="text" inputmode="numeric" name="BIRTHDATE" data-inputmask="'mask': '99.99.9999'" placeholder="__.__.____" class="v21-input-group__field v21-field v21-datepicker js-v21-datepicker" >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <?/*?>
                    <div class="v21-grid__item v21-grid__item--2x3@md">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_ADDR_R") ?></span>
                            <input type="text" name="PASS_ADDR_R" class="v21-input-group__field v21-field" required>
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </label>
                    </div><!-- /.v21-grid__item -->
                    <?*/?>

                    <?/*?>
                    <div class="v21-grid__item v21-grid__item--1x3@md v21-grid__item--end block_deliveryHome">
                        <input type="hidden" name="DELIVERYCARD" id="v21_deliveryHome" value="OFF">
                        <div class="v21-plastic-form__sync v21-input-group">
                            <div class="v21-switch v21-switch--check">
                                <input type="checkbox" name="DELIVERYCARD" id="v21_deliveryHome" class="v21-switch__input js-v21-sync-field">
                                <label for="v21_deliveryHome" class="v21-switch__label"><?= GetMessage("WEBTU_FEEDBACK_4_DELIVERYCARD") ?></label>
                                <div class="v21-switch__handle"></div>
                            </div>
                        </div>
                    </div><!-- /.v21-grid__item -->
                    <?*/?>

                    <div class="v21-grid__item v21-grid__item--2x3@md">
                        <label class="v21-input-group">
                            <!-- добавить is-error для выделения при ошибке -->
                            <span class="v21-input-group__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_ADDR_F") ?></span>
                            <input type="text" name="PASS_ADDR_F" class="v21-input-group__field v21-field" >
                            <span class="v21-input-group__warn">Обязательное поле к заполнению</span>
                            <!-- <span class="v21-input-group__warn">Пример сообщения об ошибке</span> -->
                        </label>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x3@md v21-grid__item--end">
                        <div class="v21-plastic-form__sync v21-input-group">
                            <div class="v21-switch v21-switch--check">
                                <input type="checkbox" data-sync-to="PASS_ADDR_F" data-sync-from="PASS_ADDR_R" autocomplete="off" name="" id="v21_addressSync" class="v21-switch__input v21-switch__input--dop js-v21-sync-field">
                                <label for="v21_addressSync" class="v21-switch__label"><?= GetMessage("WEBTU_FEEDBACK_4_PASS_ADDR_S") ?></label>
                                <div class="v21-switch__handle"></div>
                            </div>
                        </div>
                    </div><!-- /.v21-grid__item -->
                </div><!-- /.v21-grid -->

                <div class="v21-grid">

                    <div class="v21-grid__item v21-grid__item--1x2@md special-height js-block-delivery">
                        <div class="v21-input-group">
                            <span class="v21-input-group__label">Способ доставки</span>
                            <div class="v21-switch">
                                <label for="v21_autoDelivery" class="v21-switch__label">
                                    Заберу сам
                                    <input type="radio" name="DELIVERY" id="v21_autoDelivery" value="Заберу в офисе" class="v21-switch__input v21-switch__input--left" <?/* if (!isset($arResult['POST']['DELIVERY'])) { ?> checked <? } */?> <? if (isset($arResult['POST']['DELIVERY'])) { ?> <? if ($arResult['POST']['DELIVERY'] == 'Заберу в офисе') { ?> checked <? } ?> <? } ?>>
                                </label>
                                <label for="v21_moscowDelivery" class="v21-switch__label">
                                    Доставка по Москве
                                    <input type="radio" name="DELIVERY" id="v21_moscowDelivery" value="Доставка по Москве" class="v21-switch__input v21-switch__input--right" <? if (isset($arResult['POST']['DELIVERY'])) { ?> <? if ($arResult['POST']['DELIVERY'] == 'Доставка по Москве') { ?> checked <? } ?> <? } ?>>
                                </label>
                            </div>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--1x2@md special-height js-block-delivery">
                        <div class="v21-input-group js-block-pickup-office">
                            <select name="DELIVERY_ADDRESS" class="v21-input-group__field v21-select js-v21-select">
                                <? foreach ($arResult['OFFICES']['moskva'] as $office) :  // Исключаем Санкт-Петербург ?>
                                    <option value="<?= $office['ADDRESS'] ?>"
                                            <? if ($arResult['POST']['DELIVERY_ADDRESS'] == $office['ADDRESS']) { ?>selected<? } ?>
                                            <? if (!isset($arResult['POST']['DELIVERY_ADDRESS']) && $office['ADDRESS'] == 'Центральный Офис') { ?>selected<? } ?>>
                                        <?= $office['ADDRESS'] ?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="v21-input-group js-block-delivery-address">
                            <label class="v21-input-group">
                                <input type="text" name="DELIVERY_ADDRESS" class="v21-input-group__field v21-field"
                                    <? if (isset($arResult['POST']['DELIVERY_ADDRESS'])) { ?> value="<?=$arResult['POST']['DELIVERY_ADDRESS']?>" <? } ?>
                                       placeholder="Адрес доставки">
                                <span class="v21-input-group__label">Время доставки до 18:00</span>
                                <!--span class="" style="height: "></span-->
                            </label>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <div class="v21-grid__item v21-grid__item--3x3@md special-height js-block-pickup-address">
                        <div class="v21-plastic-form__sync v21-input-group">
                            <div class="">
                                <p class="v21-input-group__label js-office-header"></p>
                                <p class="v21-input-group__label js-office-address" style="font-size: 14px;"></p>
                            </div>
                        </div>
                    </div><!-- /.v21-grid__item -->

                    <?
                    $politics = GetMessage("WEBTU_FEEDBACK_4_POLITICS");
                    $politics_1 = "<a class='v21-link' href='/assets/docs/Правила_оформления_онлайн_заявок.pdf' target='_blank'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_4_POLITICS_1") . "</span></a>";
                    $politics_2 = "<a class='v21-link' href='/assets/docs/Согласие_на_обработку_ПД_для_сайта.pdf' target='_blank'><span class='v21-link__text'>" . GetMessage("WEBTU_FEEDBACK_4_POLITICS_2") . "</span></a>";
                    $politics_output = sprintf($politics, $politics_1, $politics_2);
                    ?>

                    <?/*?><div class="v21-grid__item"><?*/?>
                    <div class="v21-grid__item v21-grid__item--1x2@lg">
                        <div class="v21-checkbox">
                            <label class="v21-checkbox__content">
                                <input id="politics" type="checkbox" name="politics" class="v21-checkbox__input">
                                <span class="v21-checkbox__text">
                                    <?= $politics_output ?>
                                </span>
                            </label>
                            <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                        </div><!-- /.v21-checkbox -->
                    </div><!-- /.v21-grid__item -->

                    <?/*?><div class="v21-grid__item v21-grid__item--2x3@lg"><?*/?>
                    <div class="v21-grid__item v21-grid__item--1x2@lg">
                        <div class="captcha_image">
                            <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                            <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="">
                        </div>

                        <a id="reloadCaptcha" title="Обновить капчу"></a>

                        <div class="captcha_input v21-input-group">
                            <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="v21-input-group__field v21-field" id="CAPTCHA_WORD">
                            <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                        </div>
                    </div>

                    <div class="v21-plastic-form__controls v21-grid__item">
                        <a href="#v21_plasticOrder1" class="v21-button v21-button--link js-v21-modal-toggle prevPageForm">
                            <span>Вернуться</span>
                            <?/*?>
                            <span>Вернуться назад</span>
                            <svg width="9" height="9" class="v21-button__icon">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowBack"></use>
                            </svg>
                            <?*/?>
                        </a>
                        <button class="v21-plastic-form__submit v21-button" name="WEBTU_FEEDBACK">
                            Подать заявку
                            <?//= GetMessage("WEBTU_FEEDBACK_4_BUTTON") ?>
                        </button>
                        <div class="v21-plastic-form__controls-count v21-plastic-form__count">
                            <span class="v21-plastic-form__count-current">2</span>
                            /
                            <span>2</span>
                        </div><!-- /.v21-plastic-form__controls-count -->
                    </div><!-- /.v21-plastic-form__controls -->

                </div><!-- /.v21-grid -->
            </div><!-- /.v21-plastic-form -->
        </div><!-- /.v21-modal__window -->
    </div><!-- /.v21-modal -->
</form>


<div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_alert_orderCard">
    <div class="v21-modal__window js-v21-modal-window">
        <a href="#v21_alert_orderCard" class="v21-modal__close js-v21-modal-toggle">
            <svg width="24" height="24">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
            </svg>
        </a>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.v21-plastic-form__controls').on('click', function() {
            let city_selected = $.trim($('.city-select option:selected').text());
            let ar_offices = <?php echo json_encode($arResult['OFFICES_LIST']) ?>;
            //console.log(ar_offices);
            $('.js-office-header').text('');
            $('.js-office-address').text('');
            $('.js-block-delivery').fadeOut(50);
            $('.js-block-pickup-office').fadeOut(50);
            $('.js-block-delivery-address').fadeOut(50);
            $('.js-block-pickup-address').fadeOut(50);
            $('input[type="hidden"][name="DELIVERY"]').remove();

            const not_selected = 'Не выбрано';
            if(ar_offices) {  // непустой массив
                if(city_selected == 'Москва') {
                    //console.log('checked');
                    if($('#v21_autoDelivery').is(':checked')) {
                        $('.js-block-delivery-address').fadeOut(50);
                        $('.js-block-pickup-office').fadeIn(50);
                        $('input[name="DELIVERY_ADDRESS"]').val($('select[name="DELIVERY_ADDRESS"]').val());
                    }
                    if($('#v21_moscowDelivery').is(':checked')) {
                        $('.js-block-pickup-office').fadeOut(50);
                        //$('.js-block-delivery-address').children('.v21-input-group').prepend($('<input type="text" name="DELIVERY_ADDRESS" class="v21-input-group__field v21-field" placeholder="Адрес доставки" value="'+address_value+'">'));
                        $('.js-block-delivery-address').fadeIn(50);
                        //console.log('checked #v21_moscowDelivery');
                    }
                    $('.js-block-delivery').fadeIn(400);
                } else if(city_selected == not_selected) {
                    //$('input[name="DELIVERY"]').val('Заберу сам');
                    $('#orderCard').append($('<input type="hidden" name="DELIVERY" value="'+'Заберу в офисе'+'">'));
                    $('input[name="DELIVERY_ADDRESS"]').val(not_selected);
                } else {
                    ar_offices.forEach(function (entry) {
                        if(entry.CITY == city_selected) {
                            //console.log(entry.ADDRESS);
                            $('.js-office-header').text('Забрать карту можно');
                            $('.js-office-address').text(entry.ADDRESS);

                            //$('input[name="DELIVERY"]').val('Заберу сам');
                            $('input[name="DELIVERY_ADDRESS"]').val(entry.ADDRESS);
                        }
                    });
                    $('#orderCard').append($('<input type="hidden" name="DELIVERY" value="'+'Заберу в офисе'+'">'));
                    $('.js-block-pickup-address').fadeIn(50);
                }
            }
        });

        $('#v21_autoDelivery').click(function () {
            //console.log('radio v21_autoDelivery');
            $('.js-block-delivery-address').fadeOut(50);
            $('.js-block-pickup-office').fadeIn(400);
        });
        $('#v21_moscowDelivery').click(function () {
            //console.log('radio v21_moscowDelivery');
            $('.js-block-pickup-office').fadeOut(50);
            $('.js-block-delivery-address').fadeIn(400);
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
                'DETAIL_PAGE_URL': '/corporative-clients/bankovskoe-obsluzhivanie/scheta-dlya-biznesa/',
                'QUANTITY': 1,
                'XML_ID': 'xml'
            };
            let postTemplateID = <?= $postTemplateID; ?>
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