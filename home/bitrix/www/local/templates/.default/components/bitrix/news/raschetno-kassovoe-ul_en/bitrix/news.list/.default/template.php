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
        				<div class="brief">
        					<!--<p>
        						 Процентная ставка: <br>
                                 <span class="credit_percent">
			                       <?=$arItem['PROPERTIES']['INTEREST_RATE']['VALUE']?>
                                </span>
        					</p>-->
        					<p>
        						 Cost of service: <br>
                                 <span class="credit_summ">
			                       <?=$arItem['PROPERTIES']['MAX_SUM']['VALUE']?>
                                </span>
        					</p>
                            <!--<p>
        						 Срок:  <br>
                                 <span class="credit_time">
			                       <?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?>
                                </span>
        					</p>-->
        				</div>
                        <?
                        $formId = "#cashServiceRequest";
                        if (trim($arItem['NAME']) === "Зарплатный проект") {
                            $formId = "#salaryProjectRequest";
                        }
                        ?>
                        <a href="<?=$formId?>" data-fancybox="" class="button">
        				    Open account</a>
        				<div class="more">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					Read more </a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>
    </div>
    <a href="javascript:void(0);" class="button show-all">Show all</a>
</section>

<?=$arResult["NAV_STRING"]?>
