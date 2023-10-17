<?
namespace Webtu\Auction;

use \Bitrix\Main;
use \Bitrix\Main\Diag\Debug;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Iblock;
use \Bitrix\Iblock\PropertyIndex;

#Подгружаем файл с языковыми настройками
Loc::loadMessages(__FILE__);

class Handler
{
    public function __construct() {}

    #Получить все настройки модуля
    public function getOptions()
    {
        $moduleOptions = array();

        #Основные настройки
        $moduleOptions["SETTINGS"]["MIN_STEP"] = Option::get("webtu.auction", "tab1_setting_min_step");
        $moduleOptions["SETTINGS"]["PERIOD_OF_VALIDITY"] = Option::get("webtu.auction", "tab1_setting_period_of_validity");
        $moduleOptions["SETTINGS"]["MIN_DAY_MODERATION"] = Option::get("webtu.auction", "tab1_setting_min_day_moderation");
        $moduleOptions["SETTINGS"]["BANK_USER_ID"] = Option::get("webtu.auction", "tab1_setting_user_id");
        $moduleOptions["SETTINGS"]["GROUP_ID_FULL"] = Option::get("webtu.auction", "tab1_setting_group_id_full");
        $moduleOptions["SETTINGS"]["GROUP_ID_AVERAGE"] = Option::get("webtu.auction", "tab1_setting_group_id_average");
        $moduleOptions["SETTINGS"]["GROUP_ID_BLACK"] = Option::get("webtu.auction", "tab1_setting_group_id_black");

        #Инфоблок с аукционом
        $moduleOptions["AUCTION"]["IBLOCK_ID"] = Option::get("webtu.auction", "tab2_iblock_id");
        $moduleOptions["AUCTION"]["SECTION_ID_ACTIVE"] = Option::get("webtu.auction", "tab2_section_id_active");
        $moduleOptions["AUCTION"]["SECTION_ID_PLAN"] = Option::get("webtu.auction", "tab2_section_id_plan");
        $moduleOptions["AUCTION"]["SECTION_ID_COMPLETED"] = Option::get("webtu.auction", "tab2_section_id_completed");

        $moduleOptions["AUCTION"]["PROPS"]["STARTING_PRICE"] = array(
            "ID" => Option::get("webtu.auction", "tab2_prop_starting_price_id"),
            "CODE" => Option::get("webtu.auction", "tab2_prop_starting_price_code"),
        );
        $moduleOptions["AUCTION"]["PROPS"]["BLITZ_PRICE"] = array(
            "ID" => Option::get("webtu.auction", "tab2_prop_blitz_price_id"),
            "CODE" => Option::get("webtu.auction", "tab2_prop_blitz_price_code"),
        );
        $moduleOptions["AUCTION"]["PROPS"]["HISTORY_BET"] = array(
            "ID" => Option::get("webtu.auction", "tab2_prop_history_bet_id"),
            "CODE" => Option::get("webtu.auction", "tab2_prop_history_bet_code"),
        );
        $moduleOptions["AUCTION"]["PROPS"]["STEP_RATE"] = array(
            "ID" => Option::get("webtu.auction", "tab2_prop_step_rate_id"),
            "CODE" => Option::get("webtu.auction", "tab2_prop_step_rate_code"),
        );
        $moduleOptions["AUCTION"]["PROPS"]["DATE_ACTIVE"] = array(
            "ID" => Option::get("webtu.auction", "tab2_prop_date_active_id"),
            "CODE" => Option::get("webtu.auction", "tab2_prop_date_active_code"),
        );
        $moduleOptions["AUCTION"]["PROPS"]["DATE_COMPLETED"] = array(
            "ID" => Option::get("webtu.auction", "tab2_prop_date_completed_id"),
            "CODE" => Option::get("webtu.auction", "tab2_prop_date_completed_code"),
        );

        #Инфоблок с продажами
        $moduleOptions["AUCTION_SALE"]["IBLOCK_ID"] = Option::get("webtu.auction", "tab3_iblock_id_buy");

        return $moduleOptions;

    }

    #Получим данные о товаре
    public function getProductInfo( $PRODUCT_ID = "" )
    {
        $arProductInfo = array();

        if ( $PRODUCT_ID > 0) {

            #Получить все настройки модуля
            $options = self::getOptions();

            #Получим параметры и свойства элемента
            $arFilter = Array("IBLOCK_ID" => $options["AUCTION"]["IBLOCK_ID"], "ACTIVE" => "Y", "ID" => $PRODUCT_ID);
            $res = \CIBlockElement::GetList(Array(), $arFilter, false, false, Array());

            while($ob = $res->GetNextElement()) {
                $arProductInfo["FIELDS"] = $ob->GetFields();
                $arProductInfo["PROPS"] = $ob->GetProperties();
            }

            #Получим параметры цены для товара
            $arProductInfo["PRICE_INFO"] = \CPrice::GetBasePrice($PRODUCT_ID);

        }

        return $arProductInfo;
    }

