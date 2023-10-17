<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<div class="product-reviews-form">
	<div class="heading heading-2">Оставьте экспертное мнение</div>
    <form action="<?=$APPLICATION->GetCurPageParam("", array("MESSAGE_SEND_".$arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$arResult["COMPONENT_ID"]))?>" method="post" enctype="multipart/form-data">
        <?if( count($arResult["MESSAGE_ERROR"]) > 0 ){
            echo '<div class="message_err">';
                foreach( $arResult["MESSAGE_ERROR"] as $item ){
                    echo '<div>'.$item.'</div>';
                }
            echo '</div>';
        }
        if( count($arResult['MESSAGE_SEND']) > 0 ){
            echo '<div class="message_send">';
                foreach( $arResult['MESSAGE_SEND'] as $item ){
                    echo '<div>'.$item.'</div>';
                }
            echo '</div>';
        }?>

        <input type="text" name="PROP[USER_NAME]"  placeholder="Имя*"  value="<?=( ($arResult["REQUEST"]["PROP"]["USER_NAME"]) ? $arResult["REQUEST"]["PROP"]["USER_NAME"] : $arResult["USER"]["NAME"] )?>" />

		<textarea name="PROP[RESPONSE]"  placeholder="Ваше мнение"><?=( ($arResult["REQUEST"]["PROP"]["RESPONSE"]) ? $arResult["REQUEST"]["PROP"]["RESPONSE"] : "" )?></textarea>
        
    	<? if($arParams["USE_CAPTCHA"] == "Y"){ ?>
        	<div class="mf-captcha clearfix">
        		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>" />
        		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="115" height="40" alt="CAPTCHA" />
        		<input id="captcha_word" type="text" name="captcha_word" size="30" maxlength="50" />
        	</div>
    	<? } ?>

        <input class="submit" name="FRP_SUBMIT" type="submit" value="Оставить мнение" />
	</form>
    <?if( count($arResult["MESSAGE_ERROR"]) > 0 || count($arResult['MESSAGE_SEND']) > 0 ){?>
        <script>
            $(window).load(function(){
                var target = "#reviews";
                if( $(window).width() >= 904 ) {
                    $('html, body').animate({scrollTop:$(target).offset().top-142}, 800);
                } else {
                    $('html, body').animate({scrollTop:$(target).offset().top}, 800);
                }
                return false;
            });
        </script>
    <?}?>
</div>