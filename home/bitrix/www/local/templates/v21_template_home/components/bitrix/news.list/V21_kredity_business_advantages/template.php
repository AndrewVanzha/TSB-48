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
<div class="advantages-block">
    <div class="advantages-block--top">
        <div class="advantages-block--top_text">
            <h2 class="v21-h2 advantages-block--top_header"><?= $arResult['SECTION']['PATH'][0]['UFS']['~UF_ADVANT_HEADER'] ?></h2>
            <p class="advantages-block--top_p1"><?= $arResult['SECTION']['PATH'][0]['UFS']['~UF_ADVANT_SUB_1'] ?></p>
            <p class="advantages-block--top_p2"><?= $arResult['SECTION']['PATH'][0]['UFS']['~UF_ADVANT_SUB_2'] ?></p>
            <?/*?><a href="#fBusinessCreditForm" class="advantages-block--top_button js-advantages-block--top_button">Подобрать кредит</a><?*/?>
            <a href="#sBusinessCreditForm" class="v21-button js-advantages-block--top_button">Подобрать кредит</a>
        </div>
        <div class="advantages-block--top_img">
            <?
            $imageWidth = 593;
            $imageHeight = 495;
            $picFile = CFile::ResizeImageGet($arResult['SECTION']['PATH'][0]['PICTURE'], array('width'=>$imageWidth, 'height'=>$imageHeight), BX_RESIZE_IMAGE_EXACT);
            ?>
            <img
                    class="preview_picture img-box"
                    src="<?=$picFile["src"]?>"
                    alt="изображение"
                    title="изображение"
            />
        </div>
    </div>
    <div class="advantages-block--wrap">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="advantages-block--item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="advantages-item--image">
                    <img
                            class="advantages-item--image_picture"
                            src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                            width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                            height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                    />
                </div>
                <div class="advantages-item--text">
                    <h6 class="v21-h6 advantages-item--header"><?= $arItem['~NAME'] ?></h6>
                    <p class="advantages-item--description">
                        <?= $arItem['~PREVIEW_TEXT'] ?>
                    </p>
                </div>
            </div>
        <?endforeach;?>
    </div>

    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
</div>

<script>
    $(document).ready(function () {
        $('.js-advantages-block--top_button').on('click', function() {
            let href = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(href).offset().top - 120
            }, {
                duration: 800,   // по умолчанию «400»
                easing: "linear" // по умолчанию «swing»
            });
            return false;
        });
    });
</script>