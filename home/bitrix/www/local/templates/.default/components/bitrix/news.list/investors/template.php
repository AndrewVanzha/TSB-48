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


<?foreach($arResult['ITEMS'] as $arItem){?>
    <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
    <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>


    <section class="page-section">

        <div class="investment-item content-area clearfix">

            <div class="content-area_text">

                <p>
                    <strong>
                        <?=$arItem['NAME']?>
                    </strong>
                </p>

            </div>

            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="content-area_image">

            <div class="content-area_text">

                <?=$arItem['PREVIEW_TEXT']?>

            </div>

        </div>
    
        <?if($arItem['PROPERTIES']['ATT_PICTURES']['VALUE']){?>
        
            <div class="photo-slider">

                <div class="owl-carousel">

                    <?foreach($arItem['PROPERTIES']['ATT_PICTURES']['VALUE'] as $key => $pictureId){?>
                        <?$arFile = CFile::GetFileArray($pictureId);?>

                        <a href="<?=$arFile['SRC']?>" data-fancybox="gallery" data-caption="Lorem ipsum dolor" class="slide">
                            <img src="<?=$arFile['SRC']?>" alt="$arFile['DESCRIPTION']">
                        <span>
                            <?=$arFile['DESCRIPTION']?>
                        </span>
                        </a>

                    <?}?>

                </div>

                <a href="#" class="slider-control--prev slider-control mi--angle-left mi"></a>
                <a href="#" class="slider-control--next slider-control mi--angle-right mi"></a>

            </div>

        <?}?>

    </section>

<?}?>
