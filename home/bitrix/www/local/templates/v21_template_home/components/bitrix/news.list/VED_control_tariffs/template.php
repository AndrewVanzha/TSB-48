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
//debugg($arResult['TREE']);
?>
<!--hr class="tariffs-block--hr"-->
<div class="tariffs-block">
    <h2 class="tariffs-block--header"><?= $arResult['SECTION']['PATH'][0]['~NAME'] ?></h2>
    <div class="tariffs-block--wrap">
        <div class="tariffs-block--nav">
            <? foreach($arResult["TREE"] as $key=>$arSection) : ?>
                <div class="tariffs-block--nav_tab js--nav_tab" data-tariff-select="tab_<?= $key ?>">
                    <?= $arSection['~NAME'] ?>
                </div>
            <?endforeach;?>
        </div>
        <div class="tariffs-block--tables">
            <? foreach($arResult["TREE"] as $key=>$arSection) : ?>
                <div class="tariffs-block--table" data-tariff-tab="tab_<?= $key ?>">
                    <? foreach ($arSection['ITEMS'] as $arItem) : ?>
                        <div class="tariffs-block--item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <p class="tariffs-item--header"><?= $arItem['~NAME'] ?></p>
                            <div class="tariffs-item--text">
                                <p class="tariffs-item--paragraph"><?= $arItem['~DETAIL_TEXT'] ?></p>
                                <? $aux_line = ''; ?>
                                <? if(isset($arItem['PROPERTIES']['ADD_PROP_1']['VALUE'])) : ?>
                                    <?/*?><p class="tariffs-item--subparagraph"><?= $arItem['PROPERTIES']['ADD_PROP_1']['~VALUE'] ?></p><?*/?>
                                    <? $aux_line .= $arItem['PROPERTIES']['ADD_PROP_1']['~VALUE'] ?>
                                <? endif; ?>
                                <? if(isset($arItem['PROPERTIES']['ADD_PROP_2']['VALUE'])) : ?>
                                    <?/*?><p class="tariffs-item--subparagraph"><?= $arItem['PROPERTIES']['ADD_PROP_2']['~VALUE'] ?></p><?*/?>
                                    <? $aux_line .= ' - ' . $arItem['PROPERTIES']['ADD_PROP_2']['~VALUE'] ?>
                                <? endif; ?>
                                <p class="tariffs-item--subparagraph"><?= $aux_line ?></p>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            <?endforeach;?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let tabBlocks = document.querySelectorAll('.tariffs-block--table');
        let tabTitles = document.querySelectorAll('.js--nav_tab');
        tabBlocks[0].classList.add('tariffs-block--active');
        tabTitles[0].classList.add('tariffs-block--nav_tab__active');
        $('.js--nav_tab').click(function () {
            let $this = $(this);
            [].forEach.call(tabTitles, (elem) => {
                elem.classList.remove('tariffs-block--nav_tab__active');
            });
            $(this).addClass('tariffs-block--nav_tab__active');
            let openTab = $this.data('tariff-select');
            [].forEach.call(tabBlocks, (elem) => {
                elem.classList.remove('tariffs-block--active');
                if(openTab == elem.dataset.tariffTab) {
                    elem.classList.add('tariffs-block--active');
                }
            });
        });
    });
</script>