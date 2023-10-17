<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true){ die(); }

if(!empty($arParams["~AUTH_RESULT"])){
    $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
    echo '<div class="alert '.($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger").'">'.nl2br(htmlspecialcharsbx($text)).'</div>';
}

if($arParams["~AUTH_RESULT"]["TYPE"] != "OK"){
?>
    <div class="form-contacts">
        <form name="bform"  method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <?if($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="SEND_PWD" />
            <p class="bx-authform-content-container"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></p>
            <div class="form-group">
                <input type="email" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN_EMAIL")?>*"/>
                <input type="hidden" name="USER_EMAIL" />
            </div>
            <div class="form-group clearfix">
                <div class="left"><a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a></div>
                <div class="right"><a href="/auth/?register=yes" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></div>
            </div>
            <div class="form-group">
                <div class="has-submit aligner">
                    <input type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" class="button-1">
                </div>
            </div>
            <script type="text/javascript">
                document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
                document.bform.USER_LOGIN.focus();
            </script>
        </form>
    </div>
<?}else{?>
    <div class="form-contacts">
        <div class="form-group clearfix">
            <div class="left"><a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a></div>
            <div class="right"><a href="/auth/?register=yes" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></div>
        </div>
    </div>
<?}?>