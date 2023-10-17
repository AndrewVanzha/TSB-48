<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<?$officeId = htmlspecialchars($_REQUEST['office']);?>
<?
$phpSelf = $_SERVER['PHP_SELF'];
if (substr($phpSelf, -9) == "index.php") {
    $phpSelf = substr($phpSelf, 0, -9);
}
if ( isset($_GET["city"]) && ($_GET["city"] != $_SESSION["city"]) ) {
    header('Location: http://'.$_SERVER['SERVER_NAME'].$phpSelf);
    exit();
}
?>

<form action="" method="get" class="exchange-converter">

    <input type="hidden" name="city" value="<?=$_SESSION["city"]?>">

    <div class="exchange-converter_location">

        <div class="select-box">
            <select name="office">

                <?foreach ($arResult['OFFICE'] as $arOffice){?>
                    <?if ($arOffice['NAME'] != 'iSimple' ) {
	$officeName = $arOffice['PROPERTY_EN_OFFICE_NAME_VALUE'];
                    } else {
                        $officeName = 'TSB-online';
                    }?>

                    <option value="<?=$arOffice['ID']?>" <?if($arOffice['ID'] == $officeId)echo 'selected';?>>
                        <?=$officeName?>
                    </option>

                <?}?>
                   
            </select>

        </div>
        <div class="small-note">
            <?if(!empty($arResult['ADDRESS_OFFICE'])){?>
                <p>Адрес: <?=$arResult['ADDRESS_OFFICE']?></p>
            <?}?>
	        <?if(!empty($arResult['ADDRESS_OFFICE'])){?>
                <p>Телефон: <?=$arResult['PHONE_OFFICE']?></p>
	        <?}?>
        </div>

    </div>

    <h2 class="page-title--2 page-title">
        Currency converter
    </h2>

    <div class="exchange-converter_type" id="exchangeConverterFlipSides">

        <div class="switch-box clearfix">

            <label class="switch-box_caption switch-left">

                <input type="radio" name="" checked>

                <span>
                    Sell
                </span>

            </label>

            <div class="switch-box_lever exchange" ></div>

            <label class="switch-box_caption switch-right">

                <input type="radio" name="">

                <span>
                    Buy
                </span>

            </label>

        </div>

    </div>

    <div class="aligner clearfix">

        <div class="exchange-converter_value clearfix" id='currency'>

            <input type="number" name="" value="100" min="0" step="0.01" class="input-field" data-type="cur">

            <div class="select-box">

                <select name="">

                    <?$i=0;?>
                    <?foreach ($arResult['CUR'] as $currency){?>
                        <?if($currency['BUY']>0){?>
                            <?if ($i++ == 0)$curVar = $currency['SELL'];?>
                            <option value="" data-buy="<?=$currency['BUY']?>" data-sell="<?=$currency['SELL']?>">
                                <?=$currency['NAME']?>
                            </option>
                        <?}?>
                        
                    <?}?>
 
                </select>

            </div>

        </div>

        <a href="javascript:void(0);" id="flip" class="flip-sides mi--flip mi" ></a>

        <div class="exchange-converter_value clearfix" id='rub'>

            <input type="number" name="" value="" min="0" step="0.01" class="input-field" data-type="rub">

            <div class="select-box">

                <select name="">


                    <option value="" data-buy="1" data-sell="1">
                        RUB
                    </option>


                </select>

            </div>

        </div>

    </div>

    <div class="note">
        At the exchange rate of <span id='val-cur'><?=$curVar?></span> rubles
	    <?if ($arResult['NAME_OFFICE'] != 'iSimple') {
		    $officeName = $arResult['NAME_OFFICE'];
	    } else {
		    $officeName = 'ТСБ-онлайн';
	    }?>
        <p>Currency exchange rates «<?=$officeName;?>» data as of  <span id="exchange-date"></span></p>
    </div>

</form>
