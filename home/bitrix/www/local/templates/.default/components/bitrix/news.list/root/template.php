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
<? $this->addExternalCss("/local/templates/.default/components/bitrix/news.list/root/style.css"); ?>
<div class="clients-menu clearfix">
    <? foreach($arResult["ITEMS"] as $arItem) { ?>
        <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
        <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
        <? if ($arItem['PROPERTIES']['TYPE']['VALUE'] == 'Во всю ширину') { ?>
            <? $type = 'type-3'; ?>
        <? } elseif ($arItem['PROPERTIES']['TYPE']['VALUE'] == 'Горизонтально') { ?>
            <? $type = 'type-2'; ?>
        <? } else { ?>
            <? $type = 'type-1'; ?>
        <? } ?>
		<? $single_style = ($arItem["ID"]==9525 || $arItem["ID"]==9526)? 'single' : ''; ?>
        <?if (mb_substr($arItem['PROPERTIES']['LINK']['VALUE'], 0, 1) !== '/') {
                $target = 'target="_blank"';
            } else {
                $target = '';
            }?>
        <div class="clients-menu_item <?=$type?> <?=$single_style?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);" <?=$target?>>
                <strong>
                    <? foreach ($arItem['PROPERTIES']['HEADER']['VALUE'] as $key => $value) { ?>
                        <span>
                            <?=$value?>
                        </span>
                        <? if (isset($arItem['PROPERTIES']['HEADER']['VALUE'][$key + 1])) { ?>
                            <br>
                        <? } ?>
                    <? } ?>
                </strong>
            </a>
        </div>
    <? } ?>
</div>
