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

<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => ""
    )
);?>

<section class="page-section">
    <div class="product-items clearfix">
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

        	<div class="product-item--short product-item">
        		<h3 class="page-title--4 page-title"> <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner">
        		<?=$arItem['NAME']?> </a> </h3>
        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
        					<p>
        						 Годовое обслуживание: <br>
                                 <span>
			                       <?=$arItem['PROPERTIES']['PRICE']['VALUE']?> руб. в месяц *
                                </span>
        					</p>
        					<p>
        						 Преимущества: <br>
                                 <span>
			                       <?=$arItem['PREVIEW_TEXT']?>
                                </span>
        					</p>
        				</div>
         <!-- <a href="#vaultRequest" onclick="$('#safes_name').val('<?=$arItem['NAME']?>');$('#safes_price').val('<?=$arItem['PROPERTIES']['ATT_PRICE']['VALUE']?>');$('#safes_options').val('<?=$arItem['PROPERTIES']['ATT_SIZE']['VALUE']?>')" data-fancybox="" class="button">
        				Подать заявку </a> -->
        				<div class="more">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					Узнать больше </a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>
    </div>
    <?$APPLICATION->IncludeComponent(
    	"bitrix:main.include",
    	"",
    	Array(
    		"AREA_FILE_SHOW" => "page",
    		"AREA_FILE_SUFFIX" => "footnote",
    		"EDIT_TEMPLATE" => ""
    	)
    );?>
</section>


<?=$arResult["NAV_STRING"]?>
