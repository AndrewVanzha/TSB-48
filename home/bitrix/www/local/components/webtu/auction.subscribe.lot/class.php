<?php
if( !defined( 'B_PROLOG_INCLUDED' ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;
use \Webtu\Auction\Handler;

class AuctionSubscribeLot extends CBitrixComponent
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
            throw new Main\LoaderException(Loc::getMessage('ASL_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "iblock")) );
        }
        if (!Loader::includeModule("webtu.auction"))
        {
            throw new Main\LoaderException(Loc::getMessage("ASL_NOT_INSTALLED_IBLOCK", Array ("#ID#" => "webtu.auction")) );
        }
    }
    #Плолучим настройки из модуля webtu.auction
    protected function getSettingsModule()
    {
        #Получить все настройки модуля
        $this->arResult["MODULE_SETTINGS"] = Handler::getOptions();

        #Проверка на обязательные поля
        if(empty($this->arResult["MODULE_SETTINGS"]["AUCTION"]["IBLOCK_ID"])){ array_push($this->MessageError, Loc::getMessage("ASL_NONE_MODULE_SETTINGS_AUCTIONS_IBLOCK_ID") ); }
    }


    protected function getResult()
    {
        global $APPLICATION;
        $el = new CIBlockElement;

        #Получим настройки из модуля webtu.auction
        $this->getSettingsModule();

        if ( empty($this->arParams["PRODUCT_ID"]) ) array_push($this->MessageError, Loc::getMessage("ASL_EMPTY_PRODUCT_ID") );

        #Получим данные о товаре
        $this->arResult["PRODUCT_INFO"] = Handler::getProductInfo($this->arParams["PRODUCT_ID"]);

        if(count($this->MessageError) == 0) {

            #Получаем данные отправленные пользователем с формы
            $request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();

            #Сообщения с редиректа
            if($request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]){ $this->MessageSend = explode(";", $request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]); }
            if($request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]){ $this->MessageError = explode(";", $request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]); }

            $this->arResult["REQUEST"]["ASL_SUBMIT"] = $request->getPost("ASL_SUBMIT");
            $this->arResult["REQUEST"]["PROP"] = $request->getPost("PROP");

            if ($request->isPost() && $this->arResult["REQUEST"]["ASL_SUBMIT"] && $this->arResult["REQUEST"]["ASL_SUBMIT"] != "") {

                if (empty($this->arResult["REQUEST"]["PROP"]["EMAIL"])) array_push($this->MessageError, Loc::getMessage("ASL_EMPTY_EMAIL") );

                if(count($this->MessageError) == 0) {
                    # Получаем email подписок
                    $arEmail = $this->arResult["PRODUCT_INFO"]["PROPS"]["SUBSRIBE_LOT"]["VALUE"];

                    $key = array_search($this->arResult["REQUEST"]["PROP"]["EMAIL"], $arEmail);

                    if (!is_int($key)) {

                        $arEmail[] = $this->arResult["REQUEST"]["PROP"]["EMAIL"];

                        CIBlockElement::SetPropertyValuesEx(
                            $this->arParams["PRODUCT_ID"],
                            $this->arResult["MODULE_SETTINGS"]["AUCTION"]["IBLOCK_ID"],
                            array(
                                "SUBSRIBE_LOT" => $arEmail
                            )
                        );

                        array_push($this->MessageSend, Loc::getMessage("ASL_SUCCESS_SUBSCRIBE") );

                        #Редирект
                        if($this->MessageSend){
                            $MessageSend = "MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]."=";
                            $MessageSend .= implode(";",$this->MessageSend);
                        }
                        if($this->MessageError){
                            $MessageError = "&MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]."=";
                            $MessageError .= implode(";",$this->MessageError);
                        }

                        LocalRedirect( $APPLICATION->GetCurPageParam($MessageSend.$MessageError, array("MESSAGE_SEND_".$this->arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"])) );

                    }
                    else {
                        array_push($this->MessageError, Loc::getMessage("ASL_IS_EMAIL") );
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
            $this->arResult["COMPONENT_ID"] = 'ASL';
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