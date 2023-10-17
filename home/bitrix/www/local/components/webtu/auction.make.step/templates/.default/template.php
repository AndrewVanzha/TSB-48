<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?/*--- Если пользователь не последний сделал ставку ---*/?>
<? if ( $arParams["CAN_AUCTION_STEP"] == "Y" ) {?>
    <form action="<?=$APPLICATION->GetCurPageParam("", array("MESSAGE_SEND_".$arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$arResult["COMPONENT_ID"]))?>" method="post" enctype="multipart/form-data">
        <button type="submit" name="AMS_SUBMIT_<?=$arParams["PRODUCT_ID"]?>" class="add-bid" value="Сделать ставку"><span class="icon-2">Сделать ставку</span></button>
    </form>
<? } else { ?>
    <div class="auction-end">Ваша ставка последняя</div>
<? } ?>

<?if( count($arResult["MESSAGE_ERROR_".$arParams["PRODUCT_ID"]]) > 0 || count($arResult['MESSAGE_SEND_'.$arParams["PRODUCT_ID"]]) > 0 ){?>

    <div id="popup-thank-<?=$arParams["PRODUCT_ID"]?>" class="popup">
        <div class="title-wrap">
            <?if( count($arResult["MESSAGE_ERROR_".$arParams["PRODUCT_ID"]]) > 0 ){

                echo '<div class="title-form">Ошибка</div>';
                echo '</br>';
                
                foreach( $arResult["MESSAGE_ERROR_".$arParams["PRODUCT_ID"]] as $item ){
                    echo '<div class="message_err">'.$item.'</div>';
                }
            }
            if( count($arResult['MESSAGE_SEND_'.$arParams["PRODUCT_ID"]]) > 0 ){

                echo '<div class="title-form">Успешно</div>';
                echo '</br>';
                foreach( $arResult['MESSAGE_SEND_'.$arParams["PRODUCT_ID"]] as $item ){
                    echo '<div class="message_send">'.$item.'</div>';
                }
            }?>
        </div>
    </div>

    <script>
        $(window).load(function(){
            $.fancybox.open({
                src  : '#popup-thank-<?=$arParams["PRODUCT_ID"]?>',
                type : 'inline',
                opts : {
                    onComplete : function() {

                    }
                }
            });
        });
    </script>
<?}?>
