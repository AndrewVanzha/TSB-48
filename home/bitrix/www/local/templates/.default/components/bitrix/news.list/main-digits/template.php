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
$this->setFrameMode(true); ?>


<div class="mp-about" style="background-image: url(/local/templates/.default/img/mp-about.jpg);">

    <div class="page-container">

        <h2 class="section-title page-title--2 page-title wow slideInUp">
            <?=GetMessage("TITLE")?>
        </h2>

        <div class="clearfix">

            <?$i = 0;?>
            <?foreach ($arResult['ITEMS'] as $arItem) {?>
                <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

                <div class="item clearfix wow zoomIn" data-wow-delay="<?=$i?>ms">

                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="image">

                    <div class="text">

                        <h3 class="page-title--3 page-title">
                            <?=$arItem['NAME']?>
                        </h3>

                        <p>
                            <?=$arItem['PREVIEW_TEXT']?>
                        </p>

                    </div>

                </div>

                <?$i = $i + 180;?>
            <?}?>

        </div>

    </div>

</div>
