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
//debugg($arResult);
$arFile = CFile::GetFileArray($arResult['PICTURE'], false);
$imageWidth = 380;  //
$imageHeight = 784;  //
//echo '<pre>';print_r($arFile);echo '</pre>';
$picFile = CFile::ResizeImageGet($arFile, array('width'=>$imageWidth, 'height'=>$imageHeight), BX_RESIZE_IMAGE_EXACT);
if(!isset($picFile['src'])) { $picFile['src'] = $arFile['SRC']; }
//print_r($picFile);
?>
<div class="mir-open-list">
    <div class="mir-open-img-box">
        <img
            class=""
            src="<?=$picFile["src"]?>"
            alt=""
            title=""
        />
    </div>
    <div class="mir-open-text-block">
        <h2 class="v21-h2 mir-open-header"><?= $arResult['~DESCRIPTION'] ?></h2>
        <div class="mir-open-wrap">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="mir-open-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><span><?echo $arItem["NAME"]?></span></a>
                        <?else:?>
                            <div class="mir-open-item--header"><?echo $arItem["NAME"]?></div>
                        <?endif;?>
                    <?endif;?>

                    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                        <div class="mir-open-item--subline"><?echo $arItem["PREVIEW_TEXT"];?></div>
                    <?endif;?>
                </div>
            <?endforeach;?>
        </div>

        <div class="mir-open-subitem">
            <h3 class="v21-h4 mir-open-subitem--header">Как пользоваться</h3>
            <div class="mir-open-subitem--box">
                <ol class="mir-open-subitem--box_box1">
                    <li>Разблокируйте экран смартфона</li>
                    <li>Поднесите устройство к терминалу</li>
                    <li>Терминал подтвердит статус оплаты</li>
                    <li>Подробная информация о приложении <a href="https://mironline.ru/mirpay/" target="_blank"><span class="v21-link__text">Mir Pay</span></a></li>
                </ol>
                <div class="mir-open-subitem--box_box2">Платить Mir Pay можно в любом терминале, в котором принимаются бесконтактные карты «Мир». Перед началом оплаты необходимо выбрать Mir Pay в качестве главного кошелька для оплаты и включить NFC. </div>
            </div>
        </div>

    </div>
</div>
