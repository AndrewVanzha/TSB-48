<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)) {
    echo '<ul>';
        foreach($arResult as $arItem) {
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            if($arItem["SELECTED"]) {
                echo '<li class="is-active"><a href="'.$arItem["LINK"].'"><span>'.$arItem["TEXT"].'</span></a></li>';
            }
            else {
                echo '<li><a href="'.$arItem["LINK"].'" title="'.$arItem["TEXT"].'"><span>'.$arItem["TEXT"].'</span></a></li>';
            }?>
            <div style="display: none;">111111111<? var_dump($arItem); ?></div>
        <?}?>
    <?echo '</ul>';
} ?>