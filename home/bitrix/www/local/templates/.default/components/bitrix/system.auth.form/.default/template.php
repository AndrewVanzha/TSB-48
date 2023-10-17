<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CJSCore::Init();
?>
<div class="col">
    <? if($arResult["FORM_TYPE"] == "login") { ?>
        <div class="form-contacts">
            <div class="title">Вход в личный кабинет</div>
            <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?/*--- Ошибки ---*/?>
                <? if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) { ?>
                    <div class="form-group message_err "><? ShowMessage($arResult['ERROR_MESSAGE']); ?></div>
                <? } ?>
                <? if($arResult["BACKURL"] <> '') { ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <? } ?>
                <? foreach ($arResult["POST"] as $key => $value) { ?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <? } ?>
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <div class="form-group">
                    <input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
                    <script>
                        BX.ready(function() {
                            var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                            if (loginCookie)
                            {
                                var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                var loginInput = form.elements["USER_LOGIN"];
                                loginInput.value = loginCookie;
                            }
                        });
                    </script>
                </div>
                <div class="form-group">
                    <input type="password" name="USER_PASSWORD" maxlength="50" size="17" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
                </div>

                <? if ($arResult["STORE_PASSWORD"] == "Y") { ?>
                    <div class="form-group">
                        <div class="has-input input-2">
                            <input type="checkbox" class="input-btn" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y">
                            <label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>">
                                <span class="aligner"><?=GetMessage("AUTH_REMEMBER_SHORT")?></span>
                            </label>
                        </div>
                    </div>
                <? } ?>

                <div class="form-group">
                    <div class="aligner">
                        <input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" class="button-1">
                    </div>
                    <noindex>
                        <div class="aligner">
                            <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
                        </div>
                    </noindex>
                </div>
            </form>
        </div>
    <? } else { ?>
    
        <? header("Location: /"); ?>
        
        <div class="form-contacts">
            <p>Вы зарегистрированы на сайте и успешно авторизованы.</p>
            <a href="/?logout=yes">Выйти</a>
        </div>
    <? } ?>
</div>

