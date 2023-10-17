<?php

Class webtu_catalog extends CModule
{
    var $MODULE_ID = "webtu.catalog";
    var $MODULE_VERSION = "0.1";
    var $MODULE_VERSION_DATE = "";
    var $MODULE_NAME = "Технологии успеха: каталог";
    var $MODULE_DESCRIPTION = "";
    var $MODULE_CSS;
    var $FOLDER = "webtu.catalog";

    function InstallFiles($arParams = array())
    {
        /*CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->FOLDER."/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/itsocnet", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->FOLDER."/install/interfaces", $_SERVER["DOCUMENT_ROOT"]."/local/interfaces", true, true);*/
        return true;
    }

    function UnInstallFiles()
    {
        /*DeleteDirFilesEx("/bitrix/components/icatalog/catalog.favourites.list");
        DeleteDirFilesEx("/bitrix/components/icatalog/catalog.favourites.add");
        DeleteDirFilesEx("/local/interfaces/favourites.php");*/
        return true;
    }

    function getSqlFiles()
    {
        $files = scandir($_SERVER["DOCUMENT_ROOT"]."/local/modules/".$this->FOLDER."/install/sql");
        $result = array();

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;

            $filepath = $_SERVER["DOCUMENT_ROOT"]."/local/modules/".$this->FOLDER."/install/sql/".$file;
            $filename = explode('.', $file);
            $filename = $filename[0];

            $row = array(
                'filepath' => $filepath,
                'filename' => $filename,
            );

            $result[] = $row;
        }

        return $result;
    }

    function createGeotargetingIblock()
    {
        $iblock = new CIBlock;

        $fields = Array(
            "ACTIVE" => "Y",
            "NAME" => "Геотаргетинг",
            "CODE" => "webtu_geotargeting",
            "LIST_PAGE_URL" => "#",
            "DETAIL_PAGE_URL" => "#",
            "IBLOCK_TYPE_ID" => "webtu_catalog",
            "SITE_ID" => array("s1"),
            "SORT" => "500",
            "GROUP_ID" => array("2"=>"D", "3"=>"R")
        );

        $iblockId = $iblock->Add($fields);

        if(!$iblockId) {
            return $this->rollback($iblock);
        }

        $fields = Array(
            "NAME" => "Широта",
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => "LATITUDE",
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => $iblockId,
        );

        $iblockproperty = new CIBlockProperty;
        $propertyId = $iblockproperty->Add($fields);

        if(!$propertyId) {
            return $this->rollback($propertyId);
        }

        $fields = Array(
            "NAME" => "Долгота",
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => "LONGITUDE",
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => $iblockId,
        );

        $propertyId = $iblockproperty->Add($fields);

        if(!$propertyId) {
            return $this->rollback($propertyId);
        }

        COption::setOptionInt($this->MODULE_ID, 'geotargeting_iblock_id', $iblockId);

        return true;
    }

    function createIblocks()
    {
        global $DB;

        CModule::IncludeModule('iblock');

        $DB->StartTransaction();

        $fields = array(
            'ID'        => 'webtu_catalog',
            'SECTIONS'  => 'Y',
            'IN_RSS'    => 'N',
            'SORT'      => 500,
            'LANG'  => array(
                'en' => array(
                    'NAME' => 'Catalog extensions',
                    'SECTION_NAME' => 'Folders',
                    'ELEMENT_NAME' => 'Elements',
                ),
                'ru' => array(
                    'NAME' => 'Расширение каталога',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элементы',
                ),
            )
        );

        $iblockType = new CIBlockType;
        $result = $iblockType->Add($fields);

        if(!$result) {
            return $this->rollback($iblockType);
        }

        if (!$this->createGeotargetingIblock()) {
            return false;
        }

        $DB->Commit();
    }

    function removeIblocks()
    {
        global $DB;

        CModule::IncludeModule('iblock');

        $DB->StartTransaction();

        $iblockId = CIBlock::GetList(array(), array("CODE" => "webtu_geotargeting"));
        $iblockId = $iblockId->GetNext();
        $iblockId = $iblockId['ID'];

        $propertyId = CIBlockProperty::GetList(array(), array("CODE" => "LATITUDE", "IBLOCK_ID" => $iblockId));
        $propertyId = $propertyId->GetNext();
        $propertyId = $propertyId['ID'];

        CIBlockProperty::Delete($propertyId);

        $propertyId = CIBlockProperty::GetList(array(), array("CODE" => "LONGITUDE", "IBLOCK_ID" => $iblockId));
        $propertyId = $propertyId->GetNext();
        $propertyId = $propertyId['ID'];

        CIBlockProperty::Delete($propertyId);

        CIBlock::Delete($iblockId);
        CIBlockType::Delete('webtu_catalog');

        $DB->Commit();
    }

    function rollback($dbResult)
    {
        global $DB;

        $DB->Rollback();
        CAdminMessage::ShowNote("Error: {$dbResult->LAST_ERROR}<br>");

        return false;
    }

    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION, $DB;

        $files = $this->getSqlFiles();

        foreach ($files as $file) {
            if (!$DB->TableExists($file['filename'])) {
                $DB->query(file_get_contents($file['filepath']));
            }
        }

        $this->createIblocks();

        //$this->InstallFiles();
        RegisterModule("webtu.catalog");
        echo CAdminMessage::ShowNote("Модуль ".$this->MODULE_NAME." установлен");
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION, $DB;

        $files = $this->getSqlFiles();

        foreach ($files as $file) {
            if ($DB->TableExists($file['filename'])) {
                $DB->query("DROP TABLE `{$file['filename']}`;");
            }
        }

        $this->removeIblocks();

        COption::RemoveOption($this->MODULE_ID, 'geotargeting_iblock_id');

        //$this->UnInstallFiles();
        UnRegisterModule("webtu.catalog");
        echo CAdminMessage::ShowNote("Модуль ".$this->MODULE_NAME." удален");
    }
}
?>
