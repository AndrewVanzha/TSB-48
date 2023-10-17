<?php
namespace Webtu\Auction;

use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Iblock;
use \Webtu\Auction\SaleExport;

Loc::loadMessages(__FILE__);

class Event
{
    #Вызывается до попытки регистрации нового пользователя или до изменения параметров пользователя
    static public function OnBeforeUserUpdateHandler(&$arFields)
    {
        $arFields["LOGIN"] = $arFields["EMAIL"];
        return $arFields;
    }

    #Вызывается перед индексацией элемента поиска
    static public function BeforeIndexHandler($arFields)
    {
        if (!Loader::includeModule("iblock")){ return; }

        #ID инфоблоков, для которых производить модификацию
        $arIblock = array(6);

        #Cтандартные поля, которые нужно исключить
        $arDelFields = array("DETAIL_TEXT", "PREVIEW_TEXT");

        if ($arFields["MODULE_ID"] == 'iblock' && in_array($arFields["PARAM2"], $arIblock) && intval($arFields["ITEM_ID"])  > 0){

            $dbElement = \CIBlockElement::GetByID($arFields["ITEM_ID"]) ;

            if ($arElement = $dbElement->Fetch()){
                foreach ($arDelFields as $value){
                    if (isset ($arElement[$value])  && strlen($arElement[$value]) > 0){
                        $arFields["BODY"] = str_replace (\CSearch::KillTags($arElement[$value]) , "", \CSearch::KillTags($arFields["BODY"]) );
                    }
                }
            }

            return $arFields;
        }
    }

    #Вызывается после изменения флага оплаты заказа
    static public function OnSalePayOrderHandler($ID, $VAL)
    {
        if ($VAL == 'Y') {
            \CModule::includeModule('sale');
            \CSaleOrder::StatusOrder($ID, 'H');
            $resExport = SaleExport::OrderExport($ID);
        }
    }
    
    #Вызывается после изменения статуса заказа
    static public function OnSaleStatusOrderHandler($ID, $VAL)
    {
        #Запишим заказ
        $resExport = SaleExport::OrderExport($ID);
    }
    
    #Вызывается после изменения флага отмены заказа
    static public function OnSaleCancelOrderHandler($orderId, $value, $description)
    {
        #Запишим заказ
        $resExport = SaleExport::OrderExport($orderId);
    }
    
    #Событие "OnProlog" вызывается в начале визуальной части пролога сайта.
    static public function OnPrologHandler()
    {

    }

    static public function OnAfterEpilog()
    {
        SaleExport::orderImport();
    }
	
	#Вызывается после регистрации пользователя
    static public function OnAfterUserRegisterHandler(&$arFields)
    {
        if($arFields["USER_ID"]){
		   $COUPON = \Bitrix\Sale\Internals\DiscountCouponTable::generateCoupon(true);
		   $fields = array(
			  "DISCOUNT_ID" => "7", // ИД скидки
			  "ACTIVE" 		=> "Y",
			  "TYPE" 		=> \Bitrix\Sale\Internals\DiscountCouponTable::TYPE_ONE_ORDER,
			  "COUPON" 		=> $COUPON,
			  "DATE_APPLY" 	=> false,
			  "USER_ID" 	=> $arFields["USER_ID"],
		   );

		   $result = \Bitrix\Sale\Internals\DiscountCouponTable::add($fields);
		   if (!$result->isSuccess())
		   {
			  $res =  $result->getErrorMessages();
			  
		   } else {
			  $res = $result->getId();

		   }

		}
		return $arFields;
     }

}
?>