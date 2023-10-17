<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Iblock\PropertyIndex;

class SectionFilterAdd extends CBitrixComponent
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
            "IBLOCK_TYPE"            => $params['IBLOCK_TYPE']            ? $params['IBLOCK_TYPE']            :  '',
            "IBLOCK_ID"              => $params['IBLOCK_ID']              ? $params['IBLOCK_ID']              : '',
            "FILTER_NAME"            => $params['FILTER_NAME']            ? $params['FILTER_NAME']            : 'arrFilter',
            "PARENT_SECTION_ID"      => $params['PARENT_SECTION_ID']      ? $params['PARENT_SECTION_ID']      : '',
            "PROP_CODE"              => $params['PROP_CODE']              ? $params['PROP_CODE']              : '',

        );

        return $result;
    }

    #Проверяет подключение необходиимых модулей
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')){
            throw new Main\LoaderException(Loc::getMessage('SFA_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "iblock")) );
        }
    }

    #Проверка данных на обязательные поля
    protected function getPropsRequired()
    {
        if (empty($this->arParams["IBLOCK_ID"])) {
            array_push($this->MessageError, Loc::getMessage('SFA_ERROR_IBLOCK_ID') );
        }

        $arPropRequired = array("NAME");

        foreach($arPropRequired as $prop_item){
            if(empty($this->arResult["REQUEST"]["PROP"][$prop_item])){
                array_push($this->MessageError, Loc::getMessage('SFA_ERROR_'.$prop_item) );
            }
        }

    }

    #Получим товары по фильтру
    protected function getProduct()
    {
        #Если есть фильтрация, то достаем товары
        if (count($this->arResult["arrFilter"]) > 0) {

            $el = new CIBlockElement;

            #Добавление id инфоблока в фильтр
            if($this->arParams["PARENT_SECTION_ID"] > 0) {
                $this->arResult["arrFilter"]["IBLOCK_ID"] = $this->arParams["IBLOCK_ID"];
            }

            #Добавление id раздела в фильтр
            if($this->arParams["PARENT_SECTION_ID"] > 0) {
                $this->arResult["arrFilter"]["SECTION_ID"] = $this->arParams["PARENT_SECTION_ID"];
            }

            $this->arResult["arrFilter"]["ACTIVE"] = "Y";

            $res = $el->GetList(array("NAME"=>"ASC"), $this->arResult["arrFilter"], false, false, array());

            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $this->arResult["PRODUCTS_ID"][] = $arFields["ID"];
            }

        } else {
            array_push($this->MessageError, Loc::getMessage('SFA_ERROR_FILTER') );
        }

    }


    protected function getResult()
    {
        global $APPLICATION;
        $el = new CIBlockElement;

        #Получаем свойства умного фильтра
        $this->arResult["arrFilter"] = $GLOBALS[$this->arParams["FILTER_NAME"]];
        unset($this->arResult["arrFilter"]["FACET_OPTIONS"]);

        #Получаем данные отправленные пользователем с формы
        $request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();

        #Сообщения с редиректа
        if($request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]){ $this->MessageSend = explode(";", $request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]); }
        if($request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]){ $this->MessageError = explode(";", $request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]); }

        $this->arResult["REQUEST"]["PROP"] = $request->getPost("PROP");
        $this->arResult["REQUEST"]["SFA_SUBMIT"] = $request->getPost("SFA_SUBMIT");

        if ($request->isPost() && !empty($this->arResult["REQUEST"]["SFA_SUBMIT"])) {

            $this->getPropsRequired();

            if(count($this->MessageError) == 0){
                $this->getProduct();

                if (count($this->arResult["PRODUCTS_ID"]) > 0) {

                    #Создаем новый раздел
                    $bs = new CIBlockSection;

                    $arParams_trans = array("replace_space"=>"-","replace_other"=>"-");
                    $trans = Cutil::translit($this->arResult["REQUEST"]["PROP"]["NAME"],"ru",$arParams_trans);

                    $arSectionFields = Array(
                        "ACTIVE" => "Y",
                        "IBLOCK_SECTION_ID" => $this->arParams["PARENT_SECTION_ID"],
                        "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                        "NAME" => $this->arResult["REQUEST"]["PROP"]["NAME"],
                        "CODE" => $trans,
                    );

                    if (!empty($this->arParams["PROP_CODE"])) {
                        $arSectionFields[$this->arParams["PROP_CODE"]] = 1;
                    }

                    $SECTION_ID = $bs->Add($arSectionFields);

                    if ($SECTION_ID > 0) {
                        array_push($this->MessageSend, Loc::getMessage('SFA_SUCCESS_SECTION_ADD') );

                        $arNewSection = Array($SECTION_ID);

                        $count_product_add = 0;

                        #Получаем все существующие разделы для элемента и добавляем новый
                        foreach ($this->arResult["PRODUCTS_ID"] as $PRODUCT_ID) {

                            $db_old_sections = $el->GetElementGroups($PRODUCT_ID, true, array("ID"));

                            while($arSection = $db_old_sections->Fetch()) {
                                /*if ($arSection["ID"] != $this->arParams["PARENT_SECTION_ID"]) {*/
                                    $arNewSection[] = $arSection["ID"];    
                                /*}*/
                                
                            }

                            $result = $el->SetElementSection($PRODUCT_ID, $arNewSection);

                            if ($result) {

                                #Обновляем фасетный индекс (без этого элемент не появится в новом разделе)
                                PropertyIndex\Manager::updateElementIndex($this->arParams["IBLOCK_ID"], $PRODUCT_ID);

                                $count_product_add = $count_product_add + 1;
                            }
                        }

                        if ($count_product_add > 0) {
                            array_push($this->MessageSend, Loc::getMessage('SFA_SUCCESS_SECTION_ADD_PRODUCT', Array ("#COUNT#" => $count_product_add, "#SECTION_NAME#" => $this->arResult["REQUEST"]["PROP"]["NAME"])) );
                        }
                        else {
                            array_push($this->MessageError, Loc::getMessage('SFA_ERROR_SECTION_ADD_PRODUCT') );
                        }
                    }

                }
                else {
                    array_push($this->MessageError, Loc::getMessage('SFA_ERROR_EMPTY_PRODUCTS') );
                }

            }

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

    }

    protected function actionMessage()
    {
        $this->arResult["MESSAGE_ERROR"] = $this->MessageError;
        $this->arResult["MESSAGE_SEND"] = $this->MessageSend;
    }

    public function executeComponent()
    {
		try{
            $this -> arResult["COMPONENT_ID"] = 'SFA';
            $this -> includeComponentLang("class.php");
            $this -> checkModules();
            $this -> getResult();
            $this -> actionMessage();

            $this->includeComponentTemplate();
		}catch (Exception $e){
			ShowError($e->getMessage());
		}
    }
};