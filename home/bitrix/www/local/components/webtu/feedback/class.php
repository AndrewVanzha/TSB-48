<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

IncludeTemplateLangFile(__FILE__);

class WebtuFeedback extends CBitrixComponent
{
    public $errors  = array();
    public $success = array();
    public $post    = array();
    public $formsID = ['213','211','206','203','202','143','142','141','41','39','38','36','35','34','33','32','28','27','16','15','14','11','7'];

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function sanitizePost()
    {
        $post = array();

        foreach ($_POST as $key => $item) {
            //$post[$key] = $string;
            if (is_array($item)) {
                foreach ($item as $kk=>$pos) {
                    $post[$key][$kk] = htmlentities($pos, ENT_QUOTES | ENT_HTML401 | ENT_SUBSTITUTE | ENT_DISALLOWED, 'UTF-8', true);
                }
            }
            if (is_string($item)) {
                if ($key == 'PROPERTIES' || $key == 'PARAMS') {
                    $post[$key] = $item;
                } else {
                    $post[$key] = htmlentities($item, ENT_QUOTES | ENT_HTML401 | ENT_SUBSTITUTE | ENT_DISALLOWED, 'UTF-8', true);
                }
            }
        }

        if (isset($this->arParams['POST_CALLBACK'])) {
            if (is_callable($this->arParams['POST_CALLBACK'])) {
                $post = $this->arParams['POST_CALLBACK']($post);
            }
        }

        $this->post = $post;

        return $post;
    }

    public function post()
    {

        global $APPLICATION;

        $post = $this->sanitizePost();
        file_put_contents("/home/bitrix/www".'/logs/a_class_post.json', json_encode($post));

        if ($post['FORM_ID'] !== $this->arResult['FORM_ID']) {
            return false;
        }

        if (!check_bitrix_sessid('SESSION_ID')) {
            return false;
        }

        if (!$APPLICATION->CaptchaCheckCode($post["CAPTCHA_WORD"], $post["CAPTCHA_ID"])) {
            $this->addError(GetMessage("WEBTU_FEEDBACK_WRONG_CAPTCHA"));
            $this->arResult['POST'] = $this->post;

            return false;
        }

        $element = new CIBlockElement;

        $properties = array();
        $propertiesPost = array();

        $propertiesPre = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"]));
        $propertiesList = array();

        while ($property = $propertiesPre->Fetch()) {
            $propertiesList[$property['CODE']] = $property['ID'];
        }

        unset($property);

        foreach ($this->arParams['PROPERTIES'] as $property) {
            if (isset($post[$property])) {
                $properties[$propertiesList[$property]] = $post[$property];
                $propertiesPost[$property] = $post[$property];
            }
        }

        $fields = array(
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"         => $this->arParams['IBLOCK_ID'],
            "PROPERTY_VALUES"   => $properties,
            "ACTIVE"            => "Y",
            "DATE_CREATE"       => date('d.m.Y H:i:s', time()),
        );

        $fields['NAME']         = isset($post['NAME'])         ? $post['NAME']         : 'Новое обращение';
        $fields['PREVIEW_TEXT'] = isset($post['PREVIEW_TEXT']) ? $post['PREVIEW_TEXT'] : '';
        $fields['DETAIL_TEXT']  = isset($post['DETAIL_TEXT'])  ? $post['DETAIL_TEXT']  : '';
        file_put_contents("/home/bitrix/www".'/logs/a_$fields.json', json_encode($fields));

        if (isset($this->arParams['UTM']) && $this->arParams['UTM'] != 'N') {
            $fields['UTM_SOURCE'] = isset($post['UTM_SOURCE'])? $post['UTM_SOURCE'] : 'no_data';
            $fields['UTM_MEDIUM'] = isset($post['UTM_MEDIUM'])? $post['UTM_MEDIUM'] : 'no_data';
            $fields['UTM_CAMPAIGN'] = isset($post['UTM_CAMPAIGN'])? $post['UTM_CAMPAIGN'] : 'no_data';
            $fields['UTM_TERM'] = isset($post['UTM_TERM'])? $post['UTM_TERM'] : 'no_data';
            $fields['UTM_CONTENT'] = isset($post['UTM_CONTENT'])? $post['UTM_CONTENT'] : 'no_data';
            $fields['FORM'] = empty($this->arParams['UTM'])? 'no_data' : $this->arParams['UTM'];
        }

        if ($id = $element->Add($fields)) {
            $this->addSuccess(GetMessage("WEBTU_FEEDBACK_SUCCESS"));

            $postFields = array_merge($fields, $propertiesPost);
            $postFields['APPLICATION_ID'] = $id;
            file_put_contents("/home/bitrix/www".'/logs/a_$postFields.json', json_encode($postFields));

            if (isset($this->arParams['EVENT_CALLBACK'])) {
                if (is_callable($this->arParams['EVENT_CALLBACK'])) {
                    $postFields = $this->arParams['EVENT_CALLBACK']($postFields);
                }
            }

            $this->arResult['POST'] = $this->post;

            $this->arResult["COMMERCE"] = [
                "data" => $postFields,
                "text" => "Заявка успешно отправлена",
                "type" => true,
            ];

            if ($this->arParams['ADMIN_EVENT'] != 'NONE') {
                $jjj = CEvent::Send($this->arParams['ADMIN_EVENT'], $this->arParams['SITES'], $postFields);
                file_put_contents("/home/bitrix/www".'/logs/a_post_result_admin.json', json_encode($jjj));
            }

            if ($this->arParams['USER_EVENT'] != 'NONE') {
                $iii = CEvent::Send($this->arParams['USER_EVENT'], $this->arParams['SITES'], $postFields);
                file_put_contents("/home/bitrix/www".'/logs/a_post_result_user.json', json_encode($iii));
            }

            return $id;
        } else {
            $this->addError($element->LAST_ERROR);
            $this->arResult['POST'] = $this->post;

            $this->arResult["COMMERCE"] = [
                "text" => "Заявка не отправлена",
                "type" => false,
            ];

            return false;
        }
    }

