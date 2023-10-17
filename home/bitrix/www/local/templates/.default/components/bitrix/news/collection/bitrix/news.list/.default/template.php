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
<div class="row">
    <? foreach($arResult["ITEMS"] as $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="series-block" style="background: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>') no-repeat 50% 0 / cover;">
                <div class="header">
                    <div class="subtitle">Коллекция монет</div>
                    <div class="title"><?=$arItem["NAME"]?></div>
                </div>
                <? if (!empty($arItem["PROPERTIES"]["BACKGROUND_PROPUCTS_IMG"]["VALUE"])) { ?>
                    <div class="series img-border row">
                        <? foreach ($arItem["PROPERTIES"]["BACKGROUND_PROPUCTS_IMG"]["VALUE"] as $key => $img) {
                            if ($key > 3) break;
                            ?>
                            <div class="item">
                                <div class="img"><img src="<?=CFile::GetPath($img)?>" alt="<?=$arItem["PROPERTIES"]["BACKGROUND_PROPUCTS_IMG"]["DESCRIPTION"][$key]?>"></div>
                                <div class="name"><?=$arItem["PROPERTIES"]["BACKGROUND_PROPUCTS_IMG"]["DESCRIPTION"][$key]?></div>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
                <div class="link-wrap">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="link icon">Подробнее</a>
                </div>
            </div>
        </div>

    <? } ?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
