<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true){die();}

if(!empty($arParams["~AUTH_RESULT"])){
    $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
    echo '<div class="alert '.($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger").'">'.nl2br(htmlspecialcharsbx($text)).'</div>';
}

if($arParams["~AUTH_RESULT"]["TYPE"] != "OK"){
?>
<div class="form-contacts">
    <form name="bform"  method="post" action="<?=$arResult["AUTH_URL"]?>">
        <? if (strlen($arResult["BACKURL"]) > 0): ?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <? endif ?>
        <input type="hidden" name="AUTH_FORM" value="Y">
        <input type="hidden" name="TYPE" value="CHANGE_PWD">
        <div class="form-group">
            <input type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>"  placeholder="<?=GetMessage("AUTH_LOGIN")?>"/>
        </div>
        <div class="form-group">
            <input type="hidden" name="USER_CHECKWORD" maxlength="255" value="<?=$arResult["USER_CHECKWORD"]?>" placeholder="<?=GetMessage("AUTH_CHECKWORD")?>"/>
        </div>
        <div class="form-group">
            <input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>"/>
        </div>
        <div class="form-group">
            <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>"/>
        </div>
        <?if ($arResult["USE_CAPTCHA"] == "Y"):?>
            <div class="form-group">
                <div class="captcha-input input-2">
                    <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                    <input type="text" name="captcha_word" maxlength="50" value="" />
                </div>
            </div>
        <?endif?>
        <div class="form-group clearfix">
            <div class="right"><a href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a></div>
        </div>
        <div class="form-group">
            <div class="aligner">
                <input type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>">
            </div>
        </div>
        
        <script type="text/javascript">
            document.bform.USER_LOGIN.focus();
        </script>
    </form>
</div>
<?}else{?>
    <div class="form-contacts">
        <div class="form-group clearfix">
            <div class="left"><a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a></div>
        </div>
    </div>
<?}?>