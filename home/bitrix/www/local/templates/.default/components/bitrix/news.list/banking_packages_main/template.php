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
<div class="wrapp-checking-account">
    <div class="bg-checking-account"></div>
    <div class="container">
        <div class="title-checking-account"><?=GetMessage("SETTLEMENT_ACCOUNT_IN_TRANSSTROIBANK")?></div>
        <div class="service-packages"><?=GetMessage("BANKING_PACKAGES")?></div>
        <div class="wrapp-list-packages">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
                
                <div class="block-services-packages">
                    <div class="name-packages"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a> </div>
                    <div class="price-packages">
                        <?=$arItem['PROPERTIES']['MAX_SUM']['VALUE']?>
                    </div>
                    <?/*div class="info-packages">Выдача наличной валюты под 0,5%</div*/?>
                </div>
            <?endforeach;?>
        </div>
        <div class="see-all-tarif">
            <a href="/corporative-clients/bankovskoe-obsluzhivanie/raschetno-kassovoe-obsluzhivanie/"><?=GetMessage("VIEW_ALL_TARIFF")?></a>
        </div>
        <div class="open-account-bank">
            <a href="#cashServiceRequest" data-fancybox ><?=GetMessage("OPEN_ACCOUNT")?></a>
        </div>
    </div>
</div>