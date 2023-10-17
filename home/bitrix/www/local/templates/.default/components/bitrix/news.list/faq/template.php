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
<div class="question-block-wrap">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="question-block">
            <div class="title">Вопрос.</div>
            <div class="text"><?=$arItem['PREVIEW_TEXT']?></div>
            <div class="name"><?=$arItem['PROPERTIES']['NAME']['VALUE']?> <?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
        </div>
        <div class="question-block">
            <div class="title">Ответ.</div>
            <div class="text"><?=$arItem['DETAIL_TEXT']?>
            </div>
            <div class="name">Администратор <?=$arItem['PROPERTIES']['DATE_ANSWER']['VALUE']?></div>
        </div>
                

    <?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

</div>