    #Завершение аукциона
    public function auctionEnding( $PRODUCT_ID = "" )
    {
        if (!Loader::includeModule("iblock")){ return; }

        if ( $PRODUCT_ID > 0) {

            #Получить все настройки модуля
            $options = self::getOptions();

            if ( empty($options["AUCTION_SALE"]["IBLOCK_ID"]) ) { return false; }
            else {

                #Получить данные о товаре
                $arProductInfo = self::getProductInfo($PRODUCT_ID);

                # Получаем историю ставок
                $history_bet = array();

                foreach ($arProductInfo["PROPS"][$options["AUCTION"]["PROPS"]["HISTORY_BET"]["CODE"]]["~VALUE"] as $key => $history_item) {

                    $history_bet[$key] = json_decode($history_item, true);
                }

                # Сортируем массив в обратном порядке
                $history_bet = array_reverse($history_bet);

                $USER_ID = $history_bet[0]["USER_ID"];

                #Получить данные о товаре
                $arProductInfo = self::getProductInfo($PRODUCT_ID);

                #Название
                $title = "Продажа лота ".$arProductInfo["FIELDS"]["NAME"];

                #Назваие в транслите
                $arParams_trans = array("replace_space"=>"-","replace_other"=>"-");
                $trans = \Cutil::translit($title,"ru", $arParams_trans);

                #Массив с заказом
                $arLoadOrderArray = Array(
                    "IBLOCK_ID"          => $options["AUCTION_SALE"]["IBLOCK_ID"],
                    "NAME"               => $title,
                    "CODE"               => $trans.'-'.mktime(),
                    "ACTIVE"             => "N",
                    "DATE_ACTIVE_FROM"   => date("d.m.Y H:i:s"),
                    "PROPERTY_VALUES"    => array(
                        "LOT_ID"         => $PRODUCT_ID,
                        "SELLER_ID"      => $arProductInfo["PROPS"]["USER_ID"]["VALUE"],
                        "BUYER_ID"       => $USER_ID,
                        "SALE_SUM"       => $arProductInfo["PRICE_INFO"]["PRICE"]
                    ),
                    "PREVIEW_PICTURE"    => "",
                    "DETAIL_PICTURE"     => ""
                );

                $el = new \CIBlockElement();

                if( $SALE_ID = $el->Add($arLoadOrderArray) ){

                    $result_update = $el->SetElementSection($PRODUCT_ID, array($options["AUCTION"]["SECTION_ID_COMPLETED"]));

                    if ( $result_update ) {

                        #Обновляем фасетный индекс (без этого элемент не появится в новом разделе)
                        PropertyIndex\Manager::updateElementIndex($options["AUCTION"]["IBLOCK_ID"], $PRODUCT_ID);

                        #Записывем дату завершения аукциона
                        $el->SetPropertyValuesEx($PRODUCT_ID, $options["AUCTION"]["IBLOCK_ID"], array( "TIME_END" =>  date("d.m.Y H:i:s")));

                        return $SALE_ID;
                    }
                }

                else return false;
            }
        }
        else {
            return false;
        }
    }

    #Оповещение пользователей подписавшихся на лот
    public function auctionActivateSendEmail($PRODUCT_ID = "")
    {
        #Получить данные о товаре
        $arProductInfo = self::getProductInfo($PRODUCT_ID);

        # Получаем email подписок
        $arEmail = $arProductInfo["PROPS"]["SUBSRIBE_LOT"]["VALUE"];

        foreach ($arEmail as $email) {

            $arMailFields = array(
                "EMAIL"        => $email,
                "PRODUCT_NAME" => $arProductInfo["FIELDS"]["NAME"],
                "PRODUCT_LINK" => $arProductInfo["FIELDS"]["DETAIL_PAGE_URL"]
            );

            \CEvent::Send('AUCTION_LOT_ACTIVE', SITE_ID, $arMailFields);
        }
    }

