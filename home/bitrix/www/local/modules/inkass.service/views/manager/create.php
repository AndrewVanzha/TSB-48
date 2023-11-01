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
$ar_questions = General::get_questions_list();
$arQuestionsLimit = 10;  //                            максимум записей в БД
if (count($ar_questions) > $arQuestionsLimit) {
	for ($ix=0; $ix<$arQuestionsLimit; $ix++) {
		$arQuestionsList[$ix] = $ar_questions[$ix];
	}
}
else {
	$arQuestionsList = $ar_questions;
}
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

            <? for ($ix=0; $ix<count($arQuestionsList); $ix++) { ?>
				<div class="vs-form__label"><?= $arQuestionsList[$ix] ?></div>
				<div class="vs-form__row vs-form__row_flex">
					<div class="vs-form__radio js-vs-form__warn">
						<label for="type_question_<?=$ix+1?>_yes" class="vs-form__radio-label">
							<span>Да</span>
							<input
								type="radio"
                                name="check_question_<?=$ix+1?>"
                                value="Да"
                                id="type_question_<?=$ix+1?>_yes"
							>
						</label>
						<label for="type_question_<?=$ix+1?>_no" class="vs-form__radio-label">
							<input
                                type="radio"
                                name="check_question_<?=$ix+1?>"
                                value="Нет"
                                id="type_question_<?=$ix+1?>_no"
							>
							<span>Нет</span>
						</labeL>
						<span class="vs-form__warn">Обязательное поле к заполнению</span>
					</div>
					<? $q_ask = 'check_question_' . ($ix + 1) . '_ask'; ?>
					<? $q_comment = 'check_question_' . ($ix + 1) . '_comment'; ?>
					<input type="hidden" name="<?=$q_ask?>" value="<?= $arQuestionsList[$ix] ?>">
					<div class="vs-form__comment">
						<textarea rows="1"
                              name=<?=$q_comment?>
                              class="vs-form__comment-textarea <?= $result['text'] ? ' tsb-feedback-form__textarea_error' : '' ?>"
                              placeholder="Комментарий"
                              ><?= ($result['data'][$q_comment]) ? $result['data'][$q_comment] : '' ?></textarea>
					</div>
				</div>
            <? } ?>

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