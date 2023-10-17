<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <section class="page-section">

        <h2 class="spoiler-title" id="spoiler">
            <?=GetMessage("WEBTU_SPOILER_HEADER")?>
        </h2>

        <ul class="info-accordion">

            <? foreach ($arResult['ITEMS'] as $key => $item) { ?>

                <li>

                    <a href="#" id="spoiler-<?=$item['ID']?>" class="info-accordion_heading
                        <? /*if ($key == 0) { ?>
                            is-active
                        <? }*/ ?>
                    ">

                        <strong class="title" >
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

                    <div class="info-accordion_content content-area"
                         <? /*if ($key == 0) { ?>
                            style="display: block;"
                         <? }*/ ?>
                    >

                        <?=$item['PREVIEW_TEXT']?>

                        <? if (!empty($item['PROPERTY_FILE_VALUE'])) { ?>
                            <?foreach($item['PROPERTY_FILE_VALUE'] as $file){?>
                                <?if($file > 0){?>
                                    <?$arFile = CFile::GetFileArray($file)?>
                                    
                                    <a href="<?=$arFile['SRC']?>" target="_blank" class="<?if(stristr($arFile['DESCRIPTION'], 'Архив'))echo 'grey';?> download-item mi--download-1 mi" style="<?if(stristr($arFile['DESCRIPTION'], 'архив'))echo 'color:#959595';?>">
                                        <span class="name">
                                            <?=($arFile['DESCRIPTION']) ? $arFile['DESCRIPTION'] : GetMessage("WEBTU_SPOILER_DOWNLOAD")?>
                                        </span>
										<?
										$file = $_SERVER['DOCUMENT_ROOT'].$arFile['SRC'];
        								$fileModify = filemtime($file);
										?>
                                        <time class="page-date mi--calendar mi">
											<?=GetMessage("WEBTU_PUBLISHED_AT")?> <?=date('d.m.Y', $fileModify)?>
                                        </time>
                                    </a>
                                <?}?>
                            <?}?>
                        <? } ?>

                    </div>

                </li>

            <? } ?>

        </ul>

    </section>
<? } ?>