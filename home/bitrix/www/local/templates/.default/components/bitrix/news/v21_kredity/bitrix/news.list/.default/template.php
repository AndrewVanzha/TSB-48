<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

LocalRedirect("/chastnym-klientam/", false, "301 Moved permanently");
?>

<div class="v21-section js-v21-tabs">
    <div class="v21-tabs-content">
        <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
            <pre>
                <?var_dump($arItem)?>
            </pre>
        <? } ?>
    </div>
</div>