<?php
if( !defined( 'B_PROLOG_INCLUDED' ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

class CatalogLikedLine extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $result = array(
            "PATH_TO_PAGE" => $params["PATH_TO_PAGE"] ? $params["PATH_TO_PAGE"] : "/personal/otlozhennye-tovary/",
        );

        return $result;
    }
    
    protected function getResult()
    {
        #jquery
        CJSCore::Init(array("jquery"));

        $this->InitComponentTemplate();

        $template = & $this->GetTemplate();
        $this->arResult["TEMPLATE_FILE"] = $template->GetFile();
        $this->arResult["TEMPLATE_FOLDER"] = $template->GetFolder();
        $this->arResult["PATH"] = $this->GetPath();
        
        if( count($_SESSION["LIKED_PRODUCTS"]) > 0 ){
            $this->arResult["PRODUCTS_COUNT"] = count($_SESSION["LIKED_PRODUCTS"]);
        }else{
            $this->arResult["PRODUCTS_COUNT"] = 0;
        }
        
        if($this->arParams["PATH_TO_PAGE"]){
            $this->arResult["PATH_TO_PAGE"] = $this->arParams["PATH_TO_PAGE"];
        }
    }

    public function executeComponent()
    {
		try{
            $this -> includeComponentLang('class.php');
            $this -> getResult();

            $this->includeComponentTemplate();
		}catch (Exception $e){
			ShowError($e->getMessage());
		}
    }
};