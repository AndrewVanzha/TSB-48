<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true){ die(); }

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

//one css for all system.auth.* forms
//$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");

?>
<?/*--- Авторизация через соц сети (uLogin) ---*/?>
<?$APPLICATION->IncludeComponent(
    "ulogin:auth",
    "",
    Array(
        "GROUP_ID" => array("2", "3", "4", "6"),
        "LOGIN_AS_EMAIL" => "Y",
        "SEND_EMAIL" => "Y",
        "SOCIAL_LINK" => "N",
        "ULOGINID1" => "2aad5593",
        "ULOGINID2" => ""
    )
);?>
<div class="row">
    <div class="col">
        <div class="form-contacts">
            <div class="title">Вход в личный кабинет</div>
            <form name="form_auth"  method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?if(!empty($arParams["~AUTH_RESULT"])):?>
                    <?$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);?>
                    <div class="alert alert-danger"><?=nl2br(htmlspecialcharsbx($text))?></div>
                <?endif?>

                <?if($arResult['ERROR_MESSAGE'] <> ''):?>
                    <?$text = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);?>
                    <div class="alert alert-danger"><?=nl2br(htmlspecialcharsbx($text))?></div>
                <?endif?>

                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <?if (strlen($arResult["BACKURL"]) > 0):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif?>
                <?foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?endforeach?>

                <div class="form-group">
                    <input type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" class="input-field" placeholder="<?=GetMessage("AUTH_LOGIN")?>"/>
                </div>
                <div class="form-group">
                    <input type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" class="input-field" placeholder="<?=GetMessage("AUTH_PASSWORD")?>"/>
                </div>

                <?if ($arResult["CAPTCHA_CODE"]):?>
                    <div class="form-group">
                        <div class="captcha-input input-2">
                            <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                            <input type="text" name="captcha_word" maxlength="50" value=""/>
                        </div>
                    </div>
                <?endif?>

                <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
                    <div class="form-group">
                        <noindex> <a href="/auth/?register=yes" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex>
                        <div class="has-input input-2">
                            <input type="checkbox" class="input-btn" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />
                            <label for="USER_REMEMBER" title="<?=GetMessage("AUTH_REMEMBER_ME")?>">
                                <span class="aligner"><?=GetMessage("AUTH_REMEMBER_ME")?></span>
                            </label>
                        </div>
                    </div>

                <?endif;?>

                <div class="form-group">
                    <div class="aligner">
                        <input type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" class="button-1">
                    </div>
                    <?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
                        <div class="aligner">

                            <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
                        </div>
                    <?endif?>
                </div>


            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?if (strlen($arResult["LAST_LOGIN"])>0):?>
    try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
    <?else:?>
    try{document.form_auth.USER_LOGIN.focus();}catch(e){}
    <?endif?>
</script>
