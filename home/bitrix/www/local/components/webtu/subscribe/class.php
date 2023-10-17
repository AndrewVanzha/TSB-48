<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

IncludeTemplateLangFile(__FILE__);

class WebtuSubscribe extends CBitrixComponent
{
    public $errors  = array();
    public $success = array();
    
    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        global $USER;
        
        CModule::IncludeModule('subscribe');
        
        if (isset($_POST['WEBTU_SUBSCRIBE'])) {

            if(!is_array($this->arParams['RUBRIC']) || empty($this->arParams['RUBRIC'])) {
                $this->addError(GetMessage("WEBTU_SUBSCRIBE_ERROR_NO_RUBRIC"));
            } else {
                $userId = $USER->IsAuthorized() ? $USER->GetID() : false;
                $arFields = Array(
                    "USER_ID" => $userId,
                    "FORMAT"  => "text",
                    "EMAIL"   => $_POST['EMAIL'],
                    "ACTIVE"  => "Y",
                    "RUB_ID"  => $this->arParams['RUBRIC'],
                );
                
                $subscription = new CSubscription();
                
                $subscriptionId = $subscription->Add($arFields);
                
                if($subscriptionId > 0) {
                    $this->addSuccess('Вы подписаны на рассылку');
                } else {
                    $this->addError($subscription->LAST_ERROR);
                }
            }
        }
        
        $this->arResult['ERRORS']  = $this->getErrors();
        $this->arResult['SUCCESS'] = $this->getSuccess();

        $this->includeComponentTemplate();
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addSuccess($success)
    {
        $this->success[] = $success;
    }

    public function getSuccess()
    {
        return $this->success;
    }
}