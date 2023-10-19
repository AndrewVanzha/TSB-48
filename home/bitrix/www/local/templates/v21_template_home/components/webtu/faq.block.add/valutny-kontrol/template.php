<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
 }
//debugg($arResult);
// www/local/templates/.default/js/main.js      здесь js
?>

<? IncludeTemplateLangFile(__FILE__); ?>
<div class="faq-questions">
    <h2 class="faq-questions--header"><?= GetMessage("FAQ_BLOCK_HEADER") ?></h2>
    <div class="faq-questions--block">
        <? if (!empty($arResult['FAQ_LIST'])) : ?>
            <ul class="info-accordion">

                <? foreach ($arResult['FAQ_LIST'] as $key => $item) : ?>
                    <li class="faq-questions--block__li">
                        <div id="spoiler-<?=$item['ID']?>" class="info-accordion_heading faq-questions--block__item" data-flag="noword">
                            <div class="faq-questions--block__item-title">
                                <?=$item['UF_VALUTNY_KONTROL_QUESTION']?>
                            </div>
                            <span class="toggle mi--chevron-down-2 mi faq-questions--block__item-mark"></span>
                        </div>
                        <div class="info-accordion_content content-area faq-questions--block__item-box">
                            <?=$item['UF_VALUTNY_KONTROL_ANSWER']?>
                        </div>
                    </li>
                <? endforeach; ?>

            </ul>
        <? endif; ?>

    </div>
</div>
