<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
$APPLICATION->SetTitle("Генератор отчета по категории Формы на сайте");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

//use Bitrix\Main\Page\Asset;
use Bitrix\Main\Type\DateTime;
use Debugg\Oop\My;

CJSCore::Init(array("jquery"));
//Asset::getInstance()->addCss("/reports/forms-report/style.css");
\Bitrix\Main\Loader::includeModule('iblock');
?>
<?php
//My::debugg($_POST);
$iBlockList = [];
$arFilter = ['SITE_ID'=>'s1', 'ACTIVE'=>'Y', 'CNT_ACTIVE'=>'Y', 'TYPE'=>'feedback'];
$res = CIBlock::GetList(
    Array('NAME'=>'ASC'),
    $arFilter,
    true
);
while($ar_res = $res->Fetch())  {
    $i_block_list['ID'] = $ar_res['ID'];
    $i_block_list['NAME'] = $ar_res['NAME'];
    $iBlockList[] = $i_block_list;
}
if (!empty($_POST['dateFrom'])) {
    $dateFrom = $_POST['dateFrom'];
    if (empty($_POST['dateTo'])) {
        $objDateTime = new DateTime();
        $dateTo = $objDateTime->format('d.m.Y');
    } else {
        $dateTo = $_POST['dateTo'];
    }
} else {
    $objDateTime = new DateTime("2023-01-01 00:00:00", "Y-m-d H:i:s");
    $dateFrom = $objDateTime->format('d.m.Y');
    if (empty($_POST['dateTo'])) {
        $objDateTime = new DateTime();
        $dateTo = $objDateTime->format('d.m.Y');
    } else {
        $dateTo = $_POST['dateTo'];
    }
}
//My::debugg($dateFrom);
//My::debugg($dateTo);

$arFormElements = [];
$iblockID_list = [];
foreach ($iBlockList as $item) {
    $iblockID_list[] = $item['ID'];
}
//My::debugg($iblockID_list);
$elements = CIBlockElement::GetList (
    Array("IBLOCK_ID" => "ASC"),
    Array("IBLOCK_ID" => $iblockID_list, '>=DATE_CREATE' => $dateFrom),
    false,
    false,
    Array('IBLOCK_ID', 'ID', 'NAME', 'DATE_CREATE_UNIX', 'IBLOCK_NAME'),
);
while ($ar_fields = $elements->GetNext()) {
    $arFormElements[] = $ar_fields;
}
//My::debugg($arFormElements);

$arBlockList = [];
for ($ii=0; $ii<count($iblockID_list); $ii++) {
    foreach ($arFormElements as $item) {
        if ($iblockID_list[$ii] == $item['IBLOCK_ID']) {
            $i_block_list['ID'] = $item['IBLOCK_ID'];
            $i_block_list['DATE_CREATE'] = $item['DATE_CREATE_UNIX'];
            $i_block_list['NAME'] = $item['IBLOCK_NAME'];
            $arBlockList[$item['IBLOCK_ID']][] = $i_block_list;
        }
    }
}
//My::debugg($arBlockList);
unset($iBlockList);
$iBlockList = [];
$ii = 0;
$iBlockList_mdfd = [];
foreach ($arBlockList as $item) {
    $iBlockList[$ii]['ID'] = $item[0]['ID'];
    $iBlockList[$ii]['NAME'] = $item[0]['NAME'];
    $iBlockList[$ii]['ELEMENT_CNT'] = count($item);
    $ii += 1;
}
//My::debugg($iBlockList);
?>
<style>
    .adm-block-wrapper .iblock-table--header {
        height: 35px;
        padding: 7px 0;
    }
    .adm-block-wrapper .iblock-table--body-row {
        height: 30px;
        padding: 5px 0;
    }
    .adm-block-wrapper .iblock-table--head-cell,
    .adm-block-wrapper .iblock-table--body-cell {
        border-bottom: 1px #eef2f4 solid;
    }
    .adm-block-wrapper .iblock-table--head__input,
    .adm-block-wrapper .iblock-table--body__input {
        cursor: pointer;
    }
    .adm-block-wrapper .iblock-table--body-cell__name {
        padding-left: 5px;
        text-align: left;
    }
