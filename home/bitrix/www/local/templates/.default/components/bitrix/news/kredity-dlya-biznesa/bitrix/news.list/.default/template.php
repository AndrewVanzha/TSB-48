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
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
        	<div class="product-item">
        		<div class="page-title--4 page-title"> <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner CREDIT_NAME">
        		<?=$arItem['NAME']?> </a> </div>
        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div  class="brief">
                            <? if (!empty($arItem['PROPERTIES']['INTEREST_RATE']['VALUE'])) {?>
            					<p>
            						<?=GetMessage("INTEREST_RATE_1");?><br>
                                    <span class="credit_percent">
    			                       <?=$arItem['PROPERTIES']['INTEREST_RATE']['VALUE']?>
                                    </span>
            					</p>
                            <? } ?>
                            <? if (!empty($arItem['PROPERTIES']['MAX_SUM']['VALUE'])) {?>
            					<p>
            						<?=GetMessage("MAX_AMOUNT");?> <br>
                                    <span class="credit_summ">
    			                       <?=$arItem['PROPERTIES']['MAX_SUM']['VALUE']?>
                                    </span>
            					</p>
                            <? } ?>
                            <? if (!empty($arItem['PROPERTIES']['MAX_DATE']['VALUE'])) {?>
                                <p>
            						<?=GetMessage("LOAN_TERM");?>  <br>
                                    <span class="credit_time">
    			                       <?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?>
                                    </span>
            					</p>
                            <? } ?>
        				</div>
          <a href="#creditRequestUl" onclick="$('#credit_name').val('<?=$arItem['NAME']?>');" data-fancybox="" class="button">
                       <?=GetMessage("SEND_APP");?> </a>
        				<div class="more">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					<?=GetMessage("READ_MORE");?> </a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>
    </div>
</section>



<?=$arResult["NAV_STRING"]?>
