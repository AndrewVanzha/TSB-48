<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?php
$cityCode = \GarbageStorage::get('OfficeId');
$currencyCode = htmlspecialchars($_GET['currency']);
?>
<?
$result = $APPLICATION->IncludeComponent(
    "webtu:currency.exchange",
    "table",
    Array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CITY_CODE" => $cityCode,
        "CITIES_IBLOCK_ID" => "114",
        "OFFICE_IBLOCK_ID" => "115",
        "CURRENCY" => $currencyCode,
    )
);

echo 'currency.exchange.result';
echo json_encode($result);