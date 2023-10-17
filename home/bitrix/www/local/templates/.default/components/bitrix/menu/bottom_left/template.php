<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)) {
    echo '<div class="footer-menu">';
        foreach($arResult as $arItem) {
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;

            echo '<a title="'.$arItem["TEXT"].'" href="'.$arItem["LINK"].'">'.$arItem["TEXT"].'</a>';
        }
    echo '</div>';
}?>
