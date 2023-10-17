<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)) {?>
    <div class="row">
        <? 
            foreach($arResult as $arItem)
            {
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1){ continue; }

                $arParams_trans = array("replace_space"=>"-","replace_other"=>"-");
                $trans = Cutil::translit($arItem["TEXT"],"ru",$arParams_trans);
    
                if($arItem["SELECTED"]){
                    echo '<div class="account-block">';
                        echo '<a href="'.$arItem["LINK"].'" class="'.$trans.' is-active"><span class="aligner">'.$arItem["TEXT"].'</span></a>';
                    echo '</div>';
                }else{
                    echo '<div class="account-block">';
                        echo '<a href="'.$arItem["LINK"].'" class="'.$trans.'"><span class="aligner">'.$arItem["TEXT"].'</span></a>';
                    echo '</div>';
                }
            }
        ?>
    </div>
<? } ?>