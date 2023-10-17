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

$time = ( ($arResult["DISPLAY_ACTIVE_FROM"]) ? $arResult["DISPLAY_ACTIVE_FROM"] : $arResult["TIMESTAMP_X"] );
?>
<div class="news-main-info clearfix">
    <? if(is_array($arResult["DETAIL_PICTURE"])) { ?>
        <div class="img-left">
            <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>">
        </div>
    <? } ?>
    <time datetime="<?=FormatDate("j-m-Y", strtotime($time) )?>"><?=FormatDate("j.m.Y", strtotime($time) )?></time>
    <div class="news-info-inner">
        <?=$arResult["DETAIL_TEXT"]?>
    </div>
</div>
