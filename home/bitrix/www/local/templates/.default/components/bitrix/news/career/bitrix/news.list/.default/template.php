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



<ul class="info-accordion">

    <?$i = 0;?>
    <?foreach($arResult['SECTION'] as $arSection){?>

        <li>

            <a href="#" class="info-accordion_heading">

                <strong class="title">
                    <?=$arSection['NAME']?>
                </strong>

                <span class="toggle mi--chevron-down-2 mi">
                    Развернуть
                </span>

            </a>


            <div class="info-accordion_content clearfix" style="display: none;">

                <? if (!empty($arSection['DESCRIPTION'])) { ?>
                    <section class="page-section">
                        <article class="content-area clearfix">
                            <div class="content-area_text">
                                <?=$arSection['DESCRIPTION']?>
                            </div>
                        </article>
                    </section>
                <? } ?>

                <?foreach($arSection['ITEMS'] as $arItem){?>
                    <? if($arItem['DETAIL_TEXT']){?>
                        <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                        <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

                        <div class="job-item page-section">

                            <time class="page-date mi--calendar mi">
                                <?=$arItem['ACTIVE_FROM']?>
                            </time>

                            <span class="type">
                                <?=$arItem['PROPERTIES']['ATT_FIELD']['VALUE']?>
                            </span>

                            <h3 class="page-title--4 page-title">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                    <?=$arItem['NAME']?>
                                </a>
                            </h3>

                                <?=$arItem['PROPERTIES']['ATT_SPACE']['VALUE']?>

                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button">
                                Подробнее
                            </a>

                        </div>
                    <?}?>
                <?}?>

            </div>

        </li>

    <?}?>

</ul>

<?=$arResult["NAV_STRING"]?>
