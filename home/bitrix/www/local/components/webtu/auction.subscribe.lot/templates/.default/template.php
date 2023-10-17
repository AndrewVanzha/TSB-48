<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>
<div class="block">
    <div class="heading-3">Узнать о начале аукциона первым</div>
    <form class="auction-form subscribe aligner" action="<?=$APPLICATION->GetCurPageParam("", array("MESSAGE_SEND_".$arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$arResult["COMPONENT_ID"]))?>" method="post" enctype="multipart/form-data">
        <?
        if( count($arResult["MESSAGE_ERROR"]) > 0 ){
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
        <?if ($USER->IsAuthorized()) {?>
            <input type="hidden" name="PROP[EMAIL]" placeholder="E-mail *" value="<?=$arUser['EMAIL']?>">
        <?} else {?>
            <input type="email" name="PROP[EMAIL]" placeholder="E-mail *">
        <?}?>    
        <input type="submit" name="ASL_SUBMIT" class="button subscribe" value="Подписаться">
    </form>
</div>