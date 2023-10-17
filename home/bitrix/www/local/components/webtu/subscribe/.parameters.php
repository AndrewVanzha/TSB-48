<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

if(!CModule::IncludeModule("subscribe")) {
    return;
}

$subscriptionsPre = CRubric::GetList(array(), array());
$subscriptions = array();

while ($subscription = $subscriptionsPre->Fetch()) {
    $subscriptions[$subscription['ID']] = $subscription['NAME'];
}

$arComponentParameters = array(
    "PARAMETERS" => array(
        "AJAX_MODE" => array(),
        "RUBRIC" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Подписки",
            "TYPE" => "LIST",
            "VALUES" => $subscriptions,
            "REFRESH" => "Y",
            "MULTIPLE" => "Y",
        ),
    ),
);
