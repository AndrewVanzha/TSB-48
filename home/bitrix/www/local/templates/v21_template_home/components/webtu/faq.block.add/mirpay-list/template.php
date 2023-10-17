<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
 }
//debugg($arResult);
// www/local/templates/.default/js/main.js      здесь js
?>

<? IncludeTemplateLangFile(__FILE__); ?>
<div class="v21-section faq-questions">
    <h2 class="v21-h2 faq-questions--header"><?= GetMessage("FAQ_BLOCK_HEADER") ?></h2>
    <div class="faq-questions--block">
        <? if (!empty($arResult['FAQ_LIST'])) : ?>
            <ul class="info-accordion">

                <? foreach ($arResult['FAQ_LIST'] as $key => $item) : ?>
                    <li class="faq-questions--block__li">
                        <a id="spoiler-<?=$item['ID']?>" href="#" class="info-accordion_heading faq-questions--block__item" data-flag="noword">
                            <div class="faq-questions--block__item-title">
                                <?=$item['UF_MIRPAY_QUESTION']?>
                            </div>
                            <span class="toggle mi--chevron-down-2 mi faq-questions--block__item-mark"></span>
                        </a>
                        <div class="info-accordion_content content-area faq-questions--block__item-box">
                            <?=$item['UF_MIRPAY_ANSWER']?>
                        </div>
                    </li>
                <? endforeach; ?>

            </ul>
        <? endif; ?>

    </div>
</div>

<?/*?>
<div class="v21-section faq-questions">
    <h2 class="v21-h2 faq-questions--header"><?= GetMessage("FAQ_BLOCK_HEADER") ?></h2>
    <div class="faq-questions--block">
        <?foreach ($arResult["FAQ_LIST"] as $arItem) : ?>
            <div class="faq-questions--block__item">
                <h3 class="faq-questions--block__item-header js-get-answer"><?= $arItem["UF_MIRPAY_QUESTION"] ?></h3>
                <div class="faq-questions--block__item-box"><?= $arItem["UF_MIRPAY_ANSWER"] ?></div>
            </div>
        <?endforeach;?>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        let answerSwitch = true;
        $('.js-get-answer').on('click', function () {
            let $this = $(this);
            let wTime = 200; // время срабатывания
            $this[0].classList.toggle('show-answer__rotate');
            //$this.next().toggleClass('v21-show-answer');
            //$this.next().toggle(1000);
            if(answerSwitch) {
                $this.next().animate({
                    height: "100%"
                }, wTime, function () {
                    $this.next().fadeIn(wTime);
                });
                answerSwitch = false;
            } else {
                $this.next().fadeOut(wTime, function () {
                    $this.next().animate({
                        height: "0"
                    }, wTime);
                });
                answerSwitch = true;
            }
        });
    });
</script>
<?*/?>
<?/*?>
<section class="v21-section faq-container">
    <h2 class="faq-container--header"><?= GetMessage("FAQ_BLOCK_HEADER") ?></h2>
    <div class="faq-container--block">
        <? $ii = 1;
        foreach ($arResult["FAQ_LIST"] as $arItem) : ?>
            <div class="faq-container--block__item">
                <input id="faq-<?= $ii; ?>" name="faq-accordion" type="checkbox" />
                <label for="faq-<?= $ii++; ?>" class="faq-container--block__item-header"><?= $arItem["UF_MIRPAY_QUESTION"] ?></label>
                <article class="faq-container--block__item-box">
                    <p><?= $arItem["UF_MIRPAY_ANSWER"] ?></p>
                </article>
            </div>
        <? endforeach; ?>
    </div>
</section>
<?*/?>
