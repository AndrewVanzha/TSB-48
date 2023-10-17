<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;

CModule::IncludeModule('iblock');

function sanitizePost(array $data): array
{
    if (!isset($data['CITYZENSHIP'])) {
        $data['CITYZENSHIP'] = 'Нет';
    } else {
        $data['CITYZENSHIP'] = 'Да';
    }
    
    if (!empty($data['FIRST_NAME'])) {
        $data['NAME'] = $data['LAST_NAME'] . ' ' . $data['FIRST_NAME'] . ' ' . $data['SECOND_NAME'];
    }
    return $data;
}

function getSex(array $data): array
{
    if ($data['SEX'] === 'Мужской') {
        $data['RECOURSE'] = 'Уважаемый';
    } else {
        $data['RECOURSE'] = 'Уважаемая';
    }
    return $data;
}

function finish(array $result): void
{
    echo json_encode($result);
    exit;
}

$arResult = [];
$arResult["status"] = true;
$arResult["captcha"] = true;
$fields = [];

if ($_POST["fields"]) {
    parse_str($_POST['fields'], $fields);
}

if (count($fields)  < 1) {
    $arResult["status"] = false;
    $arResult["message"][] = [
        "text" => "Данные отсутсвуют. Повторите еще раз.",
        "type" => false, //false - сообщение об ошибке 
    ];

    finish($arResult);
}

if (!$APPLICATION->CaptchaCheckCode($fields["CAPTCHA_WORD"], $fields["CAPTCHA_ID"])) {
    $arResult["status"] = false;
    $arResult["captcha"] = false;

    finish($arResult);
}

$fields = sanitizePost($fields);

$arParams = json_decode($fields["PARAMS"]);

if ($fields["email2"]) {
    $arResult["status"] = false;
    $arResult["message"][] = [
        "text" => "Извините, но что-то пошло не так.",
        "type" => false,
    ];
    finish($arResult);
}

$element = new CIBlockElement;

$properties = [];
$propertiesPost = [];

$propertiesPre = CIBlockProperty::GetList(
    [],
    ["IBLOCK_ID" => $arParams->IBLOCK_ID]
);
$propertiesList = [];

while ($property = $propertiesPre->Fetch()) {
    $propertiesList[$property['CODE']] = $property['ID'];
}

unset($property);

foreach ($arParams->PROPERTIES as $property) {
    if (isset($fields[$property])) {
        $properties[$propertiesList[$property]] = $fields[$property];
        $propertiesPost[$property] = $fields[$property];
    }
}

$elementFields = array(
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID"         => $arParams->IBLOCK_ID,
    "PROPERTY_VALUES"   => $properties,
    "ACTIVE"            => "Y",
    "DATE_CREATE"       => date('d.m.Y H:i:s', time()),
);

$elementFields['NAME']         = isset($fields['NAME'])         ? $fields['NAME']         : 'Новое обращение';
$elementFields['PREVIEW_TEXT'] = isset($fields['PREVIEW_TEXT']) ? $fields['PREVIEW_TEXT'] : '';
$elementFields['DETAIL_TEXT']  = isset($fields['DETAIL_TEXT'])  ? $fields['DETAIL_TEXT']  : '';

if ($id = $element->Add($elementFields)) {
    $arResult["message"][] = [
        "text" => "Заявка успешно отправлена",
        "type" => true,
    ];

    $postFields = array_merge($fields, $propertiesPost);
    $postFields['APPLICATION_ID'] = $id;

    $postFields = getSex($postFields);

    if ($arParams->ADMIN_EVENT != 'NONE') {
        CEvent::Send($arParams->ADMIN_EVENT, $arParams->SITES, $postFields);
    }

    if ($arParams->USER_EVENT != 'NONE') {
        CEvent::Send($arParams->USER_EVENT, $arParams->SITES, $postFields);
    }
} else {
    $arResult["status"] = false;
    $arResult["message"][] = [
        "text" => $element->LAST_ERROR,
        "type" => false,
    ];
}

finish($arResult);
