<?
$arSectionProperties = $GLOBALS['arSectionProperties'];
//debugg($arSectionProperties);
if ($arSectionProperties["PICTURE"]) {
    $arResizeBigPicture = CFile::ResizeImageGet(
        $arSectionProperties["PICTURE"],
        array("width" => 569, 'height' => 466),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
    $arResizeSmallPicture = CFile::ResizeImageGet(
        $arSectionProperties["PICTURE"],
        array("width" => 280, 'height' => 280 * 466 / 569),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
}
?>
<div class="v21-konversion-subheader--box">
    <div class="v21-konversion-subheader--left">
        <h3 class="v21-h3-new v21-konversion-subheader--title">Трансстройбанк предлагает своим клиентам проведение конверсионных операций</h3>
        <a href="#fKonversionForm" class="v21-konversion-subheader--control v21-button js-fKonversionForm" data-item="0">Оставить заявку</a>
    </div>
    <div class="v21-konversion-subheader--right">
        <img src="<?=$arResizeBigPicture['src']?>" class="v21-konversion-subheader--bigimg" alt="изображение">
        <img src="<?=$arResizeSmallPicture['src']?>" class="v21-konversion-subheader--smallimg" alt="изображение">
    </div>
</div>
<div class="v21-konversion-advantages--box">
    <div class="v21-konversion-advantages--horline horline-1"></div>
    <div class="v21-konversion-advantages--horline horline-2"></div>
    <? foreach ($arSectionProperties["ADVANTAGES"] as $arItem) : ?>
        <div class="v21-konversion-advantages--box__item">
            <? if ($arItem['ICONS'] != false) {
                $arResizeIcon = CFile::ResizeImageGet(
                    $arItem['ICONS'],
                    array("width" => 90, 'height' => 90),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );
            } ?>
            <img src="<?=$arResizeIcon['src']?>" class="v21-konversion-advantages--box__img" alt="иконка">
            <h4 class="v21-konversion-advantages--box__title"><?=$arItem['TITLE']?></h4>
        </div>
    <? endforeach; ?>
</div>