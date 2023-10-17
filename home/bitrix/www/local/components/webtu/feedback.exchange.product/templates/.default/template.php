<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<div id="popup-exchange" class="popup">
    <form class="form-subs" action="<?=$APPLICATION->GetCurPageParam("", array("MESSAGE_SEND_".$arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$arResult["COMPONENT_ID"]))?>" method="post" enctype="multipart/form-data">
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
        
        <div class="title-wrap">
    		<div class="title-form">Заявка на размен</div>
    		<div class="subtitle">Оставьте номер, мы Вам перезвоним</div>
    	</div>
    
    	<div class="group">
            <input type="text" name="PROP[USER_NAME]" required="required" placeholder="Имя*"  value="<?=( ($arResult["REQUEST"]["PROP"]["USER_NAME"]) ? $arResult["REQUEST"]["PROP"]["USER_NAME"] : $arResult["USER"]["NAME"] )?>" />
    	</div>	
    	<div class="group">
            <input type="text" name="PROP[USER_NUMBER]" required="required" placeholder="Телефон*" value="<?=( ($arResult["REQUEST"]["PROP"]["USER_NUMBER"]) ? $arResult["REQUEST"]["PROP"]["USER_NUMBER"] : $arResult["USER"]["PERSONAL_PHONE"] )?>" />
    	</div>
    
    	<? if($arParams["USE_CAPTCHA"] == "Y"){ ?>
        	<div class="group mf-captcha clearfix">
        		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>" />
        		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="115" height="40" alt="CAPTCHA" />
        		<input id="captcha_word" type="text" name="captcha_word" size="30" maxlength="50" />
        	</div>
    	<? } ?>
    
    	<div class="group">
    		<div class="has-input input-2">
    			<input type="checkbox" name="PROP[PRIVACE_POLICE]" class="input-btn" id="consent" checked="checked" />
                <label for="consent">Настоящим подтверждаю, что я ознакомлен и согласен с <a href="/pravila-prodazhi/" target="_blank">правилами продажи</a>.</label>
    		</div>
    	</div>
        
    	<div class="group">
    		<div class="popup-shedule icon-2">Время работы магазина с 9:00  до 18:00 (МСК)  ПН-ПТ</div>
    	</div>
    
    	<div class="group">
            <input class="submit" name="FEP_SUBMIT" type="submit" value="Отправить заявку" />
    	</div>
    </form>   
    <?if( count($arResult["MESSAGE_ERROR"]) > 0 || count($arResult['MESSAGE_SEND']) > 0 ){?>
        <script>
            $(window).load(function(){
                $.fancybox.open({
                	src  : '#popup-exchange',
                	type : 'inline',
                	opts : {
                		onComplete : function() {

                		}
                	}
                });
            });
        </script>
    <?}?>
</div>