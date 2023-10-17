<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
    foreach ($arResult['CUR'] as $key => $arCur){
        if($key == "CNY") {
            $arResult['CUR'][$key][0] = "CNY Ұ <sup>2</sup>";
        }
    }
    $file = $_SERVER['DOCUMENT_ROOT']."/currency/cur.csv";
    $fileModify = filectime($file);
    $arResult['MODIFY_DATE_FILE'] = $fileModify;