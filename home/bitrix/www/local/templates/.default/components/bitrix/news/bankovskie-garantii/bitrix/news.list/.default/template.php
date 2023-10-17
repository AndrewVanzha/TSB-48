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
<?if(!empty($arResult['ITEMS'])){?>
<section class="page-section">
    <div class="product-items clearfix">
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

        	<div class="product-item">
        		<h3 class="page-title--4 page-title"> <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner CREDIT_NAME">
        		<?=$arItem['NAME']?> </a> </h3>
        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
        					<!-- <p>
        						 Процентная ставка: <br>
                                 <span class="credit_percent">
			                       <?=$arItem['PROPERTIES']['INTEREST_RATE']['VALUE']?>
                                </span>
        					</p>
        					<p>
        						 Максимальная сумма: <br>
                                 <span class="credit_summ">
			                       <?=$arItem['PROPERTIES']['MAX_SUM']['VALUE']?>
                                </span>
        					</p>
                            <p>
        						 Срок кредитования:  <br>
                                 <span class="credit_time">
			                       <?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?>
                                </span>
        					</p> -->
        				</div>
         <a href="#guarantee"  data-fancybox="" class="button">
        				Получить ответ </a>
        				<div class="more">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					Узнать больше </a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>
    </div>
</section>
<?}?>

<?=$arResult["NAV_STRING"]?>
