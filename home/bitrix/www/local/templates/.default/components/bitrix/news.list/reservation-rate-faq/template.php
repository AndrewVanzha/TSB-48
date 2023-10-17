<? use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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

Loc::loadMessages(__FILE__);
?>
<div class="rr-faq">
    <header class="rr-faq__header">
        <h2 class="rr-faq__title page-title"><?= Loc::getMessage("RESERVATION_RATE_FAQ") ?></h2>
    </header>
    <div class="rr-faq__wrapper">
        <? $i = 0;
        foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="rr-faq__item <?= $i === 0 ? 'rr-faq__item_active' : '' ?>">
                <div class="rr-faq__question"><? echo $arItem["NAME"] ?></div>
                <div class="rr-faq__answer"><? echo $arItem["DETAIL_TEXT"]; ?></div>
            </div>
            <? $i++;
        endforeach;
        ?>
    </div>
</div>
