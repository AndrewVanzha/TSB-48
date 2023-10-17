<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $USER;

if ($USER->IsAdmin() && count($arResult["arrFilter"]) > 0) { ?>
    <form action="<?=$APPLICATION->GetCurPageParam("", array("MESSAGE_SEND_".$arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$arResult["COMPONENT_ID"]))?>" method="post" class="section-add-form" enctype="multipart/form-data">
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
        }
        ?>
        <input type="text" name="PROP[NAME]" value="" placeholder="<?=Loc::getMessage("SFA_CAPTION_NAME")?>">
        <input type="submit" name="SFA_SUBMIT" value="<?=Loc::getMessage("SFA_CAPTION_SUBMIT")?>">
    </form>
<? } ?>

