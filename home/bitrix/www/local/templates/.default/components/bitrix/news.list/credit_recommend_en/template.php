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
    <section class="page-section" style="border-bottom: 1px solid #ddd;margin: 0 0 30px;padding: 0 0 30px;">
        <h2 class="section-title page-title--1 page-title">You may also be interested in</h2>
        <div class="product-items clearfix">
            <? foreach($arResult["ITEMS"] as $arItem) { ?>
                <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
                
            	<div class="product-item">
            		<h3 class="page-title--4 page-title"> <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner">
            		<?=$arItem['NAME']?> </a> </h3>
            		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
            			<div class="content">
            				<div class="brief">
                                <? if (!empty($arItem['PROPERTIES']['INTEREST_RATE']['VALUE'])) { ?>
                					<p>
                						Interest rate: <br>
                                        <span>
        			                       <?
                                           $interestRate = $arItem['PROPERTIES']['INTEREST_RATE']['VALUE'];
                                           echo $interestRate; if (is_numeric($interestRate)) echo '%';
                                           ?>
                                        </span>
                					</p>
                                <? } ?>
                                <? if (!empty($arItem['PROPERTIES']['MAX_SUM']['VALUE'])) { ?>
                					<p>
                						Maximum amount: <br>
                                        <span>
        			                        <?
                                            $maxSum = $arItem['PROPERTIES']['MAX_SUM']['VALUE'];
                                            if (is_numeric($maxSum)) {
                                                echo number_format($maxSum, 2, ',', ' ');
                                            } else {
                                                echo $maxSum;
                                            }
                                            ?>
                                        </span>
                					</p>
                                <? } ?>
                                <? if (!empty($arItem['PROPERTIES']['MAX_DATE']['VALUE'])) { ?>
                                    <p>
                						Loan term:   <br>
                                        <span>
        			                       <?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?>
                                        </span>
                					</p>
                                <? } ?>
            				</div>
             <a href="#creditRequestUl" onclick="$('#credit_name').val('<?=$arItem['NAME']?>');" data-fancybox="" class="button">
                            Draw up application</a>
            				<div class="more">
             <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
            					Read more</a>
            				</div>
            			</div>
            		</div>
            	</div>
            <? } ?>
        </div>
    </section>
    
<?}?>