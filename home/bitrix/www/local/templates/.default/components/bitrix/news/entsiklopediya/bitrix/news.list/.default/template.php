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
?>

<? if (count($arResult["SECTIONS"]) > 1) { ?>
    <script>
        $('h1').remove();
    </script>
    <div class="content-header content-header-margin">
        <h1><?=$APPLICATION->ShowTitle()?></h1>
        <div class="filter-btn filter-btn-2 aligner">
            <? foreach ($arResult["SECTIONS"] as $arSectionItem) {
                if ($arParams["PARENT_SECTION"] == $arSectionItem["ID"]) $class = 'is-active';
                else $class = '';
                ?>
                <a href="<?=$arSectionItem["SECTION_PAGE_URL"]?>" class="<?=$class?>"><?=$arSectionItem["NAME"]?></a>
            <? } ?>
        </div>
    </div>
<? } ?>
<div class="news-col-wrap row">
    <? foreach($arResult["ITEMS"] as $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        $time = ( ($arItem["DISPLAY_ACTIVE_FROM"]) ? $arItem["DISPLAY_ACTIVE_FROM"] : $arItem["TIMESTAMP_X"] );

        ?>
        <div class="news-col" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <? if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])) { ?>
                <div class="images">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
                    </a>
                </div>
                <div class="inner">
                    <time datetime="<?=FormatDate("j-m-Y", strtotime($time) )?>"><?=FormatDate("j.m.Y", strtotime($time) )?></time>
                    <div class="title">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                    </div>
                    <? if ($arItem["PREVIEW_TEXT"]) { ?>
                        <div class="text"><?=$arItem["PREVIEW_TEXT"]?></div>
                    <? } ?>
                </div>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="more">Подробнее</a>
            <? } ?>
        </div>
    <? } ?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
