<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

if(!CModule::IncludeModule("subscribe")) {
    return;
}

$arComponentParameters = array(
    "PARAMETERS" => array(
        "AJAX_MODE" => array(),
    ),
);
