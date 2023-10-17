<?php
namespace Webtu\Auction;

use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class SaleExport
{
    public $shop_id = 10536;
    public function __construct(){}
    
    static public function OrderExport($id)
    {
        $arResult["MESSAGE"] = array("ERROR"=>array(),"OK"=>array());
        $resOptions = array();

        $shop_id = (int)Option::get("webtu.auction", "tab4_shop_id");
        
        $resOptions["EXPORT"]["SAVE_FILE"] = Option::get("webtu.auction", "tab4_save_file");
        $resOptions["EXPORT"]["SAVE_NAME_FILE"] = Option::get("webtu.auction", "tab4_save_file_name");
        $resOptions["COMMON"]["SAVE_FILE"] = $_SERVER['DOCUMENT_ROOT'].$resOptions["EXPORT"]["SAVE_FILE"];
        $resOptions["COMMON"]["FILE_PATH"] =  $_SERVER['DOCUMENT_ROOT'].$resOptions["EXPORT"]["SAVE_FILE"].$resOptions["EXPORT"]["SAVE_NAME_FILE"];

        #Проверка обязательные параметры
        $paramsRequired = array("SAVE_FILE", "SAVE_NAME_FILE");
        foreach($paramsRequired as $paramsItem){
            if(empty($resOptions["EXPORT"][$paramsItem])){
                array_push($arResult["MESSAGE"]["ERROR"], Loc::getMessage('OE_ERROR_'.$paramsItem) );
            }
        }
        
        if(count($arResult["MESSAGE"]["ERROR"]) == 0) {
            
            #Получим данные по заказам в xml
            $orderXml = self::GetOrderXml($id);

            #Переведём в массив
            $orderJson = json_encode($orderXml);
            $orderArray = json_decode($orderJson, true);
            unset($orderArray["@attributes"]);
            unset($orderArray[0]);

            if($orderArray)
            {
                self::exportOrder($orderArray['Документ'], $shop_id);
            }
        } else {
            array_push($arResult["MESSAGE"]["ERROR"], Loc::getMessage('OE_ERROR_FILE_EXIT')); 
        }

        return $arResult;
    }

    /*
     * Сохранение заказа в JSON-файл
     */

    static protected function exportOrder($order, $shop_id) 
    {
        \CModule::IncludeModule('iblock');

        $phone = "";

        foreach ($order["ЗначенияРеквизитов"]["ЗначениеРеквизита"] as $property) {
            if ($property["Наименование"] == "Статуса заказа ИД") {
                if ($property["Значение"] != "H") return false;
            }
        }

        foreach ($order["Контрагенты"]["Контрагент"]["Контакты"]["Контакт"] as $contact) {
            if (strpos($contact["Тип"], "Телефон") !== false) {
                $phone = $contact["Значение"];
            }
        }

        foreach ($order["ЗначенияРеквизитов"]["ЗначениеРеквизита"] as $property) {
            if ($property["Наименование"] == "Заказ оплачен") {
                $trait = ($property["Значение"] == "true") ? 1 : 0;
            }
        }

        $output = array(
            "icashinternet" => $shop_id,
            "idorder"       => $order["Ид"], 
            "firstname"     => $order["Контрагенты"]["Контрагент"]["Имя"], 
            "lastname"      => $order["Контрагенты"]["Контрагент"]["Фамилия"], 
            "telefon"       => $phone, 
            "priznak"       => $trait, 
            "coins"         => array()
        );

        $products = array();

        if (isset($order["Товары"]["Товар"]["Ид"])) {
            $products[] = $order["Товары"]["Товар"];
        } else {
            $products = $order["Товары"]["Товар"];
        }

        foreach ($products as $product) {
            $element = \CIblockElement::GetList(array(), array("IBLOCK_ID" => 6, "ID" => $product["Ид"]));
            $element = $element->GetNextElement();

            if ($element) {
                $properties = $element->GetProperties();

                if ($properties['SET']['VALUE'] == 'Да') {
                    $isset   = 1;
                    $article = implode(';', $properties['SET_COINS']['VALUE']);
                } else {
                    $isset   = 0;
                    $article = $properties['ARTICLE']['VALUE'];
                }

                $output["coins"][] = array(
                    "cmccatnum" => $article,
                    "quantity"  => (int)$product["Количество"],
                    "price"     => (float)$product["ЦенаЗаЕдиницу"],
                    "isset"     => $isset
                );
            }
        }

        if (empty($output["coins"])) return false;

        $date = str_replace('-', '', $order["Дата"]);
        $time = str_replace(':', '', $order["Время"]);

        $filename = "{$date}_{$time}_{$order["Ид"]}";

        $output = iconv('utf-8', 'cp1251', json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/bitrix/catalog_export/exchange-order/{$filename}.json", $output);
    }

    static public function orderImport()
    {
        \CModule::IncludeModule('sale');

        $files = scandir("{$_SERVER['DOCUMENT_ROOT']}/bitrix/catalog_export/exchange-order-in/");

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;
            rename(
                "{$_SERVER['DOCUMENT_ROOT']}/bitrix/catalog_export/exchange-order-in/{$file}",
                "{$_SERVER['DOCUMENT_ROOT']}/bitrix/catalog_export/exchange-order-archive/{$file}"
            );
            $file = explode('.', $file);
            $file = explode('_', $file[0]);
            \CSaleOrder::StatusOrder($file[3], $file[0]);
        }
    }
    
    #Получим данные по заказам
    static public function GetOrderXml($id)
    {
        global $APPLICATION;

        
        if (!Loader::includeModule("sale")){ return; }

        unset($_SESSION["BX_CML2_EXPORT"]['LAST_ORDER_ID']);
        
        ob_start();
        $arFilter = array(
            "ID" => $id
        );
        
        \CTimeZone::Disable();
        \CSaleExport::ExportOrders2Xml($arFilter);
        \CTimeZone::Enable();
    
        $contents = ob_get_contents();
        ob_end_clean();
        
        if(toUpper(LANG_CHARSET) != "WINDOWS-1251"){
            $contents = $APPLICATION->ConvertCharset($contents, LANG_CHARSET, "windows-1251");  
        }
        
        $arResult = new \SimpleXMLElement($contents);
        
        return $arResult;
    }
    

}
?>