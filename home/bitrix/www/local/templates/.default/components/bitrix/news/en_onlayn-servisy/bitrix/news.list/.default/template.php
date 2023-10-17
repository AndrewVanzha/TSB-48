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

<section class="page-section">
    <div class="product-items clearfix">
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <?$url = ($arItem['PROPERTIES']['ATT_URL']['VALUE'])?$arItem['PROPERTIES']['ATT_URL']['VALUE']:$arItem['DETAIL_PAGE_URL'];?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

        	<div class="product-item">
        		<div class="page-title--4 page-title"> <a href="<?=$url?>" class="aligner" target="_blank">
        		<?=$arItem['NAME']?> </a> </div>
        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
                             <p>
                                <span>
                                   <?=$arItem['PREVIEW_TEXT'];?> 
                                </span>
                            </p>

        				</div>
   
        				<div class="more">
                             <a href="<?=$url?>" target="_blank">Read more</a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>

</section>


<?=$arResult["NAV_STRING"]?>
