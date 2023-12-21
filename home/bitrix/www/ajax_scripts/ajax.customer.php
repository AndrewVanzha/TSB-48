<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
use Debugg\Oop\Dvlp;

CModule::IncludeModule('iblock');

function sanitizePost(array $data): array
{
    if (!isset($data['CITYZENSHIP'])) {
        $data['CITYZENSHIP'] = 'Нет';
    } else {
        $data['CITYZENSHIP'] = 'Да';
    }

    /*if (!empty($data['FIRST_NAME'])) {
        $data['NAME'] = $data['LAST_NAME'] . ' ' . $data['FIRST_NAME'] . ' ' . $data['SECOND_NAME'];
    }*/
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
//file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/chastnym-klientam/arenda-seyfov/a_post.json', json_encode($fields));

$fields = sanitizePost($fields);
//file_put_contents("/home/bitrix/www".'/logs/a_fields.json', json_encode($fields));

$arParamsProperties = json_decode($fields["PROPERTIES"]);
$arParams = (array) json_decode($fields["PARAMS"]);
//$iblock_id = 15;  // Онлайн-заявка на аренду сейфа: администратор
$iblock_id = $arParams["IBLOCK_ID"];  // Заявка на открытие вклада/депозита: администратор

$element = new CIBlockElement;

$properties = [];
$propertiesPost = [];

$propertiesPre = CIBlockProperty::GetList(
    [],
    //["IBLOCK_ID" => $arParams->IBLOCK_ID]
    ["IBLOCK_ID" => $iblock_id]
);
$propertiesList = [];

while ($property = $propertiesPre->Fetch()) {
    $propertiesList[$property['CODE']] = $property['ID'];
}

unset($property);

//foreach ($arParams->PROPERTIES as $property) {
foreach ($arParamsProperties as $property) {
    if (isset($fields[$property])) {
        $properties[$propertiesList[$property]] = $fields[$property];
        $propertiesPost[$property] = $fields[$property];
    }
}

$elementFields = array(
    "IBLOCK_SECTION_ID" => false,
    //"IBLOCK_ID"         => $arParams->IBLOCK_ID,
    "IBLOCK_ID"         => $iblock_id,
    "PROPERTY_VALUES"   => $properties,
    "ACTIVE"            => "Y",
    "DATE_CREATE"       => date('d.m.Y H:i:s', time()),
);

$elementFields['NAME']         = isset($fields['NAME'])         ? $fields['NAME']         : 'Новое обращение';
$elementFields['PREVIEW_TEXT'] = isset($fields['PREVIEW_TEXT']) ? $fields['PREVIEW_TEXT'] : '';
$elementFields['DETAIL_TEXT']  = isset($fields['DETAIL_TEXT'])  ? $fields['DETAIL_TEXT']  : '';

$elementFields['UTM_SOURCE'] = isset($fields['UTM_SOURCE'])? $fields['UTM_SOURCE'] : 'no_data';
$elementFields['UTM_MEDIUM'] = isset($fields['UTM_MEDIUM'])? $fields['UTM_MEDIUM'] : 'no_data';
$elementFields['UTM_CAMPAIGN'] = isset($fields['UTM_CAMPAIGN'])? $fields['UTM_CAMPAIGN'] : 'no_data';
$elementFields['UTM_TERM'] = isset($fields['UTM_TERM'])? $fields['UTM_TERM'] : 'no_data';
$elementFields['UTM_CONTENT'] = isset($fields['UTM_CONTENT'])? $fields['UTM_CONTENT'] : 'no_data';
$elementFields['FORM'] = 100;  //  Заявка на открытие вклада/депозита: администратор

$propertiesPost["DATE_CREATE"] = date('d.m.Y H:i:s', time());
//file_put_contents("/home/bitrix/www".'/logs/a_$elementFields.json', json_encode($elementFields));

if ($id = $element->Add($elementFields)) {
    $postFields = array_merge($fields, $propertiesPost);
    $postFields['APPLICATION_ID'] = $id;
    $postFields['RECOURSE'] = 'Уважаемый(ая)';
    $postFields['DATE_CREATE'] = $elementFields['DATE_CREATE'];

    $postFields = getSex($postFields);
    Dvlp::logger('common_ajax_postFields', $postFields);
    //file_put_contents("/home/bitrix/www".'/logs/a_$arParams.json', json_encode($arParams));

    $arResult["message"][] = [
        "data" => $postFields,
        "text" => "Заявка успешно отправлена",
        "type" => true,
    ];

    //if ($arParams->ADMIN_EVENT != 'NONE') {
    if ($arParams["ADMIN_EVENT"] != 'NONE') {
        $v1 = CEvent::Send($arParams["ADMIN_EVENT"], $arParams["SITES"], $postFields);
        //$v1 = CEvent::Send($arParams->ADMIN_EVENT, $arParams->SITES, $postFields);
    }

    //if ($arParams->USER_EVENT != 'NONE') {
    if ($arParams["USER_EVENT"] != 'NONE') {
        $v2 = CEvent::Send($arParams["USER_EVENT"], $arParams["SITES"], $postFields);
        //$v2 = CEvent::Send($arParams->USER_EVENT, $arParams->SITES, $postFields);
    }
    //file_put_contents("/home/bitrix/www".'/logs/a_v_post.json', json_encode([$v1, $v2]));
} else {
    $arResult["status"] = false;
    $arResult["message"][] = [
        "text" => $element->LAST_ERROR,
        "type" => false,
    ];
}

finish($arResult);
