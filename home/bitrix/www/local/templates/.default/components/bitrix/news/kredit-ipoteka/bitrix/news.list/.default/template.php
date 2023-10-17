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
<h2 class="section-title page-title">
<?=$arResult["SECTION"]["PATH"][0]["NAME"];?>
</h2>
<section class="page-section" id="section-<?=$arResult["SECTION"]["PATH"][0]["ID"];?>">
    <div class="product-items items-list clearfix">
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

        	<div class="product-item">
        		<div class="page-title--4 page-title">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner CREDIT_NAME"><?=$arItem['NAME']?></a>
                </div>
        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
                        
                        <?if($arItem['PROPERTIES']['INTEREST_RATE']['VALUE']):?>
        					<p>
        						Процентная ставка: <br>
                                <span class="credit_percent">
			                       <?=$arItem['PROPERTIES']['INTEREST_RATE']['VALUE']?>
                                </span>
        					</p>
                        <?endif;?>
                        <?if($arItem['PROPERTIES']['MAX_SUM']['VALUE']):?>
        					<p>
                                Максимальная сумма: <br>
                                <span class="credit_percent">
			                       <?=$arItem['PROPERTIES']['MAX_SUM']['VALUE']?>
                                </span>
        					</p>
                        <?endif;?>
                        
                        <?if($arItem['PROPERTIES']['ATT_MIN']['VALUE']):?>
        					<p>
        						 Минимальный размер кредита: <br>
                                 <span class="credit_percent">
			                       <?=$arItem['PROPERTIES']['ATT_MIN']['VALUE']?>
                                </span>
        					</p>
                        <?endif;?>
                        <?if($arItem['PROPERTIES']['ATT_MAX']['VALUE']):?>
        					<p>
        						 Максимальный размер кредита: <br>
                                 <span class="credit_summ">
			                       <?=$arItem['PROPERTIES']['ATT_MAX']['VALUE']?>
                                </span>
        					</p>
                        <?endif;?>
                        <?if (!empty($arItem['PROPERTIES']['ATT_DATE']['VALUE'])):?>
                            <p>
                                    Срок кредитования:  <br>
                                    <span class="credit_time">
                                    <?=$arItem['PROPERTIES']['ATT_DATE']['VALUE']?>
                                </span>
                            </p>
                        <?endif;?>
        				</div>
         <a href="#hypothec"  data-fancybox="" onclick="$('#CREDIT_NAME').val('<?=$arItem['NAME']?>');$('#DATE').val('<?=$arItem['PROPERTIES']['ATT_DATE']['VALUE']?>');" class="button">
        				Оформить заявку </a>
        				<div class="more">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					Узнать больше </a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>
    </div>
    <?if(count($arResult["ITEMS"]) > 4):?>
    <a href="javascript:void(0);" onclick="$('.product-item.hidden').removeClass('hidden');" class="show-all button">
        <span class="mi--chevron-down-5 mi">
            Показать еще
        </span>
    </a>
    <?endif;?>
</section>
<?/*?>
<script>
    $(window).on('load', function () {
        var newTitle = $('h1.page-title').text().trim() + '*';
        $('h1.page-title').text(newTitle);
    });
</script>
<?*/?>
<?=$arResult["NAV_STRING"]?>
