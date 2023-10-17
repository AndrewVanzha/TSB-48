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


          <?foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
        	<div class="product-item--short product-item">

                <div class="heading">

                    <div class="aligner">

                        <h3 class="page-title--4 page-title">

                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner">
                                <?=$arItem['NAME']?>
                            </a>

                        </h3>

                        <p class="since">
                            <?=$arItem['PROPERTIES']['ATT_FROM']['VALUE']?>
                        </p>

                        <p class="income" >
                            до <?=$arItem['PROPERTIES']['RUB_INTEREST_RATE']['VALUE']?>% годовых
                        </p>

                    </div>

                </div>


        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
                            <p style="display: none;">
                                Минимальная сумма:
                                <br>
                                <span>
                                    <?=number_format($arItem['PROPERTIES']['MIN_SUMM']['VALUE'], 0, ',', ' ');?> <?=$arItem['PROPERTIES']['ATT_CURRENCY']['VALUE']?>
                                </span>
                            </p>

                            <p  style="display: none;">
                                Максимальная сумма:
                                <br>
                                <span>
                                    <?=number_format($arItem['PROPERTIES']['MAX_SUMM']['VALUE'], 0, ',', ' ');?> <?=$arItem['PROPERTIES']['ATT_CURRENCY']['VALUE']?>
                                </span>
                            </p>
        				</div>
                        <a
                            href="#depositFiz" 
                            data-fancybox=""
                            class="button"
                            onclick="
                                if ($('.currency input:checked').data('currency') == 'Руб.') {
                                    var sum = $('#summ').val();
                                } else {
                                    var sum = $('#summ_cur').val();
                                }
                                $('#sum').val(sum);
                                $('.cs-box_selected').text($('.currency input:checked').data('currency'));
                            "
                        >
        				    Подать заявку </a>
        				<div class="more">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					Узнать больше </a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>
