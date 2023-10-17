<?
/**
 * @var $result
 */

use Inkass\Service\General;

\Bitrix\Main\UI\Extension::load('calendar');
CJSCore::Init(array("jquery","date"));

$error = !empty($_GET['error']) ? $_GET['error'] : '';
$offices = \Bitrix\Iblock\Elements\ElementOfficesTable::getList([
    'select' => ['ID', 'NAME', 'ATT_TYPE', 'ATT_ADDRESS_CITY', 'ATT_ADDRESS', 'ATT_INKASS', 'ATT_NAME_WHERE'],
    //'select' => [],
    'order' => ['SORT' => 'ASC'],
    'filter' => [
        '=ACTIVE' => 'Y',
        '=IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_TYPE_VALUE' => 42, // офисы, не банкоматы
        '=IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_INKASS_VALUE' => 157 // инкассация = Да
    ],
])->fetchAll();
array_unshift($offices, ['NAME'=>'Дополнительный офис', 'IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_NAME_WHERE_VALUE'=>'Дополнительный офис', 'SORT'=>0]);
//debugg($offices);
foreach ($offices as $ix=>$office) {
    $officesList[$ix]['name'] = $office['IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_NAME_WHERE_VALUE'];
}

$arOffices = [];
$ii = 0;
foreach ($offices as $office) {
    //debugg($office);
    if (!empty($office['ID'])) {
        $arOffices[$office['ID']]['name'] = $office['IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_NAME_WHERE_VALUE'];
        $arOffices[$office['ID']]['city'] = $office['IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_ADDRESS_CITY_VALUE'];
        $arOffices[$office['ID']]['address'] = $office['IBLOCK_ELEMENTS_ELEMENT_OFFICES_ATT_ADDRESS_VALUE'];
        $ii += 1;
    }
}
//debugg($arOffices);
$arQuestionsList = General::get_questions_list();
//debugg($arQuestionsList);
?>
<h2 class="vs-orders__title">Чек-лист</h2>
<h4 class="vs-orders__subtitle">контроля работы операциониста – кассира АКБ «Трансстройбанк» инкассаторами при нахождении в ДО</h4>
<div class="vs-order__wrapper">
    <? if (!empty($error)): ?>
        <div class="vs-form__field vs-form__error"><?= $error ?></div>
    <? endif; ?>
    <? $current_date = new DateTime(); ?>
    <form class="vs-order__block vs-form" action="" method="post" id="check-list-form">
        <input type="hidden" name="city_info" value='<?= json_encode($arOffices) ?>'>
        <div class="vs-form__field">

            <div class="vs-form__field <?= (!empty($error))? 'vs-form__error' : ''; ?>">
                <?/*?><div class="vs-form__label">Время начала проверки</div><?*/?>
                <div class="vs-form__row js-vs-form__warn">
                    <input
                            type="text"
                            name="check_start_time"
                            class="vs-input vs-form__input mask-time"
                            <?/*?>value="<?= $current_date->format("d.m.Y") ?>"<?*/?>
                            placeholder="Время начала проверки"
                        <?/*?>value="<?= !empty($result['data']['check_start_time']) ? $result['data']['check_start_time'] : '' ?>"<?*/?>
                    >
                    <span class="vs-form__arrow"></span>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
            </div>

            <div class="vs-form__field <?= (!empty($error))? 'vs-form__error' : ''; ?>">
                <?/*?><div class="vs-form__label">Время окончания проверки</div><?*/?>
                <div class="vs-form__row js-vs-form__warn">
                    <input
                            type="text"
                            name="check_finish_time"
                            class="vs-input vs-form__input mask-time"
                            <?/*?>value="<?= $current_date->format("d.m.Y") ?>"<?*/?>
                            placeholder="Время окончания проверки"
                    >
                    <span class="vs-form__arrow"></span>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
            </div>

            <div class="vs-form__field <?= (!empty($error))? 'vs-form__error' : ''; ?>">
                <?/*?><div class="vs-form__label">Дополнительный офис</div><?*/?>
                <div class="vs-form__row js-vs-form__warn">
                    <select name="check_office" id="check_office_id" class="vs-input vs-form__input" placeholder="Дополнительный офис">
                        <? foreach ($officesList as $key => $office) {
                            ?>
                            <option value="<?=$office["name"]?>" <?//=$selected?>><?=$office["name"]?></option>
                        <? } ?>
                    </select>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
            </div>

            <div class="vs-form__field <?= (!empty($error))? 'vs-form__error' : ''; ?>">
                <?/*?><div class="vs-form__label">ФИО кассира</div><?*/?>
                <div class="vs-form__row js-vs-form__warn">
                    <input
                            type="text"
                            name="check_fio"
                            class="vs-input vs-form__input"
                            placeholder="ФИО кассира"
                            value="<?= !empty($result['data']['check_fio']) ? $result['data']['check_fio'] : '' ?>"
                    >
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
            </div>

            <div class="vs-form__field <?= (!empty($error))? 'vs-form__error' : ''; ?>">
                <?/*?><div class="vs-form__label">Дата проверки</div><?*/?>
                <div class="vs-form__row js-vs-form__warn">
                    <input
                            type="text"
                        <?/*?>value="<?= $current_date->format("d.m.Y") ?>"<?*/?>
                            name="check_date"
                            class="vs-input vs-form__input"
                            placeholder="Дата проверки"
                        <?/*?>onclick="BX.calendar({node: this, field: this, bTime: true, callback:date_changed()});"<?*/?>
                            onclick="BX.calendar({node: this, field: this, bTime: true});"
                    >
                    <span class="vs-form__arrow" onclick="BX.calendar({node: this, field: 'check_finish_time', bTime: true, bHideTime: false});"></span>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
            </div>

            <h3 class="vs-orders__doptitle">Проверяемые вопросы</h3>

            <div class="vs-form__label"><?= $arQuestionsList[0] ?></div>
            <div class="vs-form__row vs-form__row_flex">
                <div class="vs-form__radio js-vs-form__warn">
                    <label for="type_question_1_yes" class="vs-form__radio-label">
                        <span>Да</span>
                        <input
                                type="radio"
                                name="check_question_1"
                                value="Да"
                                id="type_question_1_yes"
                        >
                    </labeL>
                    <label for="type_question_1_no" class="vs-form__radio-label">
                        <input
                                type="radio"
                                name="check_question_1"
                                value="Нет"
                                id="type_question_1_no"
                        >
                        <span>Нет</span>
                    </labeL>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
                <div class="vs-form__comment">
                    <textarea rows="1"
                              name="check_question_1_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data']['check_question_1_comment']) ? $result['data']['check_question_1_comment'] : '' ?></textarea>
                </div>
            </div>

            <div class="vs-form__label"><?= $arQuestionsList[1] ?></div>
            <div class="vs-form__row vs-form__row_flex">
                <div class="vs-form__radio js-vs-form__warn">
                    <label for="type_question_2_yes" class="vs-form__radio-label">
                        <span>Да</span>
                        <input
                                type="radio"
                                name="check_question_2"
                                value="Да"
                                id="type_question_2_yes"
                        >
                    </labeL>
                    <label for="type_question_2_no" class="vs-form__radio-label">
                        <input
                                type="radio"
                                name="check_question_2"
                                value="Нет"
                                id="type_question_2_no"
                        >
                        <span>Нет</span>
                    </labeL>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
                <div class="vs-form__comment">
                    <textarea rows="1"
                              name="check_question_2_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data']['check_question_2_comment']) ? $result['data']['check_question_2_comment'] : '' ?></textarea>
                </div>
            </div>

            <div class="vs-form__label"><?= $arQuestionsList[2] ?></div>
            <div class="vs-form__row vs-form__row_flex">
                <div class="vs-form__radio js-vs-form__warn">
                    <label for="type_question_3_yes" class="vs-form__radio-label">
                        <span>Да</span>
                        <input
                                type="radio"
                                name="check_question_3"
                                value="Да"
                                id="type_question_3_yes"
                        >
                    </labeL>
                    <label for="type_question_3_no" class="vs-form__radio-label">
                        <input
                                type="radio"
                                name="check_question_3"
                                value="Нет"
                                id="type_question_3_no"
                        >
                        <span>Нет</span>
                    </labeL>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
                <div class="vs-form__comment">
                    <textarea rows="1"
                              name="check_question_3_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data']['check_question_3_comment']) ? $result['data']['check_question_3_comment'] : '' ?></textarea>
                </div>
            </div>

            <div class="vs-form__label"><?= $arQuestionsList[3] ?></div>
            <div class="vs-form__row vs-form__row_flex">
                <div class="vs-form__radio js-vs-form__warn">
                    <label for="type_question_4_yes" class="vs-form__radio-label">
                        <span>Да</span>
                        <input
                                type="radio"
                                name="check_question_4"
                                value="Да"
                                id="type_question_4_yes"
                        >
                    </labeL>
                    <label for="type_question_4_no" class="vs-form__radio-label">
                        <input
                                type="radio"
                                name="check_question_4"
                                value="Нет"
                                id="type_question_4_no"
                        >
                        <span>Нет</span>
                    </labeL>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
                <div class="vs-form__comment">
                    <textarea rows="1"
                              name="check_question_4_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data']['check_question_4_comment']) ? $result['data']['check_question_4_comment'] : '' ?></textarea>
                </div>
            </div>

            <div class="vs-form__label"><?= $arQuestionsList[4] ?></div>
            <div class="vs-form__row vs-form__row_flex">
                <div class="vs-form__radio js-vs-form__warn">
                    <label for="type_question_4_yes" class="vs-form__radio-label">
                        <span>Да</span>
                        <input
                                type="radio"
                                name="check_question_5"
                                value="Да"
                                id="type_question_5_yes"
                        >
                    </labeL>
                    <label for="type_question_5_no" class="vs-form__radio-label">
                        <input
                                type="radio"
                                name="check_question_5"
                                value="Нет"
                                id="type_question_5_no"
                        >
                        <span>Нет</span>
                    </labeL>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
                <div class="vs-form__comment">
                    <textarea rows="1"
                              name="check_question_5_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data']['check_question_5_comment']) ? $result['data']['check_question_5_comment'] : '' ?></textarea>
                </div>
            </div>

            <div class="vs-form__label"><?= $arQuestionsList[5] ?></div>
            <div class="vs-form__row vs-form__row_flex">
                <div class="vs-form__radio js-vs-form__warn">
                    <label for="type_question_6_yes" class="vs-form__radio-label">
                        <span>Да</span>
                        <input
                                type="radio"
                                name="check_question_6"
                                value="Да"
                                id="type_question_6_yes"
                        >
                    </labeL>
                    <label for="type_question_6_no" class="vs-form__radio-label">
                        <input
                                type="radio"
                                name="check_question_6"
                                value="Нет"
                                id="type_question_6_no"
                        >
                        <span>Нет</span>
                    </labeL>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
                <div class="vs-form__comment">
                    <textarea rows="1"
                              name="check_question_6_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data']['check_question_6_comment']) ? $result['data']['check_question_6_comment'] : '' ?></textarea>
                </div>
            </div>

            <div class="vs-form__label"><?= $arQuestionsList[6] ?></div>
            <div class="vs-form__row vs-form__row_flex">
                <div class="vs-form__radio js-vs-form__warn">
                    <label for="type_question_7_yes" class="vs-form__radio-label">
                        <span>Да</span>
                        <input
                                type="radio"
                                name="check_question_7"
                                value="Да"
                                id="type_question_7_yes"
                        >
                    </labeL>
                    <label for="type_question_7_no" class="vs-form__radio-label">
                        <input
                                type="radio"
                                name="check_question_7"
                                value="Нет"
                                id="type_question_7_no"
                        >
                        <span>Нет</span>
                    </labeL>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
                <div class="vs-form__comment">
                    <textarea rows="1"
                              name="check_question_7_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data']['check_question_7_comment']) ? $result['data']['check_question_7_comment'] : '' ?></textarea>
                </div>
            </div>

            <div class="vs-form__label"><?= $arQuestionsList[7] ?></div>
            <div class="vs-form__row vs-form__row_flex">
                <div class="vs-form__radio js-vs-form__warn">
                    <label for="type_question_8_yes" class="vs-form__radio-label">
                        <span>Да</span>
                        <input
                                type="radio"
                                name="check_question_8"
                                value="Да"
                                id="type_question_8_yes"
                        >
                    </labeL>
                    <label for="type_question_8_no" class="vs-form__radio-label">
                        <input
                                type="radio"
                                name="check_question_8"
                                value="Нет"
                                id="type_question_8_no"
                        >
                        <span>Нет</span>
                    </labeL>
                    <span class="vs-form__warn">Обязательное поле к заполнению</span>
                </div>
                <div class="vs-form__comment">
                    <textarea rows="1"
                              name="check_question_8_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data']['check_question_8_comment']) ? $result['data']['check_question_8_comment'] : '' ?></textarea>
                </div>
            </div>

            <div class="vs-form__comment vs-form__dop-comment">
                    <textarea rows="5"
                              name="check_dop_comment"
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Дополнительные замечания"
                              ><?= ($result['data']['check_dop_comment']) ? $result['data']['check_dop_comment'] : '' ?></textarea>
            </div>
        </div>
        <? if (!empty($result['error'])): ?>
            <div class="vs-form__field vs-form__error"><?= $result['error'] ?></div>
        <? endif; ?>
        <?/*?><input type="hidden" name="action" value="create_order"><?*/?>
        <input type="hidden" name="action" value="create_check">

        <div class="vs-form__field vs-form__field--button">
            <button class="vs-button vs-form__button">Отправить</button>
        </div>
    </form>
</div>

<script>
    // https://dev.1c-bitrix.ru/api_help/js_lib/data/calendar.php
    // https://bazarow.ru/forum/forum11/548-krasivyy-kalendar-dlya-formy-vvoda-daty-v-input
    /*function date_changed(selected_date) {
        //current date
        var curday = new Date();
        var dd = String(curday.getDate()).padStart(2, '0');
        var mm = String(curday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = curday.getFullYear();
        curday = dd + '/' + mm + '/' + yyyy;
        //selected date
        var today = new Date(selected_date);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = dd + '/' + mm + '/' + yyyy;
        if(curday==today) {
            console.log('date_changed');
            console.log(curday, today);
        }
    }*/
</script>