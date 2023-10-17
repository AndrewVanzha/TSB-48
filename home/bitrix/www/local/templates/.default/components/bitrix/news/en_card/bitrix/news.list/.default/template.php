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
?>

<form method="" action="" onsubmit="return false" class="page-section">

    <h2 class="section-title page-title--2 page-title">
        
Choose card
    </h2>

    <div class="clearfix">

        <div class="card-type">

            <!-- <label class="check-box choose-all">
                <input type="checkbox" name="">
                <span class="check-box_caption">
                    Выбрать все
                </span>
            </label> -->

            <div class="aligner clearfix">
                
                <input type="number" name="" value="" class="input-field" placeholder="Credit limit">

            </div>

            </br></br>

            <?foreach ($arResult['FILTER']['TYPE'] as $key => $type) {?>
                <label class="check-box type" data-value="<?=$type?>">
                    <input data-value="<?=$type?>" type="checkbox" name="" <?if($key==0)echo'checked';?>>
                    <span class="check-box_caption">
                        <?=$type?>
                    </span>
                </label>
            <?}?>



        </div>

        <div class="card-type">

            <label class="check-box choose-all">
                <input type="checkbox" name="">
                <span class="check-box_caption">
                    Select all
                </span>
            </label>

            <?foreach ($arResult['FILTER']['PAY_SYSTEM'] as $pay) {?>
                <label class="check-box pay" data-value="<?=$pay?>">
                    <input data-value="<?=$pay?>" type="checkbox" name="">
                    <span class="check-box_caption">
                        <?=$pay?>
                    </span>
                </label>
            <?}?>

        </div>

        <div class="card-type">

            <label class="check-box choose-all">
                <input type="checkbox" name="">
                <span class="check-box_caption">
                    Select all
                </span>
            </label>

            <?foreach ($arResult['FILTER']['VIEW'] as $view) {?>
                <label class="check-box view" data-value="<?=$view?>">
                    <input data-value="<?=$view?>" type="checkbox" name="">
                    <span class="check-box_caption select">
                        <?=$view?>
                    </span>
                </label>
            <?}?>

        </div>

    </div>

   


</form>
<section class="page-section">
    <div class="product-items clearfix">
        <?$i = 0?>
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>

        	<div data-type="<?=$arItem['PROPERTIES']['TYPE']['VALUE']?>" data-pay="<?=$arItem['PROPERTIES']['PAY_SYSTEM']['VALUE']?>" data-view="<?=$arItem['PROPERTIES']['VIEW']['VALUE']?>" class="product-item <?if(++$i > 4) echo 'hidden';?>" id="item">
        		<div class="page-title--4 page-title"> <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="aligner">
        		<?=$arItem['NAME']?> </a> </div>
        		<div class="bg" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
        			<div class="content">
        				<div class="brief">
        					<p>
        						 
Annual maintenance: <br>
                                 <span>
                                    <?
                                        $price = $arItem['PROPERTIES']['PRICE']['VALUE'];
                                        if ( is_numeric($price) ) {
                                            echo number_format($price, 0, ',', ' ').' руб.';
                                        } else {
                                            echo $price;
                                        }
                                    ?>
                                </span>
        					</p>
        					<p>
        						 Advantages: <br>
                                 <span>
			                       <?=$arItem['PREVIEW_TEXT']?>
                                </span>
        					</p>
        				</div>
         <a href="#vaultRequest" onclick="$('#safes_name').val('<?=$arItem['NAME']?>');$('#safes_price').val('<?=$arItem['PROPERTIES']['ATT_PRICE']['VALUE']?>');$('#safes_options').val('<?=$arItem['PROPERTIES']['ATT_SIZE']['VALUE']?>')" data-fancybox="" class="button">
        				Order card</a>
        				<div class="more">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
        					 Read more</a>
        				</div>
        			</div>
        		</div>
        	</div>
        <? } ?>

    </div>
    <a href="javascript:void(0);" onclick="$('.product-item.hidden').removeClass('hidden');" class="show-all button">
        <span class="mi--chevron-down-5 mi">
            Show all 
        </span>
    </a>
</section>

<?=$arResult["NAV_STRING"]?>

<script>
    
    /*var targets = document.querySelectorAll('.product-item');
    var i = 0;

    for (var i = 0; i < targets.length; i++) {
        mutationDOM = 0;
        var observer = new MutationObserver(function(mutations) {
            containerWidth ();
            setMargin ();
        });
        var config = { attributes:true, attributeFilter: ['class'] };

        observer.observe(targets[i], config);
        i++;
    }*/

    function containerWidth () {
        var container = document.querySelector('.product-items');
        var arrayItems = container.querySelectorAll('.product-item');
        var arItems = [];

        for (var i = 0; i < arrayItems.length; i++) {
            if ( !arrayItems[i].classList.contains("filtered") ) {
                arItems.push(arrayItems[i]);
            }
        }

        if (arItems.length < 4) {
            widthItem = arItems[0].offsetWidth;
            style = arItems[0].currentStyle || window.getComputedStyle(arItems[0]);
            marginItem = parseInt(style.marginRight);
            widthContainer = (widthItem + marginItem) * arItems.length;
            widthSection = container.parentElement.offsetWidth;
            if (widthContainer > widthSection) { 
                widthContainer = widthSection;
            }
            container.style.position = "relative";
            if (widthContainer >= 900) {
                container.style.left = marginItem / 2 + "px";
            } else {
                container.style.left = '0';
            }
            container.style.marginLeft = "auto";
            container.style.marginRight = "auto";
            container.style.width = (widthContainer) + "px";
        } else {
            container.style.left = "0";
            container.style.width = "auto";
        }

    }

    function setMargin () {
        var eachFour = true;
        if (document.querySelector('.page-section').offsetWidth <= 900) {
            eachFour = false;
        }

        var arItems = document.querySelectorAll('.product-item');

        var j = 0;

        for (var n = 0; n < arItems.length; n++) {

            if ( arItems[n].classList.contains("filtered") || arItems[n].classList.contains("hidden") ) continue;

            arItems[n].style.marginRight = '30px';

            if (j !== 0) {
                if (eachFour === true) {
                    if( ( (j + 1) % 4 ) == 0 ) arItems[n].style.marginRight = '0';
                } else {
                    if( ( (j + 1) % 2 ) == 0 ) arItems[n].style.marginRight = '0';
                }
            }

            j++;

        }

        if (j == 0) {
            console.log('card not found');
        }

    }

    $(window).on('load', function(){
        console.log('load');
        setTimeout(function () {
            containerWidth ();
            setMargin ();
        }, 10);

        window.onresize = function () { 
            containerWidth ();
            setMargin ();
        };

    });

    checkboxes = document.querySelectorAll('.card-type');

    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].onmouseup = function () {
            setTimeout(function () {
                containerWidth ();
                setMargin ();
            }, 10);
        }
    }


    

</script>