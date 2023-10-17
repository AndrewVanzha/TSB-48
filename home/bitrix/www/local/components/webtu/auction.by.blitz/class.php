<?php
if( !defined( 'B_PROLOG_INCLUDED' ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;
use \Webtu\Auction\Handler;

class AuctionByBlitz extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend = array();
    
    #Перезаписываем $this->arParams (Удаляем не нужное)
    public function onPrepareComponentParams($params)
    {
        $result = array(
            "AJAX_MODE"              => $params['AJAX_MODE']              ? $params['AJAX_MODE']              : '',
            "AJAX_OPTION_ADDITIONAL" => $params['AJAX_OPTION_ADDITIONAL'] ? $params['AJAX_OPTION_ADDITIONAL'] : '',
            "AJAX_OPTION_HISTORY"    => $params['AJAX_OPTION_HISTORY']    ? $params['AJAX_OPTION_HISTORY']    : '',
            "AJAX_OPTION_JUMP"       => $params['AJAX_OPTION_JUMP']       ? $params['AJAX_OPTION_JUMP']       : '',
            "AJAX_OPTION_STYLE"      => $params['AJAX_OPTION_STYLE']      ? $params['AJAX_OPTION_STYLE']      : '',
            "PRODUCT_ID"             => $params['PRODUCT_ID']             ? $params['PRODUCT_ID']             : '',
        );

        return $result;
    }
    
    #проверяет подключение необходиимых модулей
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')){
            throw new Main\LoaderException(Loc::getMessage('ABB_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "iblock")) );
        }
        if (!Loader::includeModule('catalog')){
            throw new Main\LoaderException(Loc::getMessage('ABB_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "catalog")) );
        }
        if (!Loader::includeModule("webtu.auction"))
        {
            throw new Main\LoaderException(Loc::getMessage("ABB_NOT_INSTALLED_IBLOCK", Array ("#ID#" => "webtu.auction")) );
        }
    }
    #Плолучим настройки из модуля webtu.auction
    protected function getSettingsModule()
    {
        #Получить все настройки модуля
        $this->arResult["MODULE_SETTINGS"] = Handler::getOptions();

        #Проверка на обязательные поля
        if(empty($this->arResult["MODULE_SETTINGS"]["AUCTION"]["IBLOCK_ID"])){ array_push($this->MessageError, Loc::getMessage("ABB_NONE_MODULE_SETTINGS_AUCTIONS_IBLOCK_ID") ); }
    }

    #Получим данные пользователя
    protected function getUserInfo()
    {
        global $USER;

        #Данные пользователя (Если зарегистрирован)
        if($USER->IsAuthorized()){
            $rsUser = CUser::GetByID($USER->GetID());
            $this->arResult["USER"] = $rsUser->Fetch();

        }

    }


    protected function getResult()
    {
        global $APPLICATION;
        $el = new CIBlockElement;

        #Получим настройки из модуля webtu.auction
        $this->getSettingsModule();

        #Получим данные пользователя
        $this->getUserInfo();

        if ( empty($this->arParams["PRODUCT_ID"]) ) array_push($this->MessageError, Loc::getMessage("ABB_EMPTY_PRODUCT_ID") );

        #Получим данные о товаре
        $this->arResult["PRODUCT_INFO"] = Handler::getProductInfo($this->arParams["PRODUCT_ID"]);

        if(count($this->MessageError) == 0) {

            #Получаем данные отправленные пользователем с формы
            $request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();

            #Сообщения с редиректа
            if($request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]){ $this->MessageSend = explode(";", $request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]); }
            if($request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]){ $this->MessageError = explode(";", $request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]); }

            $this->arResult["REQUEST"]["ABB_SUBMIT"] = $request->getPost("ABB_SUBMIT");

            if ($request->isPost() && $this->arResult["REQUEST"]["ABB_SUBMIT"] && $this->arResult["REQUEST"]["ABB_SUBMIT"] != "" ) {

                # Получаем блиц цену для товара
                $blitz_price = $this->arResult["PRODUCT_INFO"]["PROPS"][$this->arResult["MODULE_SETTINGS"]["AUCTION"]["PROPS"]["BLITZ_PRICE"]["CODE"]]["VALUE"];

                $this->arResult["NEW_PRICE"] = $blitz_price;

                if(count($this->MessageError) == 0) {

                    #Массив с параметрами новой цены
                    $arFieldsPrice = array(
                        "PRODUCT_ID"       => $this->arParams["PRODUCT_ID"],
                        "EXTRA_ID "        => $this->arResult["PRODUCT_INFO"]["PRICE_INFO"]["EXTRA_ID"],
                        "CATALOG_GROUP_ID" => $this->arResult["PRODUCT_INFO"]["PRICE_INFO"]["CATALOG_GROUP_ID"],
                        "PRICE"            => $this->arResult["NEW_PRICE"],
                        "CURRENCY"         => $this->arResult["PRODUCT_INFO"]["PRICE_INFO"]["CURRENCY"]

                    );

                    #Повышаем цену лота на ставку
                    $result = CPrice::Update($this->arResult["PRODUCT_INFO"]["PRICE_INFO"]["ID"], $arFieldsPrice);


                    if ($result) {

                        $history_bet = $arEmailSend = array();

                        #Получаем историю ставок
                        $history_bet = $this->arResult["PRODUCT_INFO"]["PROPS"][$this->arResult["MODULE_SETTINGS"]["AUCTION"]["PROPS"]["HISTORY_BET"]["CODE"]]["~VALUE"];

                        #Массив с новой ставкой
                        $arFieldsUserStep = array(
                            "USER_NAME" => $this->arResult["USER"]["NAME"] . " " . $this->arResult["USER"]["LAST_NAME"],
                            "USER_ID" => $this->arResult["USER"]["ID"],
                            "EMAIL" => $this->arResult["USER"]["EMAIL"],
                            "DATE" => date('d.m.Y'),
                            "TIME" => date('H:i:s'),
                            "PRICE" => $this->arResult["NEW_PRICE"]
                        );

                        $history_bet[] = json_encode($arFieldsUserStep);

                        CIBlockElement::SetPropertyValuesEx(
                            $this->arParams["PRODUCT_ID"],
                            $this->arResult["MODULE_SETTINGS"]["AUCTION"]["IBLOCK_ID"],
                            array(
                                $this->arResult["MODULE_SETTINGS"]["AUCTION"]["PROPS"]["HISTORY_BET"]["CODE"] => $history_bet
                            )
                        );

                        # Формируем массив c E-mail для отправки сообшений о ставке
                        # Email пользователя добавившего лот
                        $USER_CREATE_ID = $this->arResult["PRODUCT_INFO"]["PROPS"]["USER_ID"]["VALUE"];

                        $rsUserLot = CUser::GetByID($USER_CREATE_ID);
                        $arUserLot = $rsUserLot->Fetch();

                        $arEmailSend[] = $arUserLot["EMAIL"];

                        # Email пользователей сделавших ставку
                        foreach ($history_bet as $history_bet_item) {

                            $history_bet_item = json_decode($history_bet_item, true);

                            $key = array_search($history_bet_item["EMAIL"], $arEmailSend);

                            if (!is_int($key)) {
                                $arEmailSend[] = $history_bet_item["EMAIL"];
                            }
                        }

                        $this->arResult["NEW_PRICE_FORMATED"] = CurrencyFormat($this->arResult["NEW_PRICE"], $this->arResult["PRODUCT_INFO"]["PRICE_INFO"]["CURRENCY"]);

                        # Завершаем аукцион
                        $res_complete = Handler::auctionEnding($this->arParams["PRODUCT_ID"]);

                        if ($res_complete) {

                            # Отправка сообщения о завершении
                            foreach ($arEmailSend as $email) {
                                $arMailFields = array(
                                    "EMAIL" => $email,
                                    "PRODUCT_NAME" => $this->arResult["PRODUCT_INFO"]["FIELDS"]["NAME"],
                                    "PRODUCT_LINK" => $this->arResult["PRODUCT_INFO"]["FIELDS"]["DETAIL_PAGE_URL"],
                                    "NEW_PRICE" => $this->arResult["NEW_PRICE_FORMATED"]
                                );

                                CEvent::Send('AUCTION_SUCCESS_COMPLETE', SITE_ID, $arMailFields);
                            }

                            array_push($this->MessageSend, Loc::getMessage("ABB_AUCTION_SUCCESS_COMPLETE", Array("#PRICE#" => $this->arResult["NEW_PRICE_FORMATED"])));

                            #Редирект
                            if ($this->MessageSend) {
                                $MessageSend = "MESSAGE_SEND_" . $this->arResult["COMPONENT_ID"] . "=";
                                $MessageSend .= implode(";", $this->MessageSend);
                            }
                            if ($this->MessageError) {
                                $MessageError = "&MESSAGE_ERROR_" . $this->arResult["COMPONENT_ID"] . "=";
                                $MessageError .= implode(";", $this->MessageError);
                            }


                            LocalRedirect($APPLICATION->GetCurPageParam($MessageSend . $MessageError, array("MESSAGE_SEND_" . $this->arResult["COMPONENT_ID"], "MESSAGE_ERROR")));


                        } else {
                            array_push($this->MessageError, Loc::getMessage("ABB_ERROR_COMPLETE_AUCTION"));
                        }
                    }
                }
            }
        }

    }

    protected function actionMessage()
    {
        $this->arResult["MESSAGE_ERROR"] = $this->MessageError;
        $this->arResult["MESSAGE_SEND"] = $this->MessageSend;

    }

    public function executeComponent()
    {
		try{
            $this->arResult["COMPONENT_ID"] = 'ABB';
            $this->includeComponentLang('class.php');
            $this->checkModules();
            $this->getResult();
            $this->actionMessage();

            $this->includeComponentTemplate();
		}catch (Exception $e){
			ShowError($e->getMessage());
		}
    }
};