<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)) {
    echo '<ul class="footer-nav">';
    foreach($arResult as $arItem) {
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;

        echo '<li><a href="'.$arItem["LINK"].'" title="'.$arItem["TEXT"].'">'.$arItem["TEXT"].'</a></li>';
    }
    echo '</ul>';
} ?>