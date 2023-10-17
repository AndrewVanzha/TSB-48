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

$count = 1;

foreach ($arResult["ITEMS"] as $arItem ) {
    if ($count <= 2) {
        $arResult["ITEMS"]["COL_1"][] = $arItem;
    }
    else {
        $arResult["ITEMS"]["COL_2"][] = $arItem;
    }
    $count += 1;
}
?>
<? if (!empty($arResult["ITEMS"]))  { ?>
    <div class="col">
        <div class="heading">Энциклопедия</div>
        <div class="article-block-wrap row">
            <div class="article-col">
            <? foreach($arResult["ITEMS"]["COL_1"] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                $time = ( ($arItem["DISPLAY_ACTIVE_FROM"]) ? $arItem["DISPLAY_ACTIVE_FROM"] : $arItem["TIMESTAMP_X"] );

                ?>

                    <article class="article-block clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <? if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])) { ?>
                            <div class="article-img">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
                                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
                                </a>
                            </div>
                        <? } ?>
                        <div class="news-info">
                            <time datetime="<?=FormatDate("j-m-Y", strtotime($time) )?>"><?=FormatDate("j.m.Y", strtotime($time) )?></time>
                            <div class="title">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                            </div>
                            <? if ($arItem["PREVIEW_TEXT"]) { ?>
                                <p><?=$arItem["PREVIEW_TEXT"]?></p>
                            <? } ?>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="link icon">Подробнее</a>
                        </div>
                    </article>

            <? } ?>
            </div>
            <div class="article-col">
                <? foreach($arResult["ITEMS"]["COL_2"] as $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                    $time = ( ($arItem["DISPLAY_ACTIVE_FROM"]) ? $arItem["DISPLAY_ACTIVE_FROM"] : $arItem["TIMESTAMP_X"] );

                    ?>
                    <article class="article-block clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <? if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])) { ?>
                            <div class="article-img">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
                                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
                                </a>
                            </div>
                        <? } ?>
                        <div class="news-info">
                            <time datetime="<?=FormatDate("j-m-Y", strtotime($time) )?>"><?=FormatDate("j.m.Y", strtotime($time) )?></time>
                            <div class="title">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                            </div>
                            <? if ($arItem["PREVIEW_TEXT"]) { ?>
                                <p><?=$arItem["PREVIEW_TEXT"]?></p>
                            <? } ?>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="link icon">Подробнее</a>
                        </div>
                    </article>
                <? } ?>
            </div>
        </div>
        <a href="<?=$arResult["LIST_PAGE_URL"]?>" class="link icon">Все статьи</a>
    </div>
<? } ?>