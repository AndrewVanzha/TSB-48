<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if($arResult["ITEMS"])
{
    #количество отзывов
    echo '<div class="content-header">';
    	echo '<div class="heading aligner">Мнения экспертов</div>';
    	echo '<div class="number aligner">( '.$arResult["NAV_RESULT"]->nSelectedCount.' )</div>';
    echo '</div>';
    
    echo '<div class="content-product-reviews">';
        foreach($arResult["ITEMS"] as $arItem)
        {
            if($arItem["FIELDS"]["DATE_ACTIVE_FROM"]){
                $time = $arItem["FIELDS"]["DATE_ACTIVE_FROM"];
            }else if($arItem["FIELDS"]["DATE_CREATE"]){
                $time = $arItem["FIELDS"]["DATE_CREATE"];
            }else{
                $time = $arItem["TIMESTAMP_X"];
            }
            
            echo '<div class="product-reviews">';
                if( $arItem["DISPLAY_PROPERTIES"]["USER_NAME"]["VALUE"] ){
                    echo '<div class="title">'.$arItem["DISPLAY_PROPERTIES"]["USER_NAME"]["VALUE"].'</div>'; 
                }

                echo '<time datetime="'.FormatDate("j-m-Y", strtotime($time) ).'">'.FormatDate("j F Y", strtotime($time) ).'</time>';
                
                if( mb_strlen($arItem["PREVIEW_TEXT"]) > 0 ){
                    if($arItem["PREVIEW_TEXT_TYPE"] == "text"){
                        echo '<p>'.$arItem["PREVIEW_TEXT"].'</p>'; 
                    }else{
                        echo $arItem["PREVIEW_TEXT"];
                    }
                }
            echo '</div>';
        }
    echo '</div>';
    
    if($arParams["DISPLAY_BOTTOM_PAGER"]){ echo $arResult["NAV_STRING"]; }
}
?>