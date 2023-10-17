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

<div class="promo-slider">

    <div class="owl-carousel" id="promoSlider">

        <?foreach ($arResult['ITEMS'] as $arItem) {?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

            <?if (mb_substr($arItem['PROPERTIES']['ATT_URL']['VALUE'], 0, 1) !== '/') {
                $target = 'target="_blank"';
            } else {
                $target = '';
            }?>

            <a href="<?=$arItem['PROPERTIES']['ATT_URL']['VALUE']?>" class="slide" style="background-image: url(<?=CFile::GetPath($arItem['PROPERTIES']['ATT_PICTURE']['VALUE'])?>);" <?=$target?>>

                <span class="text">

                    <strong class="page-title">
                        <?=$arItem['NAME']?>
                    </strong>

                    <span class="note">
                        <?=$arItem['PREVIEW_TEXT']?>
                    </span>

                    <?if($arItem['PROPERTIES']['ATT_INFO']['VALUE'])
                        echo "<span>{$arItem['PROPERTIES']['ATT_INFO']['VALUE']}</span>";?>

                    <span class="read-more--small read-more mi--arrow-right-3 mi">
                        <span>
                            <?=GetMessage("LEARN_MORE")?>
                        </span>
                    </span>

                </span>

            </a>

        <?}?>

    </div>

    <a href="#" class="slider-control--prev slider-control mi--angle-left mi" id="promoSliderPrev"></a>
    <a href="#" class="slider-control--next slider-control mi--angle-right mi" id="promoSliderNext"></a>

</div>
