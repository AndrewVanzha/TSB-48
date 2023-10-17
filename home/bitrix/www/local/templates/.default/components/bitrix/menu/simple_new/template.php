<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<ul>
<?foreach($arResult as $arItem) :?>
    <?if ($arItem["SELECTED"]):?>
        <li><a class="selected" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    <?else:?>
        <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    <?endif?>
<?endforeach;?>
</ul>