<?php
use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;

require_once ($_SERVER['DOCUMENT_ROOT']."/local/php_interface/functions.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/local/php_interface/events.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/local/php_interface/UpdateMetal/UpdateMetal.php");

function route($name) {
    $routes = array(
        'user-politics' => '/politics/'    
    );
    
    return $routes[$name];
}

function loadKursTSB(){
	CBitrixComponent::includeComponentClass("webtu:synch.currency");

    //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/a_init.json', json_encode('init works'));

	$kurs = new SynchCurrency(); // выдается ошибка несоответствия числа аргументов
	$kurs->updateCourses();
	
	return "loadKursTSB();";
}

function loadKursMetal(){

	$metal = new UpdateMetal();
	$metal->updateMetal();

	return "loadKursMetal();";
}

function loadTest(){
	CBitrixComponent::includeComponentClass("webtu:synch.currency");

	$kurs = new SynchCurrency(); // выдается ошибка несоответствия числа аргументов
	$kurs->updateTest();

	return "loadTest();";
}

function collectUTM(){
    CBitrixComponent::includeComponentClass("webtu:feedback");

    $utm = new WebtuFeedback();
    $utm->collectUTMstatus();

    return "collectUTM();";
}

//Данные для текущего города
if (Loader::includeModule('iblock')){
	session_start();
    $citySes = ($_SESSION['city']) ? $_SESSION['city'] : 399;
    $rsList = CIBlockElement::GetList(
        Array("SORT"=>"ASC"),
        Array("IBLOCK_ID"=>114, "ID"=>$citySes),
        false,
        false,
        Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_ENGLISH", "PROPERTY_ATT_PHONE_1", "PROPERTY_ATT_PHONE_2", "PROPERTY_ATT_EMAIL_1", "PROPERTY_ATT_EMAIL_2", "PROPERTY_ATT_ADDRESS", "PROPERTY_ATT_ADDRESS_ENGLISH", "PROPERTY_ATT_TIME", "PROPERTY_ATT_TIME_ENGLISH", "PROPERTY_ATT_WHERE")
    );
    while($arList = $rsList->Fetch()){
        \GarbageStorage::set('name', $arList['NAME']);
        \GarbageStorage::set('nameWhere', $arList['PROPERTY_ATT_WHERE_VALUE'] ?? $arList['NAME']);
        \GarbageStorage::set('english_name', $arList['PROPERTY_ATT_ENGLISH_VALUE']);
    	\GarbageStorage::set('phone_1', $arList['PROPERTY_ATT_PHONE_1_VALUE']); 
    	\GarbageStorage::set('phone_2', $arList['PROPERTY_ATT_PHONE_2_VALUE']); 
    	\GarbageStorage::set('email_1', $arList['PROPERTY_ATT_EMAIL_1_VALUE']); 
    	\GarbageStorage::set('email_2', $arList['PROPERTY_ATT_EMAIL_2_VALUE']);
    	\GarbageStorage::set('address', $arList['PROPERTY_ATT_ADDRESS_VALUE']);
        \GarbageStorage::set('english_address', $arList['PROPERTY_ATT_ADDRESS_ENGLISH_VALUE']);
    	\GarbageStorage::set('time', $arList['PROPERTY_ATT_TIME_VALUE']);
        \GarbageStorage::set('english_time', $arList['PROPERTY_ATT_TIME_ENGLISH_VALUE']);
    }
}

function debugg($data) 
{
	global $USER;
	if($USER->GetID() == 107) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

