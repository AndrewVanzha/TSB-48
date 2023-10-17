<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);?>
<?global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();?>

<div class="add-reviews-wrap">
    
    <div class="product-reviews-form">
        <div class="heading heading-2">Напишите сообщение:</div>
        <?if (!empty($arResult["ERRORS"])):?>
            <div class="message_err"><?ShowError(implode("<br />", $arResult["ERRORS"]))?></div>
        <?endif;?>
        <?if (strlen($arResult["MESSAGE"]) > 0):?>
            <div class="message_send"><?ShowNote($arResult["MESSAGE"])?></div>
        <?endif?>

        <form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="IBLOCK_ID" value="<?=$arParams['IBLOCK_ID']?>">
            <input type="hidden" name="FORM_ID" value="<?=$arParams['FORM_ID']?>">

            <input type="text" value="<?=$arUser[NAME];?> <?=$arUser[LAST_NAME];?>" name="PROPERTY[NAME][0]">
            <input type="hidden" value="<?=$arUser[ID]?>" name="PROPERTY[153][0]">
            <input type="hidden" value="<?=$arUser[NAME];?> <?=$arUser[LAST_NAME];?>" name="PROPERTY[154][0]">
            <textarea name="PROPERTY[PREVIEW_TEXT][0]" placeholder="Ваше сообщение"></textarea>
            <input type="submit" name="iblock_submit" value="Отправить">
        </form>
    </div>

</div>    