    #Перенос аукциона из планиреумых в активные
    public function auctionActivate()
    {
        if (!Loader::includeModule("iblock")){ return; }

        #Текущая дата
        $current_date =  date('Y-m-d');

        #Получить все настройки модуля
        $options = self::getOptions();

        if (empty($options["AUCTION"]["IBLOCK_ID"])) { return; }
        if (empty($options["AUCTION"]["SECTION_ID_PLAN"])) { return; }
        if (empty($options["AUCTION"]["SECTION_ID_ACTIVE"])) { return; }
        if (empty($options["AUCTION"]["PROPS"]["DATE_ACTIVE"]["CODE"])) { return; }

        $arElementID = array();

        $el = new \CIBlockElement();

        $arSelect = Array("ID");

        $arFilter = Array(
            "IBLOCK_ID"   => $options["AUCTION"]["IBLOCK_ID"],
            "SECTION_ID"  => $options["AUCTION"]["SECTION_ID_PLAN"],
            "ACTIVE"      => "Y",
            "PROPERTY_".$options["AUCTION"]["PROPS"]["DATE_ACTIVE"]["CODE"] => $current_date
        );

        $res = $el->GetList(Array(), $arFilter, false, false, $arSelect);

        while($ob = $res->GetNextElement()) {

            $arFields = $ob->GetFields();
            $arElementID[] = $arFields["ID"];

        }

        foreach ($arElementID as $PRODUCT_ID) {

            $result_update = $el->SetElementSection($PRODUCT_ID, array($options["AUCTION"]["SECTION_ID_ACTIVE"]));

            if ( $result_update ) {
                
                #Обновляем фасетный индекс (без этого элемент не появится в новом разделе)
                PropertyIndex\Manager::updateElementIndex($options["AUCTION"]["IBLOCK_ID"], $PRODUCT_ID);

                #Оповещение пользователей подписавшихся на лот
                self::auctionActivateSendEmail($PRODUCT_ID);
            }
        }
    }

    #Получение аукционов, которые необходимо завершить
    public function getEndAuction()
    {
        if (!Loader::includeModule("iblock")){ return; }

        #Текущая дата
        $current_date =  date('Y-m-d');

        #Получить все настройки модуля
        $options = self::getOptions();

        if (empty($options["AUCTION"]["IBLOCK_ID"])) { return; }
        if (empty($options["AUCTION"]["SECTION_ID_ACTIVE"])) { return; }
        if (empty($options["AUCTION"]["PROPS"]["DATE_COMPLETED"]["CODE"])) { return; }
        if (empty( $options["AUCTION"]["PROPS"]["HISTORY_BET"]["CODE"])) { return; }

        $el = new \CIBlockElement();

        $arSelect = Array("ID");

        $arFilter = Array(
            "IBLOCK_ID"   => $options["AUCTION"]["IBLOCK_ID"],
            "SECTION_ID"  => $options["AUCTION"]["SECTION_ID_ACTIVE"],
            "ACTIVE"      => "Y",
            "PROPERTY_".$options["AUCTION"]["PROPS"]["DATE_COMPLETED"]["CODE"] => $current_date
        );

        $res = $el->GetList(Array(), $arFilter, false, false, $arSelect);

        while($ob = $res->GetNextElement()) {

            $arFields = $ob->GetFields();

            $PRODUCT_ID = $arFields["ID"];

            $res_end = self::auctionEnding($PRODUCT_ID);

            if ( $res_end ) {

                #Получить данные о товаре
                $arProductInfo = self::getProductInfo($PRODUCT_ID);

                #EMAIL создателя аукциона
                $USER_CREATE_ID = $arProductInfo["PROPS"]["USER_ID"]["VALUE"];

                $rsUserLot = \CUser::GetByID($USER_CREATE_ID);
                $arUserLot = $rsUserLot->Fetch();

                $arEmailSend[] = $arUserLot["EMAIL"];

                # Получаем историю ставок
                $history_bet = array();

                foreach ($arProductInfo["PROPS"][$options["AUCTION"]["PROPS"]["HISTORY_BET"]["CODE"]]["~VALUE"] as $key => $history_item) {

                    $history_bet[$key] = json_decode($history_item, true);

                    $key_search = array_search( $history_bet[$key]["EMAIL"], $arEmailSend);

                    if (!is_int($key_search)) {
                        $arEmailSend[] =  $history_bet[$key]["EMAIL"];
                    }
                }

                # Отправка сообщения о завершении
                foreach ($arEmailSend as $email) {
                    $arMailFields = array(
                        "EMAIL"        => $email,
                        "PRODUCT_NAME" => $arProductInfo["FIELDS"]["NAME"],
                        "PRODUCT_LINK" => $arProductInfo["FIELDS"]["DETAIL_PAGE_URL"],
                        "NEW_PRICE"    => CurrencyFormat( $arProductInfo["PRICE_INFO"]["PRICE"], $arProductInfo["PRICE_INFO"]["CURRENCY"] )
                    );

                    \CEvent::Send('AUCTION_SUCCESS_COMPLETE', SITE_ID, $arMailFields);
                }

            }
        }
    }
}

?>