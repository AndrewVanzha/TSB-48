<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["PATH_TO_PAGE"]) {
    echo '<div class="aligner"><a title="Перейти в избранное" href="'.$arResult["PATH_TO_PAGE"].'" class="favorite icon" id="favorite">'.$arResult["PRODUCTS_COUNT"].'</a></div>';
}
else {
    echo '<div class="aligner"><span class="favorite icon" id="favorite">'.$arResult["PRODUCTS_COUNT"].'</span></div>';
}
?>
<script>BX.message({ TEMPLATE_PATH: '<?=$arResult["PATH"]?>' });</script>