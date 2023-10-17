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
<div class="page-section clearfix">

    <?foreach($arResult['ITEMS'] as $arItem){?>
        <article class="service-item">

            <a href="<?=$arItem['PROPERTIES']['ATT_URL']['VALUE']?>" class="image">
                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
            </a>

            <div class="text">

                <div class="page-title--5 page-title">
                    <a href="<?=$arItem['PROPERTIES']['ATT_URL']['VALUE']?>">
                        <?=$arItem['NAME']?>
                    </a>
                </div>

                <p>
                    <?=$arItem['PREVIEW_TEXT']?>
                </p>

            </div>

            <div class="details">
                <a href="<?=$arItem['PROPERTIES']['ATT_URL']['VALUE']?>" class="read-more--small read-more mi--arrow-right-1 mi">
                    <span>
                       <?=GetMessage('LEARN_MORE')?>
                    </span>
                </a>
            </div>

        </article>
    <?}?>

</div>
