<?php
if( !defined( 'B_PROLOG_INCLUDED' ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;
use \Webtu\Auction\Handler;

class AuctionAddLot extends CBitrixComponent
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
            throw new Main\LoaderException(Loc::getMessage('AAL_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "iblock")) );
        }
        if (!Loader::includeModule('catalog')){
            throw new Main\LoaderException(Loc::getMessage('AAL_NOT_INSTALLED_IBLOCK', Array ("#ID#" => "catalog")) );
        }
        if (!Loader::includeModule("webtu.auction"))
        {
            throw new Main\LoaderException(Loc::getMessage("AAL_NOT_INSTALLED_IBLOCK", Array ("#ID#" => "webtu.auction")) );
        }
    }
    #Плолучим настройки из модуля webtu.auction
    protected function getSettingsModule()
    {
        #Получить все настройки модуля
        $this->arResult["MODULE_SETTINGS"] = Handler::getOptions();

        #Проверка на обязательные поля
        if(empty($this->arResult["MODULE_SETTINGS"]["AUCTION"]["IBLOCK_ID"])){ array_push($this->MessageError, Loc::getMessage("AAL_NONE_MODULE_SETTINGS_AUCTIONS_IBLOCK_ID") ); }
        if(empty($this->arResult["MODULE_SETTINGS"]["AUCTION"]["SECTION_ID_ACTIVE"])){ array_push($this->MessageError, Loc::getMessage("AAL_NONE_MODULE_SETTINGS_AUCTIONS_SECTION_ID_ACTIVE") ); }
        if(empty($this->arResult["MODULE_SETTINGS"]["AUCTION"]["SECTION_ID_PLAN"])){ array_push($this->MessageError, Loc::getMessage("AAL_NONE_MODULE_SETTINGS_AUCTIONS_SECTION_ID_PLAN") ); }
    }

    #Получим данные пользователяu
    protected function getUserInfo()
    {
        global $USER;

        #Данные пользователя (Если зарегистрирован)
        if($USER->IsAuthorized()){
            $rsUser = CUser::GetByID($USER->GetID());
            $this->arResult["USER"] = $rsUser->Fetch();

            if ($USER->IsAdmin() || $this->arResult["USER"]["ID"] == $this->arResult["MODULE_SETTINGS"]["SETTINGS"]["BANK_USER_ID"]) {

                $this->arResult["TERMS"] = false;
                $this->arResult["IS_ADMIN"] = true;

            } else {

                #Проверяем уровень доступа пользователя к аукциону
                $arGroups = $USER->GetUserGroupArray();
                foreach ($arGroups as $groupID) {
                    if ($groupID == $this->arResult["MODULE_SETTINGS"]["SETTINGS"]["GROUP_ID_BLACK"] || $groupID == $this->arResult["MODULE_SETTINGS"]["SETTINGS"]["GROUP_ID_AVERAGE"]) {

                        $this->arResult["CAN_ADD"] = false;
                        array_push($this->MessageError, Loc::getMessage("AAL_USER_NONE_ADD_LOT") );
                        break;
                    }
                }
                $this->arResult["TERMS"] = true;
                $this->arResult["IS_ADMIN"] = false;
            }

        } else {
            array_push($this->MessageError, Loc::getMessage("AAL_USER_NOT_AUTHORIZED") );
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
            "QUALITY",
            "NOMINAL",
            "RELEASE_YEAR",
            "WEIGHT",
            "STEP_RATE",
            "MORE_PHOTO",
            "DATE_ACTIVE",
            "DATE_COMPLETED",
            "STARTING_PRICE"
        );

        if ($this->arResult["TERMS"]) $arResult[] = "PRIVACE_POLICE";

        foreach($arResult as $item){
            if( empty($this->arResult["REQUEST"]["PROP"][$item]) ){
                array_push($this->MessageError, Loc::getMessage('AAL_ERROR_'.$item) );
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
                    array_push($this->MessageError, Loc::getMessage('AAL_ERROR_RELEASE_YEAR_FORMAT_1') );
                }
                elseif ( $value > date('Y') ) {
                    array_push($this->MessageError, Loc::getMessage('AAL_ERROR_RELEASE_YEAR_FORMAT_2', Array ("#YEAR#" => "> ".date('Y'))) );
                }
                elseif ( $value < 1812) {
                    array_push($this->MessageError, Loc::getMessage('AAL_ERROR_RELEASE_YEAR_FORMAT_2', Array ("#YEAR#" => "< 1812")) );
                }
            }
            elseif ( $key == "STEP_RATE" && $value < $this->arResult["MODULE_SETTINGS"]["SETTINGS"]["MIN_STEP"] ) {
                array_push($this->MessageError, Loc::getMessage('AAL_ERROR_STEP_RATE_FORMAT_1', Array ("#MIN_STEP#" => $this->arResult["MODULE_SETTINGS"]["SETTINGS"]["MIN_STEP"])) );
            }

            #Валидность даты начала аукциона
            elseif ( $key == "DATE_ACTIVE" ) {

                #Получаем текущую дату
                $current_date = date('d.m.Y');

                $obj_current_date = new DateTime($current_date);

                if ( $this->arResult["IS_ADMIN"] ) {
                    $current_date = date_format($obj_current_date->add(new DateInterval('P1D')), 'd.m.Y');
                }
                else {
                    if ( $this->arResult["MODULE_SETTINGS"]["SETTINGS"]["MIN_DAY_MODERATION"] > 0 ) {
                        $current_date = date_format($obj_current_date->add(new DateInterval('P'.$this->arResult["MODULE_SETTINGS"]["SETTINGS"]["MIN_DAY_MODERATION"].'D')), 'd.m.Y');
                    }
                }

                $obj_date_active = new DateTime($value);
                $date_active = $obj_date_active->format('d.m.Y');

                if (strtotime($date_active) < strtotime($current_date)) {
                    array_push($this->MessageError, Loc::getMessage('AAL_ERROR_DATE_ACTIVE_FORMAT_1', Array ("#DATE#" => $current_date)) );
                    #Запоминаем дату начала аукциона
                    $this->arResult["DATE_ACTIVE"] = $current_date;
                } else {
                    #Запоминаем дату начала аукциона
                    $this->arResult["DATE_ACTIVE"] = $date_active;
                }
            }

            #Валидность даты аукциона аукциона
            elseif ( $key == "DATE_COMPLETED" ) {

                $date_active = $this->arResult["DATE_ACTIVE"];

                $obj_date_completed = new DateTime($value);
                $date_completed = $obj_date_completed->format('d.m.Y');

                if (strtotime($date_completed) <= strtotime($date_active)) {
                    array_push($this->MessageError, Loc::getMessage('AAL_ERROR_DATE_COMPLETED_FORMAT_1', Array ("#DATE#" => $date_active)) );
                }
                else {
                    #Получаем интервал в днях между датами
                    $interval = ( strtotime($date_completed) - strtotime($date_active) ) / 86400;

                    if ($this->arResult["MODULE_SETTINGS"]["SETTINGS"]["PERIOD_OF_VALIDITY"] > 0 && $interval > $this->arResult["MODULE_SETTINGS"]["SETTINGS"]["PERIOD_OF_VALIDITY"]) {
                        array_push($this->MessageError, Loc::getMessage('AAL_ERROR_DATE_COMPLETED_FORMAT_2', Array ("#INTERVAL#" => $this->arResult["MODULE_SETTINGS"]["SETTINGS"]["PERIOD_OF_VALIDITY"])) );
                    }
                }
            }

            #Валидность цен
            elseif ( $key == "STARTING_PRICE") {
                if ( !is_int($value) && $value <= 0 ) {
                    array_push($this->MessageError, Loc::getMessage('AAL_ERROR_STARTING_PRICE_FORMAT' ));
                }
            }
            elseif ( $key == "BLITZ_PRICE") {
                if ( strlen($value) > 0 ) {
                    if ( !is_int($value) && $value <= 0 ) {
                        array_push($this->MessageError, Loc::getMessage('AAL_ERROR_BLITZ_PRICE_FORMAT' ));
                    }

                    if ($value <= $this->arResult["REQUEST"]["PROP"]["STARTING_PRICE"] ) {
                        array_push($this->MessageError, Loc::getMessage('AAL_ERROR_BLITZ_PRICE_FORMAT_2' ));
                    }

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

            $fid = CFile::SaveFile($arImage, "/tmp/auction");

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

        #Получим настройки из модуля webtu.auction
        $this->getSettingsModule();

        #Получим данные пользователя
        $this->getUserInfo();

        if(count($this->MessageError) == 0) {

            #Получим значения свойств тип список
            $property_enums = CIBlockPropertyEnum::GetList(
                Array(
                    "VALUE" => "ASC"
                ),
                Array(
                    "IBLOCK_ID" => $this->arResult["MODULE_SETTINGS"]["AUCTION"]["IBLOCK_ID"],
                    "CODE" => Array("COUNTRY", "METAL", "PROBA", "QUALITY", "RELEASE_YEAR")
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

            $this->arResult["REQUEST"]["PROP"] = $request->getPost("PROP");
            $this->arResult["REQUEST"]["AAL_SUBMIT"] = $request->getPost("AAL_SUBMIT");

            if ($request->isPost() && $this->arResult["REQUEST"]["AAL_SUBMIT"] && $this->arResult["REQUEST"]["AAL_SUBMIT"] != "" ) {

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
                        if ( (strtotime($this->arResult["REQUEST"]["PROP"]["DATE_ACTIVE"]) - strtotime(date('Y-m-d')))/86400 > 0 ) {
                            $SECTION_ID = $this->arResult["MODULE_SETTINGS"]["AUCTION"]["SECTION_ID_PLAN"];
                        }
                        else {
                            $SECTION_ID = $this->arResult["MODULE_SETTINGS"]["AUCTION"]["SECTION_ID_ACTIVE"];
                        }

                        $ACTIVE = "Y";
                        $AAL_SAVE = "AAL_SEND_SAVE_ADMIN";
                    }
                    else {
                        $SECTION_ID = $this->arResult["MODULE_SETTINGS"]["AUCTION"]["SECTION_ID_PLAN"];
                        $ACTIVE = "N";
                        $AAL_SAVE = "AAL_SEND_SAVE";
                    }

                    $arLoadProductArray = Array(
                        "IBLOCK_ID"          => $this->arResult["MODULE_SETTINGS"]["AUCTION"]["IBLOCK_ID"],
                        "IBLOCK_SECTION_ID"  => $SECTION_ID,
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
                            "NOMINAL"        => $this->arResult["REQUEST"]["PROP"]["NOMINAL"],
                            "QUALITY"        => $this->arResult["REQUEST"]["PROP"]["QUALITY"],
                            "WEIGHT"         => $this->arResult["REQUEST"]["PROP"]["WEIGHT"],
                            "STEP_RATE"      => $this->arResult["REQUEST"]["PROP"]["STEP_RATE"],
                            "DATE_ACTIVE"    => date("d.m.Y", strtotime($this->arResult["REQUEST"]["PROP"]["DATE_ACTIVE"])),
                            "DATE_COMPLETED" => date("d.m.Y", strtotime($this->arResult["REQUEST"]["PROP"]["DATE_COMPLETED"])),
                            "STARTING_PRICE" => $this->arResult["REQUEST"]["PROP"]["STARTING_PRICE"],
                            "MORE_PHOTO"     => $this->arResult["IMAGES"]["MORE_PHOTO"],
                            "USER_ID"        => $this->arResult["USER"]["ID"],
                            "BLITZ_PRICE"    => $this->arResult["REQUEST"]["PROP"]["BLITZ_PRICE"]
                        ),
                        "DATE_ACTIVE_FROM"   => date("d.m.Y H:i:s"),
                        "PREVIEW_PICTURE"    => $this->arResult["IMAGES"]["DETAIL_PICTURE"],
                        "DETAIL_PICTURE"     => $this->arResult["IMAGES"]["DETAIL_PICTURE"],
                    );

                    $id_prop = array_search($this->arResult["REQUEST"]["PROP"]["RELEASE_YEAR"],  $this->arResult["PROPERTY_LIST"]["RELEASE_YEAR"]);

                    if ( !is_int($id_prop) ) {
                        if ( $id_prop = CIBlockPropertyEnum::Add(array("PROPERTY_ID"=> 123, "VALUE"=> $this->arResult["REQUEST"]["PROP"]["RELEASE_YEAR"])) ) {
                            $arLoadProductArray["PROPERTY_VALUES"]["RELEASE_YEAR"] = $id_prop;
                        }
                    }
                    else {
                        $arLoadProductArray["PROPERTY_VALUES"]["RELEASE_YEAR"] = $id_prop;
                    }

                    if($PRODUCT_ID = $el->Add($arLoadProductArray)){

                        #Добавление цены к добавленному товару
                        $arFields = array(
                            "ID"           => $PRODUCT_ID,
                            "VAT_ID"       => 1,
                            "VAT_INCLUDED" => "N"
                        );

                        if($hyt = CCatalogProduct::Add($arFields)){

                            $arPrice = Array(
                                "PRODUCT_ID"       => $PRODUCT_ID,
                                "CATALOG_GROUP_ID" => 1,
                                "PRICE"            => $this->arResult["REQUEST"]["PROP"]["STARTING_PRICE"],
                                "CURRENCY"         => "RUB"
                            );

                            CPrice::Add($arPrice);
                        }

                        array_push($this->MessageSend, Loc::getMessage($AAL_SAVE));

                        $arMailFields = array(
                            "NAME"       => $this->arResult["REQUEST"]["PROP"]["NAME"],
                            "ID"         => $PRODUCT_ID,
                            "IBLOCK_ID"  => $this->arResult["MODULE_SETTINGS"]["AUCTION"]["IBLOCK_ID"],
                            "SECTION_ID" => $SECTION_ID
                        );

                        $result = CEvent::Send('AUCTION_ADD_LOT', SITE_ID, $arMailFields);

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
                        array_push($this->MessageError, Loc::getMessage('AAL_ERROR_ADD_ELEMENT') );
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
            $this->arResult["COMPONENT_ID"] = 'AUC';
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