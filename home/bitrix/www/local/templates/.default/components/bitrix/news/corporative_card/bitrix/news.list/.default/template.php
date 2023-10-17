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

<form method="post" action="" class="page-section">

    <h2 class="section-title page-title--2 page-title">
        Подобрать карту
    </h2>

    <div class="clearfix">

        <div class="card-type">

            <label class="check-box choose-all">
                <input type="checkbox" name="">
                <span class="check-box_caption">
                    Выбрать все
                </span>
            </label>

            <?foreach ($arResult['FILTER']['TYPE'] as $type) {?>
                <label class="check-box type">
                    <input data-value="<?=$type?>" type="checkbox" name="">
                    <span class="check-box_caption">
                        <?=$type?>
                    </span>
                </label>
            <?}?>

        </div>

        <div class="card-type">

            <label class="check-box choose-all">
                <input type="checkbox" name="">
                <span class="check-box_caption">
                    Выбрать все
                </span>
            </label>

            <?foreach ($arResult['FILTER']['PAY_SYSTEM'] as $pay) {?>
                <label class="check-box pay">
                    <input data-value="<?=$pay?>" type="checkbox" name="">
                    <span class="check-box_caption">
                        <?=$pay?>
                    </span>
                </label>
            <?}?>

        </div>

        <div class="card-type">

            <label class="check-box choose-all">
                <input type="checkbox" name="">
                <span class="check-box_caption">
                    Выбрать все
                </span>
            </label>

            <?foreach ($arResult['FILTER']['LIMIT'] as $limit) {?>
                <label class="check-box limit">
                    <input data-value="<?=$limit?>" type="checkbox" name="">
                    <span class="check-box_caption select">
                        <?=$limit?>
                    </span>
                </label>
            <?}?>

        </div>

    </div>


</form>

<section class="page-section">
    <div class="product-items clearfix">
        <?$i = 0?>
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

        	<div data-type="<?=$arItem['PROPERTIES']['TYPE']['VALUE']?>" data-pay="<?=$arItem['PROPERTIES']['PAY_SYSTEM']['VALUE']?>" data-limit="<?=$arItem['PROPERTIES']['LIMIT']['VALUE']?>" class="product-item <?if(++$i > 4) echo 'hidden';?>" id="item">
        		<h3 class="page-title--4 page-title"> <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner">
        		<?=$arItem['NAME']?> </a> </h3>
        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
        					<p>
        						 Годовое обслуживание: <br>
                                 <span>
			                       <?=$arItem['PROPERTIES']['PRICE']['VALUE']?> руб.
                                </span>
        					</p>
        					<p>
        						 Преимущества: <br>
                                 <span>
			                       <?=$arItem['PREVIEW_TEXT']?>
                                </span>
        					</p>
        				</div>
         <a href="#cardUlRequest" data-fancybox="" class="button">
        				Подать заявку </a>
        				<div class="more">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					Узнать больше </a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>

    </div>
    <a href="javascript:void(0);" onclick="$('.product-item.hidden').removeClass('hidden');" class="load-more button">
        <span class="mi--chevron-down-5 mi">
            Показать еще
        </span>
    </a>
</section>

<?=$arResult["NAV_STRING"]?>
