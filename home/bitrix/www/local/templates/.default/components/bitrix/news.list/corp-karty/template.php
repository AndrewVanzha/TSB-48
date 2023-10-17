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

<?foreach($arResult['ITEMS'] as $arItem){?>
    <div class="page-section clearfix">
        <article>

            <section class="page-section">

            	<article class="content-area clearfix">
                    <h3 class="page-title--5 page-title">
                        <a href="<?=$arItem['PROPERTIES']['ATT_URL']['VALUE']?>">
                            <?=$arItem['NAME']?>
                        </a>
                    </h3>

            		<!-- <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" class="content-area_image"> -->

                    <?=$arItem['PREVIEW_TEXT']?>

            	</article>

            </section>


        </article>
    </div>
<?}?>
