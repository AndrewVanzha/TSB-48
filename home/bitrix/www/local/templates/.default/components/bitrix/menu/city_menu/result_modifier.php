<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult))
	return;

$arSectionsList = array();
$arCityList = array();
if (CModule::IncludeModule("iblock"))
{
    $arFilter = array("IBLOCK_ID"=>218, "ACTIVE"=>"Y");	// Инфоблок Валюты с условиями
    //$arSelect = array();
    $arSelect = array("ID", "NAME", "SECTION_PAGE_URL", "CODE");
    $dbSections = CIBlockSection::GetList(
        array("SORT"=>"ASC"),
        $arFilter,
        false,
        $arSelect,
    );
    while($arSections = $dbSections->GetNext())
    {
        $arSectionsList[] = $arSections;
    }

    $arFilter = array("IBLOCK_ID"=>114, "ACTIVE"=>"Y");	// Инфоблок Банк в городах
    //$arSelect = array();
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", "CODE");
    $rsList = CIBlockElement::GetList(
        array("SORT" => "ASC"),
        $arFilter,
        false,
        false,
        $arSelect,
        //array()
    );
    while ($arList = $rsList->Fetch()) {
        $arCityList[] = $arList;
    }
    //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_$arSectionsList.json', json_encode($arSectionsList));
}

for ($ii=0; $ii<count($arResult); $ii++) {
    foreach ($arSectionsList as $section) {
        if ($arResult[$ii]['TEXT'] == $section['NAME']) {
            $arResult[$ii]['SECTION_ID'] = $section['ID'];
            $arResult[$ii]['SECTION_CODE'] = $section['CODE'];
        }
    }
    foreach ($arCityList as $elem) {
        if ($arResult[$ii]['TEXT'] == $elem['NAME']) {
            $arResult[$ii]['SESSION_ID'] = $elem['ID'];
            $arResult[$ii]['DETAIL_PAGE_URL'] = $elem['DETAIL_PAGE_URL'];
        }
    }
}

unset($arSectionsList);
unset($arCityList);
