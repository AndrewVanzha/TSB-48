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
IncludeTemplateLangFile(__FILE__);
$this->setFrameMode(true); ?>


<div class="wrapp-slider slider-corporat-clients">
    <div class="owl-carousel">
        <?foreach($arResult['ITEMS'] as $arItem):?>

            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

            <?if (mb_substr($arItem['PROPERTIES']['ATT_URL']['VALUE'], 0, 1) !== '/') {
                $target = 'target="_blank"';
            } else {
                $target = '';
            }?>

        <div class="slide" style="background-image: url(<?=$arItem['DETAIL_PICTURE']['SRC']?>);">
            <?/*img src="img/slide2.png" alt="" class="slide-dt">
            <img src="img/mobil-slide2.png" alt="" class="slide-mob"*/?>
            <?if (LANGUAGE_ID == "en") {$para = $arItem['PROPERTIES']['EN_NAME']['VALUE'];} else {$para = $arItem['NAME'];}?>
            <div class="text-slide">
                <div class="container">
                    <div class="title-slide"><?=$para?></div>
                    <p><?=$arItem['DETAIL_TEXT']?></p>

                    <? if(!CSite::InDir('/en/')){ ?>
                        <a href="<?=$arItem['PROPERTIES']['ATT_URL']['VALUE']?>" class="link-slide" <?=$target?>>
                            <span>
                                <?=GetMessage("LEARN_MORE")?>
                            </span>
                        </a>
                    <? } else {?>
					    <a href="<?='/en'.$arItem['PROPERTIES']['ATT_URL']['VALUE']?>" class="link-slide" <?=$target?>>
                            <span>
                                <?=GetMessage("LEARN_MORE")?>
                            </span>
                        </a>	
					
					<?}?>
                </div>
            </div>
        </div>
        <?endforeach;?>
    </div>
</div>







<?/*
<ul class="mp-menu clearfix">

    <li>
        <a href="<?=GetMessage("PRIVATE_CLIENTS_LINK")?>" class="button">
            <span class="mi--single mi">
                <?=GetMessage("PRIVATE_CLIENTS")?>
            </span>
        </a>
    </li>

    <li>
        <a href="<?=GetMessage("CORPORATE_CUSTOMER_LINK")?>" class="button">
            <span class="mi--group mi">
                <?=GetMessage("CORPORATE_CUSTOMER")?>
            </span>
        </a>
    </li>

</ul>
<div class="mp-slider">

    <div class="owl-carousel clearfix" id="mpSlider">

        <?foreach ($arResult['ITEMS'] as $arItem) {?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

            <?if (mb_substr($arItem['PROPERTIES']['ATT_URL']['VALUE'], 0, 1) !== '/') {
                $target = 'target="_blank"';
            } else {
                $target = '';
            }?>


            <div class="slide" style="background-image: url(<?=$arItem['DETAIL_PICTURE']['SRC']?>);">
<?if (LANGUAGE_ID == "en") {$para = $arItem['PROPERTIES']['EN_NAME']['VALUE'];} else {$para = $arItem['NAME'];}?>
                <div class="text">
                    <h3 class="page-title">
                        <?=$para?>
                    </h3>

                    <p>
                        <?=$arItem['DETAIL_TEXT']?>
                    </p>

                    <div class="note">
                        <?=$arItem['PREVIEW_TEXT']?>
                    </div>

                    <? if(!CSite::InDir('/en/')){ ?>
                        <a href="<?=$arItem['PROPERTIES']['ATT_URL']['VALUE']?>" class="read-more--large read-more mi--arrow-right-2 mi" <?=$target?>>
                            <span>
                                <?=GetMessage("LEARN_MORE")?>
                            </span>
                        </a>
                    <? } else {?>
					    <a href="<?='/en'.$arItem['PROPERTIES']['ATT_URL']['VALUE']?>" class="read-more--large read-more mi--arrow-right-2 mi" <?=$target?>>
                            <span>
                                <?=GetMessage("LEARN_MORE")?>
                            </span>
                        </a>	
					
					<?}?>

                </div>

            </div>

        <?}?>

    </div>

    <div class="pager" id="mpSliderPager"></div>

</div>
