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
$this->setFrameMode(true); ?>

<?
$typeFilter = array("LOGIC"=>"OR");

if (in_array('office', $_SESSION['offices']['type']))
    $typeFilter[] = array("=PROPERTY_ATT_TYPE_VALUE"=>"Офис");
if (in_array('cash', $_SESSION['offices']['type']))
    $typeFilter[] = array("=PROPERTY_ATT_TYPE_VALUE"=>"Банкомат");
if (in_array('partners', $_SESSION['offices']['type']))
    $typeFilter[] = array("=PROPERTY_ATT_TYPE_VALUE"=>"Банкомат партнера");

$rsSections = CIBlockSection::GetList(
                Array("NAME"=>"ASC"),
                array("IBLOCK_ID"=>$arResult['ID']),
                false,
                Array(),
                false
            );
while($arSection = $rsSections->Fetch()){
    $arElement = array();
    $rsElements = CIBlockElement::GetList(
        Array("SORT"=>"ASC"),
        Array("SECTION_ID"=>$arSection['ID'], $typeFilter),
        false,
        false,
        Array("IBLOCK_ID", "ID", "NAME")
    );
    while($arElements = $rsElements->Fetch()){
        $arElement = $arElements;
    }
    if(!empty($arElement))
        $arSections[] = array('NAME' => $arSection['NAME'], 'ID' => $arSection['ID'], 'CODE' => $arSection['CODE']);
}
?>


<div class="page-content page-container">
    <div class="offices-filter clearfix">

        <form class="filter" action="" method="post">

            <div class="city select-box">

                <select id="city" name="city">

                        <option value='' <?if (empty($_SESSION['offices']['cityFilter'])){?>selected<?}?>>

                            Все

                        </option>

                    <?foreach ($arSections as $section){?>

                        <option  value="<?=$section['ID']?>" <?if (htmlspecialchars($_SESSION['offices']['cityFilter']) == $section['ID']){?>selected<?}?>>

                            <?=$section['NAME']?>

                        </option>

                    <?}?>

                </select>

            </div>

            <div class="view">

                <div class="switch-box clearfix">

                    <a id='maps' onclick="maps();" href="javascript:void(0);" class="switch-box_caption <?if(htmlspecialchars($_SESSION['offices']['maps'] != 'no')){?>is-active<?}?>">

                        <span>
                            Карта
                        </span>

                    </a>

                    <input type="hidden" name="maps" value="no">

                    <a id='switch' href="#" class="switch-box_lever is-active-right"></a>

                    <a id='list' onclick="list();" href="javascript:void(0);" class="switch-box_caption <?if(htmlspecialchars($_SESSION['offices']['maps'] == 'no')){?>is-active<?}?>">

                        <span>
                            Списком
                        </span>

                    </a>

                </div>

            </div>

            <div class="type clearfix">

                <label class="check-box">
                    <input type="checkbox" name="type[]" value="office" onchange="$('#send').click();" <?if (in_array('office', $_SESSION['offices']['type'])||(empty($_SESSION['offices']['type']))){?>checked<?}?>>
                    <span class="check-box_caption">
                        Офисы
                    </span>
                </label>

                <label class="check-box">
                    <input type="checkbox" name="type[]" value="cash" onchange="$('#send').click();" <?if (in_array('cash', $_SESSION['offices']['type'])){?>checked<?}?>>
                    <span class="check-box_caption">
                        Банкоматы
                    </span>
                </label>

                <label class="check-box">
                    <input type="checkbox" name="type[]" value="partners" onchange="$('#send').click();" <?if (in_array('partners', $_SESSION['offices']['type'])){?>checked<?}?>>
                    <span class="check-box_caption">
                        Банкоматы партнеров
                    </span>
                </label>

            </div>
            <input hidden id="send" type="submit" name="" value="">
        </form>

    </div>

    <?foreach($arResult['ITEMS'] as $arItem){?>
        <?
        //Изображение
        $img = !empty($arItem['PREVIEW_PICTURE']) ? $arItem['PREVIEW_PICTURE']['SRC'] : $this->GetFolder().'/images/logo.jpg';?>

        <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
        <? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>


        <article class="office-entry content-area page-section clearfix">

            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="content-area_image">
                <img src="<?=$img?>" alt="">
            </a>

            <div class="content-area_text">

                <h2 class="page-title--3 page-title">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" target="_self">
                        <?=$arItem['NAME']?>
                    </a>
                </h2>

                <p>
                    <?=$arItem['PREVIEW_TEXT']?>
                </p>

                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button" target="_self">
                    Подробнее
                </a>

            </div>

        </article>

    <?}?>
</div>

<script type="text/javascript">
    $('.select-box select').customSelect({
        speed: 360
    });$( "#city" ).on( "change", function() {
        $('#send').click();
    });
</script>

<?=$arResult["NAV_STRING"]?>
