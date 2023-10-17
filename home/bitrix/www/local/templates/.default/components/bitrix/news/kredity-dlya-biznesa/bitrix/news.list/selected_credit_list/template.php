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
//debugg($arResult["ITEMS"]);
?>

<section class="creditlist-section">
    <div class="creditlist-block">
        <? foreach($arResult["ITEMS"] as $arItem) : ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
        	<div class="creditlist-item">
                <div class="creditlist-item--top">
                    <div class="creditlist-item__img">
                        <img
                                src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                title="<?= $arItem['PREVIEW_PICTURE']['TITLE'] ?>""
                        alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>""
                        >
                    </div>
                    <h3 class="creditlist-item__header"><?= $arItem['~NAME'] ?></h3>
                    <div class="creditlist-item__properties">
                        <div class="">
                            <? if (!empty($arItem['PROPERTIES']['MAX_DATE']['VALUE'])) : ?>
                                <p><?=GetMessage("LOAN_TERM");?></p>
                                <? if (mb_substr_count($arItem['PROPERTIES']['MAX_DATE']['VALUE'], 'транш') == 0) : ?>
                                    <?/*?><p class="">до <?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?> мес.</p><?*/?>
                                    <? $time_word = ($arItem['PROPERTIES']['MAX_DATE']['VALUE'] > 1)? 'лет' : 'года'; ?>
                                    <p class="">до <?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?> <?=$time_word?></p>
                                <? else: ?>
                                    <p class=""><?=$arItem['PROPERTIES']['MAX_DATE']['VALUE']?></p>
                                <? endif; ?>
                            <? endif; ?>
                        </div>
                        <div class="">
                            <? if (!empty($arItem['PROPERTIES']['MAX_SUM_SPECIAL']['VALUE'])) : ?>
                                <p><?=GetMessage("MAX_AMOUNT");?></p>
                                <p class=""><?=$arItem['PROPERTIES']['MAX_SUM_SPECIAL']['VALUE']?></p>
                            <? else: ?>
                                <? if (!empty($arItem['PROPERTIES']['MAX_SUM']['VALUE'])) : ?>
                                    <p><?=GetMessage("MAX_AMOUNT");?></p>
                                    <p class="">до <?=$arItem['PROPERTIES']['MAX_SUM']['VALUE'] / 1000000 ?> млн рублей</p>
                                <? endif; ?>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="creditlist-item__purpose">
                        <? if (!empty($arItem['PROPERTIES']['PURPOSE']['VALUE'])) : ?>
                            <p class=""><?=GetMessage("PURPOSE");?><?=$arItem['PROPERTIES']['PURPOSE']['VALUE']?></p>
                        <? endif; ?>
                    </div>
                </div>
                <div class="creditlist-item--bottom">
                    <div class="creditlist-item__buttons content">
                        <div class="creditlist-item__buttons-ask js-creditlist__ask">
                            <?/*?><a href="#businessCreditRequest" onclick="$('#credit_name').val('<?=$arItem['~NAME']?>');" data-fancybox=""><?*/?>
                            <a href="#businessCreditRequest" class="v21-button" data-creditbox="<?=$arItem['~NAME']?>">
                                <?=GetMessage("SEND_APP");?>
                            </a>
                        </div>
                        <div class="creditlist-item__buttons-details">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <span><?=GetMessage("READ_MORE");?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                    <path d="M0 4.5L8 4.5M8 4.5L5 1M8 4.5L5 8" stroke="#546770"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

        	</div>
        <? endforeach; ?>
    </div>
</section>


<?//=$arResult["NAV_STRING"]?>


<script>
    $(document).ready(function () {
        $('.js-creditlist__ask a').on('click', function() {
            let href = $(this).attr('href');
            //console.log('href=');
            //console.log(href);
            let credit_type = $(this).data('creditbox');
            //console.log(credit_type);
            $('#credit_name').val(credit_type);
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