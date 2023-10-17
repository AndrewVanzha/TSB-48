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

<?if (!empty($arResult["ITEMS"])) {?>

    <div class="special-block" style="background-image: url(/local/templates/.default/img/special-block.jpg);">

        <div class="page-container">

            <div class="section-heading clearfix">

                <h2 class="section-title page-title--2 page-title wow slideInLeft">
                    <?=GetMessage("SPECIAL_OFFERS")?>
                </h2>
                <?
                foreach ($arResult['ITEMS'] as $arItem) {
                    if ($arItem["PROPERTIES"]["CLIENTS"]["VALUE"] === "Частные") {
                        $private = true;
                    }
                    if ($arItem["PROPERTIES"]["CLIENTS"]["VALUE"] === "Корпоративные") {
                        $corp = true;
                    }
                }
                if ($private === true) {
                    $showAllLink = "/chastnym-klientam/drugie-uslugi/spetsialnye-predlozheniya/";
                }
                if ($corp === true) {
                    $showAllLink = "/corporative-clients/spetsialnye-predlozheniya/";
                }
                ?>
                <?if ($private === true xor $corp === true) {?>
                    <a href="<?=$showAllLink;?>" class="read-more--small read-more mi--arrow-right-1 mi wow slideInRight">
                        <span>
                            <?=GetMessage("ALL_OFFERS")?>
                        </span>
                    </a>
                <?}?>
            </div>

            <div class="clearfix">
                <?$i = 0;?>
                <?foreach ($arResult['ITEMS'] as $arItem) {?>
                    <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                    <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
                    <? $url = $arItem['DETAIL_PAGE_URL'].'/'?>
                    <div class="special-item wow slideInUp" data-wow-delay="<?=$i?>ms">

                        <!-- <div class="label">
                            Скидка 5%
                        </div> -->

                        <a href="<?=$url?>" class="image">
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
                        </a>

                        <div class="text">

                            <h3 class="page-title--5 page-title">
                                <a href="<?=$url?>">
                                    <?=$arItem['NAME']?>
                                </a>
                            </h3>

                            <a href="<?=$url?>" class="read-more--small read-more mi--arrow-right-1 mi">
                                <span>
                                    <?=GetMessage("LEARN_MORE")?>
                                </span>
                            </a>

                        </div>

                    </div>

                    <?$i = $i + 180;?>
                <?}?>


                


            </div>

            <a href="<?=$showAllLink;?>" class="read-all button">
                все предложения
            </a>

        </div>

    </div>

<?}?>
