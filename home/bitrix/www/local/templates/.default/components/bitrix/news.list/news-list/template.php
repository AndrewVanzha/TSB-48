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
<div class="news-block" style="background-image: url(/local/templates/.default/img/news-block.jpg);">

    <div class="page-container">

        <div class="section-heading clearfix">

            <h2 class="section-title page-title--2 page-title">
                Новости
            </h2>

            <a href="<?=$arResult['LIST_PAGE_URL']?>" class="read-more--small read-more mi--arrow-right-1 mi">
                <span>
                    Все новости
                </span>
            </a>

        </div>

        <div class="clearfix">

            <? foreach($arResult["ITEMS"] as $arItem) { ?>
                <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
                <div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                    <? if (isset($arItem['PREVIEW_PICTURE']['SRC']) && $arItem['PREVIEW_PICTURE']['SRC']) { ?>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="image">
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
                        </a>
                    <? } else { ?>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="image">
                            <img src="/local/templates/.default/img/no_photo.jpg" alt="">
                        </a>
                    <? } ?>

                    <div class="text">

                        <p>
                            <time class="page-date mi--calendar mi">
                                <?=$arItem['DISPLAY_ACTIVE_FROM']?>
                            </time>
                        </p>

                        <h3 class="page-title--5 page-title">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <?=$arItem['NAME']?>
                            </a>
                        </h3>

                        <p class="brief">
                            <?=$arItem['PREVIEW_TEXT']?>
                        </p>

                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="read-more--small read-more mi--arrow-right-1 mi">
                            <span>
                                Подробнее
                            </span>
                        </a>

                    </div>

                </div>

            <? } ?>

        </div>

        <a href="<?=$arResult['LIST_PAGE_URL']?>" class="read-all button">
            Все новости
        </a>

    </div>

</div>
