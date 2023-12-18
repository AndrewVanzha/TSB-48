<?
// https://bazarow.ru/blog-note/14128/
// https://nikaverro.ru/blog/bitrix/sale-order-bitrix-api-d7/
// https://burlaka.studio/lab/order_basket_and_so_so/
// https://maxyss.ru/blog/Work_code/zakaz-na-d7-poluchit-polya-izmenit-polya-sokhranit/
// https://know-online.com/post/bitrix-order

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
$APPLICATION->SetTitle("Генератор отчета по категории Формы на сайте");
CJSCore::Init(array("jquery"));
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Debugg\Oop\Dvlp;

Loader::includeModule('iblock');
$reportFile = '/reports/forms-report/report.xls';
?>
<?
//Dvlp::debugg($_POST);
$has_checkbox = false;
$iblockID_list = [];
foreach ($_POST as $key=>$item) {
    if (stripos($key, 'CHECKBOX_') !== false) { // список выбранных инфоблоков-форм
        $has_checkbox = true;
        if ($item == 'on') {
            $iblockID_list[] = str_replace('CHECKBOX_', '', $key);
        }
    }
}
if (!$has_checkbox) {
    ?>
        <p><b>Не выбраны формы</b></p>
        <a href="admin_step.php" class="adm-btn adm-btn-save">Создать новый отчет</a>
    <?php
} else {
    //Dvlp::debugg($iblockID_list);
    print_r('Обработаны формы:' . '<br>');
    foreach ($iblockID_list as $value) {
        print_r($value . '<br>');
    }
    if (isset($_POST['dateFrom'])) {
        $dateFrom = $_POST['dateFrom'];
    } else {
        $objDateTime = new DateTime("2023-01-01 00:00:00", "Y-m-d H:i:s");
        $dateFrom = $objDateTime->format('d.m.Y');
    }
    $arFormElements = [];
    $props = CIBlockElement::GetList (
        Array("IBLOCK_ID" => "ASC"),
        Array("IBLOCK_ID" => $iblockID_list, '>=DATE_CREATE' => $dateFrom),
        false,
        false,
        Array('IBLOCK_ID', 'ID', 'NAME', 'DATE_CREATE', 'IBLOCK_NAME'),
    );
    while ($ar_fields = $props->GetNextElement()) {
        $ar_props = [];
        $ar_element = $ar_fields->GetFields();
        $ar_get_prop = $ar_fields->GetProperties();
        foreach ($ar_get_prop as $key=>$property) {
            $ar_props[$key]['ID'] = $property['ID'];
            $ar_props[$key]['IBLOCK_ID'] = $property['IBLOCK_ID'];
            $ar_props[$key]['NAME'] = $property['NAME'];
            $ar_props[$key]['VALUE'] = $property['VALUE'];
        }
        $ar_element['PROPERTIES'] = $ar_props;
        $arFormElements[] = $ar_element;
        unset($ar_props);
    }
    //Dvlp::debugg($arFormElements);

    $arResultList = [];
    for ($ii=0; $ii<count($iblockID_list); $ii++) {
        foreach ($arFormElements as $item) {
            if ($iblockID_list[$ii] == $item['IBLOCK_ID']) {
                $i_block_list['IBLOCK_ID'] = $item['IBLOCK_ID'];
                $i_block_list['ID'] = $item['ID'];
                $i_block_list['DATE_CREATE'] = $item['DATE_CREATE'];
                $i_block_list['NAME'] = $item['NAME'];
                $i_block_list['IBLOCK_NAME'] = $item['IBLOCK_NAME'];
                $i_block_list['PROPERTIES'] = $item['PROPERTIES'];
                $arResultList[$item['IBLOCK_ID']][] = $i_block_list;
            }
        }
    }
    //Dvlp::debugg($arResultList);
    //file_put_contents("/home/bitrix/www".'/logs/a_$arResultList.json', json_encode($arResultList));
    Dvlp::logger('arResultList', $arResultList);

    //header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    //header("Content-Disposition: attachment;filename=".date("d-m-Y")."-export.xls");
    //header("Content-Transfer-Encoding: binary ");
    $fileHeader = '<!DOCTYPE html>
   <html class="bx-core bx-win bx-no-touch bx-no-retina bx-chrome bx-boxshadow bx-borderradius bx-flexwrap bx-boxdirection bx-transition bx-transform">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="TSB" content="report" />
		<title>Report</title>
        <style>
            td {
                mso-number-format: \@;
            }
            .number0 {
                mso-number-format: 0;
            }
            .number2 {
                mso-number-format: Fixed;
            }
        </style>
	</head>
	<body>';

    // формирую вывод в excel-таблицу
    $fileBody = '';
    foreach ($arResultList as $key=>$arForm) {
        $fileBody .= '<h2>' . $arForm[0]['IBLOCK_NAME'] . ' (' . $key . ')</h2>';
        $fileBody .= '<table border="1">';
        $fileBody .= '<tr>';
        $fileBody .= '<th>№</th>';
        $fileBody .= '<th>Актор</th>';
        $fileBody .= '<th>Дата</th>';
        foreach ($arForm[0]['PROPERTIES'] as $prop) {
            $fileBody .= '<th>' . $prop['NAME'] . '</th>';
        }
        $fileBody .= '</tr>';
        foreach ($arForm as $zayavka) {
            $fileBody .= '<tr>';
            $fileBody .= '<td>' . $zayavka['ID'] . '</td>';
            $fileBody .= '<td>' . $zayavka['NAME'] . '</td>';
            $fileBody .= '<td>' . $zayavka['DATE_CREATE'] . '</td>';
            foreach ($zayavka['PROPERTIES'] as $prop) {
                $fileBody .= '<td>' . $prop['VALUE'] . '</td>';
            }
            $fileBody .= '</tr>';
        }
        $fileBody .= '</table>';
    }

    $fileFooter = '</body></html>';

    try {
        $vtfile = file_put_contents($_SERVER["DOCUMENT_ROOT"] . $reportFile, $fileHeader . $fileBody . $fileFooter);
    }  catch (Exception $e) {
        Dvlp::logger('report-error', $e->getMessage()); //
    }
    print_r('Записано ' . $vtfile . '<br>' . '<br>');
    ?>
    <a href="<?=$reportFile?>" class="adm-btn adm-btn-save" >Скачать отчет</a>
    <a href="admin_step.php" class="adm-btn adm-btn-save">Создать новый отчет</a>
    <?php
}
require($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_admin.php"); ?>