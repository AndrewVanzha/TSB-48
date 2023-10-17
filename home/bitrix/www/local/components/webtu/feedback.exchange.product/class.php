<?php
if( !defined( 'B_PROLOG_INCLUDED' ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

class FeedbackExchangeProduct extends CBitrixComponent
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
            'IBLOCK_ID'              => $params['IBLOCK_ID']              ? $params['IBLOCK_ID']              : '',
            'IBLOCK_TYPE'            => $params['IBLOCK_TYPE']            ? $params['IBLOCK_TYPE']            : '',
            'PRODUCT_IBLOCK_ID'      => $params['PRODUCT_IBLOCK_ID']      ? $params['PRODUCT_IBLOCK_ID']      : '6',
            'PRODUCT_ID'             => $params['PRODUCT_ID']             ? $params['PRODUCT_ID']             : '697',
            'USE_CAPTCHA'            => $params['USE_CAPTCHA']            ? $params['USE_CAPTCHA']            : 'N',
        );

        return $result;
    }
    
    #проверяет подключение необходиимых модулей
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')){
            throw new Main\LoaderException(Loc::getMessage('FEP_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "iblock")) );
        }
    }

    #Проверяем на обязательные поля
    protected function getPropertyRequired()
    {
        $arResult = array("USER_NAME","USER_NUMBER","PRIVACE_POLICE");

        foreach($arResult as $item){
            if( $this->arResult["REQUEST"]["PROP"][$item] == "" ){
                array_push($this->MessageError, Loc::getMessage('FEP_ERROR_'.$item) );
            }
        }

        return $arResult;   
    }

    protected function getResult()
    {
        global $APPLICATION;
        global $USER;
        $el = new CIBlockElement;

        #Получаем данные о шаблоне
        $this->InitComponentTemplate();
        //инициализируем шаблон, а затем получаем название и расположение
        $template = & $this->GetTemplate();
        $this->arResult["TEMPLATE_FILE"] = $template->GetFile();
        $this->arResult["TEMPLATE_FOLDER"] = $template->GetFolder();

        #Данные пользователя (Если зарегистрирован)
        if($USER->IsAuthorized()){
            $rsUser = CUser::GetByID($USER->GetID());
            $this->arResult["USER"] = $rsUser->Fetch();                  
        }
        
        #Данные о товаре
        if($this->arParams["PRODUCT_IBLOCK_ID"] and $this->arParams["PRODUCT_ID"]){
            $array_list = CIBlockElement::GetList(
                array("SORT"=>"ASC"), 
                array("IBLOCK_ID"=>$this->arParams["PRODUCT_IBLOCK_ID"],"ID"=>$this->arParams["PRODUCT_ID"],"ACTIVE" => "Y"), 
                false, 
                false,
                array("IBLOCK_ID","ID","NAME") 
            );
        	while($ob = $array_list->GetNextElement()){
        		$this->arResult["PRODUCT"] = $ob->GetFields();
        	}
        }

        #Получаем данные отправленные пользователем с формы
        $request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();
        
        //Сообщения с редиректа
        if($request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]){ $this->MessageSend = explode(";", $request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]); }
        if($request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]){ $this->MessageError = explode(";", $request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]); }
        
        $this->arResult["REQUEST"]["PROP"] = $request->getPost("PROP");
        $this->arResult["REQUEST"]["FEP_SUBMIT"] = $request->getPost("FEP_SUBMIT");

        if($request->isPost() && $this->arResult["REQUEST"]["FEP_SUBMIT"] && $this->arResult["REQUEST"]["FEP_SUBMIT"] != "" ){
            #CAPTCHA
            if($this->arParams["USE_CAPTCHA"] == "Y"){
                $path = Application::getDocumentRoot()."/bitrix/modules/main/classes/general/captcha.php";
                if (file_exists($path)) {
                    include_once(Application::getDocumentRoot()."/bitrix/modules/main/classes/general/captcha.php");
        			$captcha_code = $request -> getPost("captcha_sid");
        			$captcha_word = $request -> getPost("captcha_word");
        			$cpt = new CCaptcha();
        			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
        			if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0){
        				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass)){
                            array_push($this->MessageError, Loc::getMessage('FEP_CAPTCHA_WRONG') );
        				}
        			}else{
                        array_push($this->MessageError, Loc::getMessage('FEP_CAPTHCA_EMPTYE') );
        			}
                }
            }

            #Проверяем на обязательные поля
            $this->getPropertyRequired();
            
            if(count($this->MessageError) == 0){
                #Назваие в транслите
                $title = "Заявка на товара ID=".$this->arResult["PRODUCT"]["ID"]. " (".$this->arResult["PRODUCT"]["NAME"].")";
                $arParams_trans = array("replace_space"=>"-","replace_other"=>"-");
                $trans = Cutil::translit($title,"ru",$arParams_trans);

                $arLoadProductArray = Array(
                	"IBLOCK_ID"          => $this->arParams['IBLOCK_ID'],
                	"NAME"               => $title,
                    "CODE"               => $trans.'-'.mktime(),
                	"ACTIVE"             => "N",
                	"PREVIEW_TEXT"       => "",
                	"DETAIL_TEXT"	     => "",
                	"PROPERTY_VALUES"    => array(
                        "PRODUCT_ID"     => $this->arResult["PRODUCT"]["ID"],
                        "PRODUCT_NAME"   => $this->arResult["PRODUCT"]["NAME"],
                        "USER_ID"        => $this->arResult["USER"]["ID"],
                        "USER_NAME"      => $this->arResult["REQUEST"]["PROP"]["USER_NAME"],
                        "USER_NUMBER"    => $this->arResult["REQUEST"]["PROP"]["USER_NUMBER"]
                    ),
                	"DATE_ACTIVE_FROM" => date("d.m.Y H:i:s"),
                    "DETAIL_PICTURE" => "",
                );


                if($PRODUCT_ID = $el->Add($arLoadProductArray)){
                    array_push($this->MessageSend, Loc::getMessage('FEP_SEND_SAVE') );
                    
                    #Отправляем письмо админу           
                    $arMailFields = array(
                        "PRODUCT_ID"     => $this->arResult["PRODUCT"]["ID"],
                        "PRODUCT_NAME"   => $this->arResult["PRODUCT"]["NAME"],
                        "USER_NAME"      => $this->arResult["REQUEST"]["PROP"]["USER_NAME"],
                        "USER_NUMBER"    => $this->arResult["REQUEST"]["PROP"]["USER_NUMBER"],
                        "DATE"           => date("d.m.Y H:i:s")
                    );

                    $result = CEvent::Send('FEEDBACK_EXCHANGE_PRODUCT', SITE_ID, $arMailFields);

                    if($result){
                        array_push($this->MessageSend, Loc::getMessage('FEP_SEND_DONE') );
                        
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
                        
                    }else{
                        array_push($this->MessageError, Loc::getMessage('FEP_ERROR_SEND_ELEMENT') );
                    }

                }else{
                    array_push($this->MessageError, Loc::getMessage('FEP_ERROR_ADD_ELEMENT') );
                }
            }
        }

        #CAPTCHA
        if($this->arParams["USE_CAPTCHA"] == "Y"){
            $this->arResult["capCode"] =  htmlspecialchars($APPLICATION->CaptchaGetCode()); 
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
            $this->arResult["COMPONENT_ID"] = 'FEP';
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