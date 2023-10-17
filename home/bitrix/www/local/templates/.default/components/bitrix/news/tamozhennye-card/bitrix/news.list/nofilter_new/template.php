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
<?//debugg($arResult["ITEMS"]);?>
<?//debugg($arResult["ITEMS"][0]['PROPERTIES']);?>
<?//debugg($arResult["ITEMS"][0]['PROPERTIES']['ADD_SUBHEADER']['~VALUE']);?>
<?//debugg($arResult["ITEMS"][0]['PROPERTIES']['ADD_ADVANTAGES']['VALUE']);?>
<?//debugg($arResult["ITEMS"][0]['PROPERTIES']['ADD_ADVANTAGES_IMG']);?>
<section class="block-section">
    <? foreach ($arResult["ITEMS"] as $arItem) : ?>
        <? $ii = 0; ?>
        <h2 class="block-section--header"><?= $arResult["ITEMS"][0]['PROPERTIES']['ADD_SUBHEADER']['~VALUE'] ?></h2>
        <ul class="block-section--wrap">
            <? for ($ii=0; $ii<count($arItem['PROPERTIES']['ADD_ADVANTAGES']['VALUE']); $ii++) : ?>
                <li class="block-section--item">
                    <?
                    $iwidth = 91;
                    $iheight = 90;
                    $render_img = CFile::ResizeImageGet($arItem['PROPERTIES']['ADD_ADVANTAGES_IMG']['VALUE'][$ii], Array("width" => $iwidth, "height" => $iheight), BX_RESIZE_IMAGE_PROPORTIONAL, false);
                    //debugg($render_img);
                    ?>
                    <div class="block-section--item__img">
                        <img
                                src="<?=$render_img["src"]?>"
                                alt="иконка преимущества"
                        />
                    </div>
                    <??>
                    <div class="block-section--item__text"><?= $arItem['PROPERTIES']['ADD_ADVANTAGES']['VALUE'][$ii] ?></div>
                </li>
            <? endfor; ?>
        </ul>
    <? endforeach; ?>
</section>
