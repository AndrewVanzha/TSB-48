<?php
if( !defined( 'B_PROLOG_INCLUDED' ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;
//use \Webtu\Auction\Handler;

class CatalogAddGood extends CBitrixComponent
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
            'USE_CAPTCHA'            => $params['USE_CAPTCHA']            ? $params['USE_CAPTCHA']            : 'N',
        );

        return $result;
    }

    #проверяет подключение необходиимых модулей
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')){
            throw new Main\LoaderException(Loc::getMessage('CAG_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "iblock")) );
        }
        if (!Loader::includeModule('catalog')){
            throw new Main\LoaderException(Loc::getMessage('CAG_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "catalog")) );
        }
    }

    #Получим данные пользователяu
    protected function getUserInfo()
    {
        global $USER;

        #Данные пользователя (Если зарегистрирован)
        if($USER->IsAuthorized()){
            $rsUser = CUser::GetByID($USER->GetID());
            $this->arResult["USER"] = $rsUser->Fetch();

            if ($USER->IsAdmin() || $this->arResult["USER"]["ID"]) {

                $this->arResult["TERMS"] = false;
                $this->arResult["IS_ADMIN"] = true;

            } else {

                $this->arResult["TERMS"] = true;
                $this->arResult["IS_ADMIN"] = false;
            }

        } else {
            //array_push($this->MessageError, Loc::getMessage("CAG_USER_NOT_AUTHORIZED") );
            $this->arResult["CAN_ADD"] = false;
        }

    }

    #Проверяем на обязательные поля
    protected function getPropertyRequired()
    {
        $arResult = array(
            "NAME",
            "COUNTRY",
            "METAL",
            "PROBA",
            "RELEASE_YEAR",
            "MORE_PHOTO",
            "WEIGHT",
            "PRICE"
        );

        if ($this->arResult["TERMS"]) $arResult[] = "PRIVACE_POLICE";

        foreach($arResult as $item){
            if( empty($this->arResult["REQUEST"]["PROP"][$item]) ){
                array_push($this->MessageError, Loc::getMessage('CAG_ERROR_'.$item) );
            }
        }

        return $arResult;
    }

    #Проверка на валидность данных
    protected function validityProperties()
    {
        foreach ($this->arResult["REQUEST"]["PROP"] as $key => $value) {

            #Валидность года выпуска
            if ( $key == "RELEASE_YEAR") {
                if ( strlen($value) < 4 || strlen($value) > 4 ) {
                    array_push($this->MessageError, Loc::getMessage('CAG_ERROR_RELEASE_YEAR_FORMAT_1') );
                }
                elseif ( $value > date('Y') ) {
                    array_push($this->MessageError, Loc::getMessage('CAG_ERROR_RELEASE_YEAR_FORMAT_2', Array ("#YEAR#" => "> ".date('Y'))) );
                }
                elseif ( $value < 1812) {
                    array_push($this->MessageError, Loc::getMessage('CAG_ERROR_RELEASE_YEAR_FORMAT_2', Array ("#YEAR#" => "< 1812")) );
                }
            }
            #Валидность цен
            elseif ( $key == "PRICE") {
                if ( !is_int($value) && $value <= 0 ) {
                    array_push($this->MessageError, Loc::getMessage('CAG_ERROR_STARTING_PRICE_FORMAT' ));
                }
            }

        }
    }

    #Обработка картинок
    protected function treatmentImages()
    {
        foreach ($this->arResult["REQUEST"]["PROP"]["MORE_PHOTO"] as $n => $fileBody) {

            #Генерируем рандомное название файла
            $fileName = md5(time() . $n);

            #Определяем формат файла
            preg_match('#data:image\/(png|jpg|jpeg|gif);#', $fileBody, $fileTypeMatch);
            $fileType = $fileTypeMatch[1];

            #Декодируем содержимое файла
            $fileBody = preg_replace('#^data.*?base64,#', '', $fileBody);
            $fileBody = base64_decode($fileBody);

            $arImage = Array(
                "name"      => $fileName.'.'.$fileType,
                "type"      => $fileType,
                "MODULE_ID" => "iblock",
                "content"   => $fileBody
            );

            if ( $GLOBALS["IMAGES_ID"][$n] > 0 ) {
                $arImage["del"] = "Y";
                $arImage["old_file"] = $GLOBALS["IMAGES_ID"][$n];

            }

            $fid = CFile::SaveFile($arImage, "/tmp/addgoog");

            if ($n == 0) {
                $file_src = CFile::GetPath($fid);
                $this->arResult["IMAGES"]["DETAIL_PICTURE"] = CFile::MakeFileArray($file_src);
            }
            else $this->arResult["IMAGES"]["MORE_PHOTO"][] = $fid;

        }


    }

    protected function getResult()
    {
        global $APPLICATION;
        $el = new CIBlockElement;

        #Получим данные пользователя
        $this->getUserInfo();

        if(count($this->MessageError) == 0) {

            #Получим значения свойств тип список из каталога
            $property_enums = CIBlockPropertyEnum::GetList(
                Array(
                    "VALUE" => "ASC"
                ),
                Array(
                    "IBLOCK_ID" => "6",
                    "CODE" => Array("COUNTRY", "METAL", "PROBA", "RELEASE_YEAR")
                )
            );

            while($enum_fields = $property_enums->GetNext()) {
                $this->arResult["PROPERTY_LIST"][$enum_fields["PROPERTY_CODE"]][$enum_fields["ID"]] = $enum_fields["VALUE"];
            }

            #Получаем данные отправленные пользователем с формы
            $request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();

            #Сообщения с редиректа
            if($request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]){ $this->MessageSend = explode(";", $request["MESSAGE_SEND_".$this->arResult["COMPONENT_ID"]]); }
            if($request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]){ $this->MessageError = explode(";", $request["MESSAGE_ERROR_".$this->arResult["COMPONENT_ID"]]); }

            $this->arResult["REQUEST"]["NAME"] = $request->getPost("NAME");
            $this->arResult["REQUEST"]["PROP"] = $request->getPost("PROP");
            $this->arResult["REQUEST"]["CAG_SUBMIT"] = $request->getPost("CAG_SUBMIT");

            if ($request->isPost() && $this->arResult["REQUEST"]["CAG_SUBMIT"] && $this->arResult["REQUEST"]["CAG_SUBMIT"] != "" ) {

                #Проверяем на обязательные поля
                $this->getPropertyRequired();

                #Проверка на валидность данных
                $this->validityProperties();

                if( count($this->MessageError) == 0 ){

                    #Обработка картинок
                    $this->treatmentImages();

                    #Назваие в транслите
                    $title = $this->arResult["REQUEST"]["PROP"]["NAME"];
                    $arParams_trans = array("replace_space"=>"-","replace_other"=>"-");
                    $trans = Cutil::translit($title,"ru", $arParams_trans);

                    if ( $this->arResult["IS_ADMIN"] ) {
                        // if ( (strtotime($this->arResult["REQUEST"]["PROP"]["DATE_ACTIVE"]) - strtotime(date('Y-m-d')))/86400 > 0 ) {
                            $SECTION_ID = $this->arResult["SECTION_ID"];
                        // }
                        // else {
                        //     $SECTION_ID = $this->arResult["MODULE_SETTINGS"]["AUCTION"]["SECTION_ID_ACTIVE"];
                        // }

                        $ACTIVE = "Y";
                        $CAG_SAVE = "CAG_SEND_SAVE_ADMIN";
                    }
                    else {
                        $SECTION_ID = $this->arResult["SECTION_ID"];
                        $ACTIVE = "N";
                        $CAG_SAVE = "CAG_SEND_SAVE";
                    }

                    $arLoadProductArray = Array(
                        "IBLOCK_ID"          => "18",
                        "IBLOCK_SECTION_ID"  => "",
                        "NAME"               => $title,
                        "CODE"               => $trans,
                        "ACTIVE"             => $ACTIVE,
                        "PREVIEW_TEXT"       => "",
                        "DETAIL_TEXT"	     => "",
                        "PROPERTY_VALUES"    => array(
                            "SERIES"         => $this->arResult["REQUEST"]["PROP"]["SERIES"],
                            "COUNTRY"        => $this->arResult["REQUEST"]["PROP"]["COUNTRY"],
                            "METAL"          => $this->arResult["REQUEST"]["PROP"]["METAL"],
                            "PROBA"          => $this->arResult["REQUEST"]["PROP"]["PROBA"],
                            "WEIGHT"         => $this->arResult["REQUEST"]["PROP"]["WEIGHT"],
                            "RELEASE_YEAR"   => $this->arResult["REQUEST"]["PROP"]["RELEASE_YEAR"],
                            "MORE_PHOTO"     => $this->arResult["IMAGES"]["MORE_PHOTO"],
                            "USER_ID"        => $this->arResult["USER"]["ID"],
                            "PRICE"          => $this->arResult["REQUEST"]["PROP"]["PRICE"],
                            "NOMINAL"        => $this->arResult["REQUEST"]["PROP"]["NOMINAL"],
                            "QUALITY"        => $this->arResult["REQUEST"]["PROP"]["QUALITY"]

                        ),
                        "DATE_ACTIVE_FROM"   => date("d.m.Y H:i:s"),
                        "PREVIEW_PICTURE"    => $this->arResult["IMAGES"]["DETAIL_PICTURE"],
                        "DETAIL_PICTURE"     => $this->arResult["IMAGES"]["DETAIL_PICTURE"],
                    );

                    $id_prop = array_search($this->arResult["REQUEST"]["PROP"]["RELEASE_YEAR"],  $this->arResult["PROPERTY_LIST"]["RELEASE_YEAR"]);

                    if ( !is_int($id_prop) ) {
                        if ( $id_prop = CIBlockPropertyEnum::Add(array("PROPERTY_ID"=> 47, "VALUE"=> $this->arResult["REQUEST"]["PROP"]["RELEASE_YEAR"])) ) {
                            $arLoadProductArray["PROPERTY_VALUES"]["RELEASE_YEAR"] = $id_prop;
                        }
                    }
                    else {
                        $arLoadProductArray["PROPERTY_VALUES"]["RELEASE_YEAR"] = $id_prop;
                    }

                    if($PRODUCT_ID = $el->Add($arLoadProductArray)){


                        array_push($this->MessageSend, Loc::getMessage($CAG_SAVE));

                        $arMailFields = array(
                            "NAME"           => $this->arResult["REQUEST"]["PROP"]["NAME"],
                            "ID"             => $PRODUCT_ID,
                            "SERIES"         => $this->arResult["REQUEST"]["PROP"]["SERIES"],
                            "COUNTRY"        => $this->arResult["REQUEST"]["PROP"]["COUNTRY"],
                            "METAL"          => $this->arResult["REQUEST"]["PROP"]["METAL"],
                            "PROBA"          => $this->arResult["REQUEST"]["PROP"]["PROBA"],
                            "WEIGHT"         => $this->arResult["REQUEST"]["PROP"]["WEIGHT"],
                            "RELEASE_YEAR"   => $this->arResult["REQUEST"]["PROP"]["RELEASE_YEAR"],
                            "PRICE"          => $this->arResult["REQUEST"]["PROP"]["PRICE"],
                            "NOMINAL"        => $this->arResult["REQUEST"]["PROP"]["NOMINAL"],
                            "QUALITY"        => $this->arResult["REQUEST"]["PROP"]["QUALITY"]

                        );

                        $result = CEvent::Send('CATALOG_ADD_GOOD', SITE_ID, $arMailFields);

                        if ($result) {
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
                    } else {
                        array_push($this->MessageError, $el->LAST_ERROR );
                        array_push($this->MessageError, Loc::getMessage('CAG_ERROR_ADD_ELEMENT') );
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
            $this->arResult["COMPONENT_ID"] = 'AD-CAT';
            $this->arResult["CAN_ADD"] = true;
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
