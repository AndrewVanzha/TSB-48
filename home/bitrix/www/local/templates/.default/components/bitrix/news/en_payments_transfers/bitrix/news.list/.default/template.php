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
$this->setFrameMode(true);?>
<br>
<section class="page-section">
    <div class="product-items items-list clearfix">
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

            <div class="product-item">
                <div class="page-title--4 page-title">
                    <a <?if($arItem['PROPERTIES']['ATT_URL']['VALUE']){?>target='_blank'<?}?> href="<?=($arItem['PROPERTIES']['ATT_URL']['VALUE'])?$arItem['PROPERTIES']['ATT_URL']['VALUE']:$arItem['DETAIL_PAGE_URL']?>" class="aligner CREDIT_NAME"><?=$arItem['NAME']?></a> 
                </div>
                <div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
                    <div class="content">
                        <div class="brief">
                            <p>
                                 Fee: <br>
                                 <span class="credit_percent">
                                   <?=$arItem['PROPERTIES']['ATT_PRICE']['VALUE']?>
                                </span>
                            </p>
                            <p>
                                 Advantages: <br>
                                 <span class="credit_percent">
                                   <?=$arItem['PREVIEW_TEXT']?>
                                </span>
                            </p>
                            
                        </div>
        
                        <div class="more">
                             <a  <?if($arItem['PROPERTIES']['ATT_URL']['VALUE']){?>target='_blank'<?}?> href="<?=($arItem['PROPERTIES']['ATT_URL']['VALUE'])?$arItem['PROPERTIES']['ATT_URL']['VALUE']:$arItem['DETAIL_PAGE_URL']?>">
                            Read more </a>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</section>



<?=$arResult["NAV_STRING"]?>