</style>
<div class="adm-block-wrapper">
    <form action="admin_step.php" method="post" style="margin-bottom: 15px;" id="period-form">
        <input type="hidden" name="CHECK_PERIOD" value="Y">
        <input type="text" placeholder="Дата с"
               onclick="BX.calendar({node: this, field: this, bTime: false});"
               name="dateFrom" class="period-form-input"
               <? if (isset($_POST['dateFrom'])) { ?>value="<?=$_POST['dateFrom']?>"<? } ?>
        >
        <input type="text" placeholder="Дата по"
               onclick="BX.calendar({node: this, field: this, bTime: false});"
               name="dateTo" class="period-form-input"
               <? if (isset($dateTo)) { ?>value="<?=$dateTo?>"<? } ?>
        >
        <button type="submit" class="adm-btn adm-btn-save" name="ADMIN_STEP">Задать период наблюдения</button>
        <button type="button" class="adm-btn adm-btn-save" onclick="$('#period-form .period-form-input').val('');">Сбросить</button>
    </form>
    <? if (isset($dateFrom)) { ?><p>Начиная с <?=$dateFrom?></p><? } ?>

    <form action="report_step.php" method="post" style="margin-bottom: 15px;" id="report-form">
        <input type="hidden" name="CHECK_BLOCKS" value="Y">
        <input type="hidden" name="dateFrom" <? if (isset($_POST['dateFrom'])) { ?>value="<?=$_POST['dateFrom']?>"<? } ?>>
        <input type="hidden" name="dateTo" <? if (isset($_POST['dateTo'])) { ?>value="<?=$_POST['dateTo']?>"<? } ?>>
        <div class="iblock-list--wrapper">
            <table class="iblock-list--table">
                <thead class="iblock-table--header">
                <tr class="iblock-table--head-row">
                    <th class="iblock-table--head-cell">
                        <span class="iblock-table--head-cell__container">
                            <input class="iblock-table--head__input" type="checkbox" title="Отметить все/снять отметку у всех">
                            <label class="iblock-table--head__label"></label>
                        </span>
                    </th>
                    <th class="iblock-table--head-cell">
                        <span class="iblock-table--head-cell__container">Название</span>
                    </th>
                    <th class="iblock-table--head-cell">
                        <span class="iblock-table--head-cell__container">Элементов</span>
                    </th>
                    <th class="iblock-table--head-cell">
                        <span class="iblock-table--head-cell__container">ID</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                    <? foreach ($iBlockList as $item) : ?>
                        <tr class="iblock-table--body-row">
                            <th class="iblock-table--body-cell">
                                <span class="iblock-table--body-cell__container">
                                    <input class="iblock-table--body__input iblock-table--body__checkbox" name="CHECKBOX_<?= $item['ID'] ?>" type="checkbox" title="Отметить/снять отметку">
                                    <label class="iblock-table--body__label"></label>
                                </span>
                            </th>
                            <th class="iblock-table--body-cell iblock-table--body-cell__name">
                                <span class="iblock-table--body-cell__container"><?= $item['NAME'] ?></span>
                            </th>
                            <th class="iblock-table--body-cell">
                                <span class="iblock-table--body-cell__container"><?= $item['ELEMENT_CNT'] ?></span>
                            </th>
                            <th class="iblock-table--body-cell">
                                <span class="iblock-table--body-cell__container"><?= $item['ID'] ?></span>
                            </th>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>
        <button type="submit" class="adm-btn adm-btn-save" name="REPORT_STEP">Создать отчет</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        let flag = true;
        let checkboxes = document.querySelectorAll('.iblock-table--body__checkbox');
        $('.iblock-table--head__input').on('click', function () { // ставить/снимать все check
            if(flag) {
                checkboxes.forEach(function (value) {
                    $(value).prop('checked', true);
                });
                flag = false;
            } else {
                checkboxes.forEach(function (value) {
                    $(value).prop('checked', false);
                });
                flag = true;
            }
        });
    });
</script>
<?php
//My::debugg($iBlockList);
?>
<?
require($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_admin.php"); ?>
