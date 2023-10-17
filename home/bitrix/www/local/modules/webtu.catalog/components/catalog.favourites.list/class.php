<?
use \Bitrix\Main;
use \Bitrix\Main\Error;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Iblock\Component\ElementList;
use \Bitrix\Catalog;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

if (!\Bitrix\Main\Loader::includeModule('iblock'))
{
	ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
	return;
}

class CatalogFavouritesListComponent extends ElementList
{
	public function __construct($component = null)
	{
		parent::__construct($component);
		$this->setExtendedMode(true)->setMultiIblockMode(true)->setPaginationMode(false);
	}

	public function onPrepareComponentParams($params)
	{
		$params['PRODUCT_DISPLAY_MODE'] = isset($params['PRODUCT_DISPLAY_MODE']) && $params['PRODUCT_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';
		$params['IBLOCK_MODE'] = isset($params['IBLOCK_MODE']) && $params['IBLOCK_MODE'] === 'single' ? 'single' : 'multi';

		if ($params['IBLOCK_MODE'] === 'single' && (int)$params['IBLOCK_ID'] > 0)
		{
			$params['SHOW_PRODUCTS'] = array((int)$params['IBLOCK_ID'] => true);
		}

		$params = parent::onPrepareComponentParams($params);

		if ($params['PAGE_ELEMENT_COUNT'] <= 0)
		{
			$params['PAGE_ELEMENT_COUNT'] = 9;
		}

		return $params;
	}

	protected function checkModules()
	{
		if ($success = parent::checkModules())
		{
			if (!$this->useCatalog)
			{
				$this->abortResultCache();
				$this->errorCollection->setError(new Error(Loc::getMessage('CATALOG_MODULE_NOT_INSTALLED'), self::ERROR_TEXT));
				$success = false;
			}
		}

		return $success;
	}

	protected function getProductIds()
	{
		global $USER, $DB;
		\Bitrix\Main\Loader::includeModule('webtu.catalog');

		return \Webtu\Catalog\Facades\FavouriteFacade::all();
	}
}