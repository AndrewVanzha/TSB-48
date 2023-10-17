<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<div class="subscribe">

    <h2 class="page-title--2 page-title">
        <?=GetMessage("WEBTU_SUBSCRIBE_HEADER")?>
    </h2>
    
    <? if (!empty($arResult['ERRORS'])) { ?>
        <? foreach ($arResult['ERRORS'] as $error) { ?>
            <div class="alert alert-danger">
                <?=$error?>
            </div>
        <? } ?>
    <? } ?>

    <? if (!empty($arResult['SUCCESS'])) { ?>
        <? foreach ($arResult['SUCCESS'] as $success) { ?>
            <div class="alert alert-success">
                <?=$success?>
            </div>
        <? } ?>
    <? } ?>

    <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="subscribe_form clearfix">
        <input type="hidden" name="WEBTU_SUBSCRIBE" value="true">
        <div class="input mi--envelope mi">
            <input type="email" name="EMAIL" placeholder="example@site.ru" class="input-field">
        </div>

        <button class="button">
            <?=GetMessage("WEBTU_SUBSCRIBE_BUTTON")?>
        </button>

    </form>

    <div class="subscribe_note">
        <?=GetMessage("WEBTU_SUBSCRIBE_NOTE")?>
    </div>

</div>