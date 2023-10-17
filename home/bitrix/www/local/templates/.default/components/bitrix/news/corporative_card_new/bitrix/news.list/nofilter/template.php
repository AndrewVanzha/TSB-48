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
<?// debugg($arResult["ITEMS"]); ?>
<section class="card-section">
    <div class="card-section__wrap">
        <div class="card-section__left">
            <?
            $iwidth = 680;
            $iheight = $iwidth * 278 / 460;
            $render_img = CFile::ResizeImageGet($arResult["ITEMS"][0]['PREVIEW_PICTURE']['ID'], Array("width" => $iwidth, "height" => $iheight), BX_RESIZE_IMAGE_PROPORTIONAL, false);
            ?>
            <img
                src="<?=$render_img["src"]?>"
                alt="<?= $arResult["ITEMS"][0]['PREVIEW_PICTURE']['ALT'] ?>"
                title="<?= $arResult["ITEMS"][0]['PREVIEW_PICTURE']['TITLE'] ?>"
            />
        </div>
        <div class="card-section__right">
            <?= $arResult["ITEMS"][0]['~PREVIEW_TEXT'] ?>
            <div class="card-section__button">
                <a href="#fBusinessCardForm" class="v21-button-2022 card-section__button--body js-card-section__button--body">
                    <span>Оставить заявку</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-props__wrap">
        <div class="v21-section v21-section--xs">
            <div class="v21-grid">
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <div class="v21-grid__item--item">
                        <div class="v21-grid__item--title">
                            <?= $arResult["ITEMS"][0]['PROPERTIES']['ATT_POPOLNENIE']['VALUE'] ?>
                        </div>
                        <div class="v21-grid__item--p1"><?= $arResult["ITEMS"][0]['PROPERTIES']['ATT_POPOLNENIE']['~DESCRIPTION'] ?></div>
                    </div>
                </div><!-- /.v21-grid__item -->
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <div class="v21-grid__item--item">
                        <div class="v21-grid__item--title">
                            <?= $arResult["ITEMS"][0]['PROPERTIES']['ATT_RACHODY']['VALUE'] ?>
                        </div>
                        <div class="v21-grid__item--p1"><?= $arResult["ITEMS"][0]['PROPERTIES']['ATT_RACHODY']['~DESCRIPTION'] ?></div>
                    </div>
                </div><!-- /.v21-grid__item -->
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <div class="v21-grid__item--item">
                        <div class="v21-grid__item--title">
                            <?= $arResult["ITEMS"][0]['PROPERTIES']['PRICE']['VALUE'] ?>
                        </div>
                        <div class="v21-grid__item--p1"><?= $arResult["ITEMS"][0]['PROPERTIES']['PRICE']['~DESCRIPTION'] ?></div>
                    </div>
                </div><!-- /.v21-grid__item -->
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.js-card-section__button--body').on('click', function() {
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