    public function executeComponent()
    {
        global $APPLICATION;

        CModule::IncludeModule('iblock');

        $this->arResult['FORM_ID'] = $this->arParams['AJAX_ID'];

        $this->arResult["COMMERCE"] = [
            "type" => false,
        ];
        if (isset($_POST['WEBTU_FEEDBACK'])) {
            $this->post();
        }

        if ($this->arParams["SHOW_DEBETS_CARDS"] === "Y") {
            $arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE");
            $arFilter = array("IBLOCK_ID" => "21", "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            $res = CIBlockElement::GetList(array("SORT" => "ASC", "NAME" => "ASC"), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $this->arResult['DEBETS_CARDS'][] = $ob->GetFields();
            }
        }

        $this->arResult['ERRORS']  = $this->getErrors();
        $this->arResult['SUCCESS'] = $this->getSuccess();
        $this->arResult['CAPTCHA'] = htmlspecialchars($APPLICATION->CaptchaGetCode());
        //file_put_contents("/home/bitrix/www".'/logs/a_error_class.json', json_encode($this->arResult['ERRORS']));

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

    public function collectUTMstatus()
    {
        //file_put_contents("/home/bitrix/www".'/logs/a_formsID.json', json_encode($this->formsID));

        $now = new DateTime();
        $arPropsIx = [ // для фильтрации массива свойств - там много лишнего
            'ID' => '',
            //'TIMESTAMP_X' => '',
            'NAME' => '',
            'CODE' => '',
            'VALUE' => '',
        ];

        $arResult["UTM"] = [];
        $arSelect = [
            "ID",
            "IBLOCK_ID",
            "NAME",
            "DATE_CREATE",
            "PROPERTY_UTM_SOURCE",
            "PROPERTY_UTM_MEDIUM",
            "PROPERTY_UTM_CAMPAIGN",
            "PROPERTY_UTM_TERM",
            "PROPERTY_UTM_CONTENT",
            "PROPERTY_REQ_URI",
            "PROPERTY_FOLDER",
        ];
        foreach ($this->formsID as $block) {
            $arFilter = [
                "IBLOCK_ID" => $block,
                ">=DATE_CREATE" => $now->modify('-2 day')->format('d.m.Y H:i:s'),
                "ACTIVE" => "Y"
            ];
            $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                $arResult["UTM"][] = [
                    "DATE_CREATE" => $arFields["DATE_CREATE"],
                    "IBLOCK_ID" => $arFields["IBLOCK_ID"],
                    "ID" => $arFields["ID"],
                    "NAME" => $arFields["NAME"],
                    "UTM_SOURCE" => array_intersect_key($arProps["UTM_SOURCE"], $arPropsIx),
                    "UTM_MEDIUM" => array_intersect_key($arProps["UTM_MEDIUM"], $arPropsIx),
                    "UTM_CAMPAIGN" => array_intersect_key($arProps["UTM_CAMPAIGN"], $arPropsIx),
                    "UTM_TERM" => array_intersect_key($arProps["UTM_TERM"], $arPropsIx),
                    "UTM_CONTENT" => array_intersect_key($arProps["UTM_CONTENT"], $arPropsIx),
                    "REQ_URI" => array_intersect_key($arProps["REQ_URI"], $arPropsIx),
                    "FOLDER" => array_intersect_key($arProps["FOLDER"], $arPropsIx),
                ];
            }
        }
        file_put_contents("/home/bitrix/www".'/currency/a_arResult.json', json_encode($arResult["UTM"]));
    }
}
