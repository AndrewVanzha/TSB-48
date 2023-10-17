<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<form class="aligner" action="<?=$APPLICATION->GetCurPageParam("", array("MESSAGE_SEND_".$arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$arResult["COMPONENT_ID"]))?>" method="post" enctype="multipart/form-data">
    <?
    if( count($arResult["MESSAGE_ERROR_".$arParams["PRODUCT_ID"]]) > 0 ){
        echo '<div class="message_err">';
        foreach( $arResult["MESSAGE_ERROR"] as $item ){
            echo '<div>'.$item.'</div>';
        }
        echo '</div>';
    }
    if( count($arResult['MESSAGE_SEND']) > 0 ){
        echo '<div class="message_send">';
        foreach( $arResult['MESSAGE_SEND_'.$arParams["PRODUCT_ID"]] as $item ){
            echo '<div>'.$item.'</div>';
        }
        echo '</div>';
    }?>
    <input type="submit" name="ABB_SUBMIT" class="button" value="Купить сейчас">
</form>

