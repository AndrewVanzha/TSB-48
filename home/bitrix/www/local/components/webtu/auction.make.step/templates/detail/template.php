<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

echo '<pre>';
print_r();
echo '</pre>';
?>
<div class="auction-form-wrap">
    <?
    if( count($arResult["MESSAGE_ERROR_".$arParams["PRODUCT_ID"]]) > 0 ){
        echo '<div class="message_err">';
        foreach( $arResult["MESSAGE_ERROR_".$arParams["PRODUCT_ID"]] as $item ){
            echo '<div>'.$item.'</div>';
        }
        echo '</div>';
    }
    if( count($arResult['MESSAGE_SEND_'.$arParams["PRODUCT_ID"]]) > 0 ){
        echo '<div class="message_send">';
        foreach( $arResult['MESSAGE_SEND_'.$arParams["PRODUCT_ID"]] as $item ){
            echo '<div>'.$item.'</div>';
        }
        echo '</div>';
    }?>
    <?/*--- Если пользователь не последний сделал ставку ---*/?>
    <? if ( $arParams["CAN_AUCTION_STEP"] == "Y" ) {

        $step_rate = $arResult["PRODUCT_INFO"]["PROPS"]["STEP_RATE"]["VALUE"];

        $new_price = number_format($arResult["PRODUCT_INFO"]["PRICE_INFO"]["PRICE"] + $step_rate,0,'.',' ');

        ?>
        <form action="<?=$APPLICATION->GetCurPageParam("", array("MESSAGE_SEND_".$arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$arResult["COMPONENT_ID"]))?>" class="auction-form aligner" method="post" enctype="multipart/form-data">
            <input type="text" name="PROP_<?=$arParams["PRODUCT_ID"]?>[NEW_PRICE]" placeholder="<?=$new_price?>">
            <button type="submit" name="AMS_SUBMIT_<?=$arParams["PRODUCT_ID"]?>" value="сделать ставку"><span class="icon-2">сделать ставку</span></button>
        </form>
        <div class="auction-note aligner">Минимальный шаг <?=$step_rate?> рублей</div>
    <? } else { ?>
        <div class="auction-note aligner">Ваша ставка последняя</div>
    <? } ?>
</div>
