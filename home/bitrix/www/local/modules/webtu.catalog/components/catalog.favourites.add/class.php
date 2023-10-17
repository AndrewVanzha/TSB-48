<?
use \Bitrix\Main;
use \Bitrix\Main\Error;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Iblock\Component\ElementList;
use \Bitrix\Catalog;
use \Webtu\Catalog\Facades\FavouriteFacade as Manager;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class CatalogFavouritesAddComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		\Bitrix\Main\Loader::includeModule('webtu.catalog');
		$this->arResult['CHECKED'] = Manager::check($this->arParams['ID']);
		$this->IncludeComponentTemplate();

		return $this->arResult;
	}
}