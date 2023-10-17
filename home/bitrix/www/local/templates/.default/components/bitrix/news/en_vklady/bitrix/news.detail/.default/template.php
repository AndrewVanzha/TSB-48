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

<section class="page-section">
    <div class="product-items clearfix">
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

        	<div class="product-item--short product-item">

                <div class="heading">

                    <div class="aligner">

                        <div class="page-title--4 page-title">

                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner">
                                <?=$arItem['NAME']?>
                            </a>

                        </div>

                        <p class="since">
                           <?=$arItem['PROPERTIES']['ATT_FROM']['VALUE']?>
                        </p>

                        <p class="income">
                            up to <?=$arItem['PROPERTIES']['INTEREST_RATE']['VALUE']?>% annually
                        </p>

                    </div>

                </div>


        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
                            <p>
                                Minimum amount:
                                <br>
                                <span>
                                    <?=number_format($arItem['RUB_MIN_SUMM'], 0, ',', ' ');?>
                                </span>
                            </p>
                            
                            <p>
                                Advantages: 
                                <br>
                                <span>
                                    <?=$arItem['PROPERTIES']['ADVANTAGES']['VALUE']?>
                                </span>
                            </p>
                            
        				</div>
         <a href="#depositFiz" onclick="$('#CREDIT_NAME').val('<?=$arItem['NAME']?>')" data-fancybox="" class="button">
                        Send application</a>
        				<div class="more">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					Read more</a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>
    </div>
        <a href="javascript:void(0);" class="button show-all">All deposits</a>
</section>



<?=$arResult["NAV_STRING"]?>
