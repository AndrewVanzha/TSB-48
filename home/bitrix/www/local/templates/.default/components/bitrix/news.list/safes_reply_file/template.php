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
<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?$arName = explode('-', $arResult['NAME']);?>
<? if (!empty($arResult['ITEMS'])) { ?>

<div class="page-content page-container">
    <section class="page-section">

        <h2 class="section-title page-title--1 page-title">
           <?=/*($arName['1']) ? $arName['1'] : */GetMessage("WEBTU_SPOILER_HEADER"); ?>
        </h2>

        <ul class="info-accordion">

            <? foreach ($arResult['ITEMS'] as $key => $item) { ?>

                <li>

                    <a id="spoiler-<?=$item['ID']?>" href="#" class="info-accordion_heading
                        <? /*if ($key == 0) { ?>
                            is-active
                        <? }*/ ?>
                    ">

                        <strong class="title">
                            <?=$item['NAME']?>
                        </strong>

                        <? /*if ($key == 0) { ?>
                            <span class="toggle mi--chevron-down-2 mi">
                                <?=GetMessage("WEBTU_SPOILER_CLOSE")?>
                            </span>
                        <? } else { ?>
                            <span class="toggle mi--chevron-down-2 mi">
                                <?=GetMessage("WEBTU_SPOILER_OPEN")?>
                            </span>
                        <? }*/ ?>

                        <span class="toggle mi--chevron-down-2 mi">
                            <?=GetMessage("WEBTU_SPOILER_OPEN")?>
                        </span>

                    </a>

                    <div class="info-accordion_content"
                         <? /*if ($key == 0) { ?>
                            style="display: block;"
                         <? }*/ ?>
                    >

                        <?=$item['PREVIEW_TEXT']?>

                        <? if (!empty($item['PROPERTIES']['FILE']['VALUE'])) { ?>

                            <?foreach($item['PROPERTIES']['FILE']['VALUE'] as $key => $file){?>
                            <?$arFile = CFile::GetFileArray($file);?>
                            
                                <a href="<?=$arFile['SRC']?>" target="_blank" class="<?if(stristr($arFile['DESCRIPTION'], 'Архив'))echo 'grey';?>  download-item mi--download-1 mi" style="<?if(stristr($arFile['DESCRIPTION'], 'архив'))echo 'color:#959595';?>">
                                    <span class="name">
                                        <?=($item['PROPERTIES']['FILE']['DESCRIPTION'][$key]) ? $item['PROPERTIES']['FILE']['DESCRIPTION'][$key] : GetMessage("WEBTU_SPOILER_DOWNLOAD");?>
                                    </span>
										<?
										$file = $_SERVER['DOCUMENT_ROOT'].$arFile['SRC'];
        								$fileModify = filectime($file);
										?>
                                    <time class="page-date mi--calendar mi">
                                        <?=GetMessage("WEBTU_PUBLISHED_AT")?> <?=date('Y.m.d', $fileModify)?>
                                    </time>
                                </a>
                            <?}?>

                        <? } ?>

                    </div>

                </li>

            <? } ?>

        </ul>

    </section>
</div>
<? } ?>
