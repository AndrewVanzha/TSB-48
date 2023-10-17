<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="row">
    <div class="col">
        <div class="form-contacts">
            <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" id="regform">
                <?if(!empty($arParams["~AUTH_RESULT"])):
                    $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);?>
                    <div class="<?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "message_send":"message_err")?>"><font class="errortext"><?=nl2br(htmlspecialcharsbx($text))?></font></div>
                <?endif?>

                <?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
                    <div class="message_send"><?echo GetMessage("AUTH_EMAIL_SENT")?></div>
                <?else:?>

                    <?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
                    <div class="message_err"><font class="errortext"><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></font></div>
                    <?endif?>
                    <noindex>
                        <?if($arResult["BACKURL"] <> ''):?>
                            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                        <?endif?>
                        <input type="hidden" name="AUTH_FORM" value="Y" />
                        <input type="hidden" name="TYPE" value="REGISTRATION" />

                        <?if($arResult["SECURE_AUTH"]):?>
                            <div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>
                            <script type="text/javascript">
                                document.getElementById('bx_auth_secure').style.display = '';
                            </script>
                        <?endif?>
                        <div class="form-group">
                            <input type="hidden" name="USER_LOGIN" maxlength="255" value="<?=( ($arResult["USER_LOGIN"] ) ? $arResult["USER_LOGIN"] : md5(mktime()))?>" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="off"  placeholder="<?=GetMessage("AUTH_PASSWORD_REQ")?>"/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="off" placeholder="<?=GetMessage("AUTH_CONFIRM")?>"/>
                        </div>
                        <div class="form-group">
                            <input type="email" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" placeholder="<?=GetMessage("AUTH_EMAIL")?>"/>
                        </div>
                        <?if ($arResult["USE_CAPTCHA"] == "Y"):?>
                            <div class="form-group">
                                <div class="captcha-input input-2">
                                    <div id="captcha_container">
                                        <input id="captcha_sid" type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                        <img class="captcha-img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                                    </div>    
                                    <input type="text" name="captcha_word" maxlength="50" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <a id="refresh_captcha" href="#">Обновить код</a>
                            </div>
                        <?endif?>
                        <div class="form-group">
                            <div class="has-input input-2">
                                <input type="checkbox" name="agreements" class="input-btn" id="agreements">
                                <label for="agreements"><span class="aligner">Ознакомлен с <a href="/pravila-prodazhi/" target="_blank">Правилами продажи</a>, соглашаюсь на обработку моих персональных данных</span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="aligner">
                                <input type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>"  />
                            </div>
                        </div>
                    </noindex>
                   
                <?endif?>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
      $('#refresh_captcha').click(function(){
         $.getJSON('<?=$this->__folder?>/reload_captcha.php', function(data) {
            $('.captcha-img').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captcha_sid').val(data);
         });
         return false;
      });
   });
</script>