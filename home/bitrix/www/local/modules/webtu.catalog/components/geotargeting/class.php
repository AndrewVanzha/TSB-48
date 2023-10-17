<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Page\Asset;

class WebtuGeotargeting extends CBitrixComponent
{
    public function executeComponent()
    {
        Asset::getInstance()->addJs('/local/modules/webtu.catalog/js/jquery.cookie.js');

        CModule::IncludeModule('iblock');

        $this->arResult = array();
        $this->arResult['CITIES'] = array();

        if (isset($_COOKIE['WEBTU_GEOTARGETING_CITY'])) {
            $cityId = (int)$_COOKIE['WEBTU_GEOTARGETING_CITY'];
        } else {
            $cityId = -1;
        }

        $iblockId = COption::GetOptionInt('webtu.catalog', 'geotargeting_iblock_id');

        $cities = CIblockElement::GetList(
            array(
                "SORT" => "DESC",
                "NAME" => "ASC"
            ),
            array(
                "IBLOCK_ID" => $iblockId,
                "ACTIVE" => "Y",
            ),
            false,
            false,
            array(
                "ID",
                "IBLOCK_ID",
                "NAME",
                "PROPERTY_LATITUDE",
                "PROPERTY_LONGITUDE",
            )
        );

        while ($city = $cities->Fetch()) {
            if ($city['ID'] == $cityId) {
                $city['SELECTED'] = true;
                $this->arResult['CURRENT_CITY'] = $city;
            } else {
                $city['SELECTED'] = false;
            }

            $this->arResult['CITIES'][] = $city;
        }

        $this->includeComponentTemplate();

        return $this->arResult;
    }
}