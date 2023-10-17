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
$this->setFrameMode(true);
?>

<section class="page-section">
    <h2 class="section-title page-title--2 page-title">Инвестируй с умом</h2>
    <div class="product-items clearfix">
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
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

                        <!-- <p class="since">
                            действует с 4 июля 2017
                        </p> -->

                        <p class="income">
                            <?=$arItem['PROPERTIES']['INTEREST_RATE']['VALUE']?>
                        </p>

                    </div>

                </div>


        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
                            <p>
                                Преимущества:
                                <br>
                                <span>
                                    <?=$arItem['PROPERTIES']['ADVANTAGES']['VALUE']?>
                                </span>
                            </p>
        				</div>
            <a href="#callbackForm" onclick="$('#CREDIT_NAME').val('<?=$arItem['NAME']?>')" data-fancybox="" class="button">
                        Получить консультацию</a>
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


<?=$arResult["NAV_STRING"]?>
