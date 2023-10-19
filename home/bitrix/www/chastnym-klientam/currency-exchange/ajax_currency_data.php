<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?php
$cityCode = \GarbageStorage::get('OfficeId');
$currencyCode = htmlspecialchars($_GET['currency']);
?>
<?
$result = $APPLICATION->IncludeComponent(
    "webtu:currency.exchange",
    "def",
    Array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CITIES_IBLOCK_ID" => "114",
        "CITY_CODE" => $cityCode,
        "CURRENCY" => $currencyCode,
        "OFFICE_IBLOCK_ID" => "115"
    )
);

echo 'currency.exchange.result';
echo json_encode($result);