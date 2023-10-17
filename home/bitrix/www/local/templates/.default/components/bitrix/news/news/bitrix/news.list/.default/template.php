<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$yearsPre = CIblockElement::GetList(array(), array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE_DATE" => "Y"), false, false, array("DATE_ACTIVE_FROM"));
$years = array();

while ($year = $yearsPre->fetch()) {
    $year = date('Y', strtotime($year['DATE_ACTIVE_FROM']));
    $years[$year] = $year;
}

sort($years);
$years = array_reverse($years);

if (isset($_SESSION['year-filter'])) {
    $currentYear = $_SESSION['year-filter'];
} else {
    $currentYear = 'all';
}

?>
<div class="news-filter select-box">

	<select name="year-filter">

		<option value="all" <? if ($currentYear == 'all') { ?>selected<? } ?>>
			За все время
		</option>
        
        <? foreach ($years as $year) { ?>
            <option value="<?=$year?>" <? if ($currentYear == $year) { ?>selected<? } ?>>
                За <?=$year?> год
            </option>
        <? } ?>

	</select>

</div>

<? foreach($arResult["ITEMS"] as $arItem) { ?>
    <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
    <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
    <article class="news-entry content-area page-section clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

        <? if ($arParams["DISPLAY_PICTURE"] != 'N') : ?>
            <? if ($arItem['PREVIEW_PICTURE']['SRC']) { ?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="content-area_image">
                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                </a>
            <? } else { ?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="content-area_image">
                    <img src="/local/templates/.default/img/no_photo.jpg" alt="<?=$arItem['NAME']?>">
                </a>
            <? } ?>
        <? endif; ?>

        <div class="content-area_text">
    
            <p>
                <time class="page-date mi--calendar mi">
                    <?=$arItem['DISPLAY_ACTIVE_FROM']?>
                </time>
            </p>
    
            <h2 class="page-title--3 page-title">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <?=$arItem['NAME']?>
                </a>
            </h2>
    
            <p>
                <?=$arItem['PREVIEW_TEXT']?>
            </p>
    
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="read-more--small read-more mi--arrow-right-1 mi">
                <span>
                    Подробнее
                </span>
            </a>
    
        </div>
    
    </article>
<? } ?>
<?=$arResult["NAV_STRING"]?>

