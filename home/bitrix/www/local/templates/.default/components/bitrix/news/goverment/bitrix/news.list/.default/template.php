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

$sectionsPre = CIblockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE" => "Y"));
$sections = array();

while ($section = $sectionsPre->Fetch()) {
    $section['ITEMS'] = array();
    
    foreach ($arResult['ITEMS'] as $item) {
        if ($item['IBLOCK_SECTION_ID'] == $section['ID']) {
            $section['ITEMS'][] = $item;
        }
    }
    
    $sections[] = $section;
}

?>

<ul class="info-accordion">

    <? foreach ($sections as $key => $section) { ?>
        
        <? if (empty($section['ITEMS'])) { ?>
            <? continue; ?>
        <? } ?>
        
        <li>

            <a href="#" class="info-accordion_heading 
                <? if ($key == 0) { ?>
                    is-active
                <? } ?>
            ">
    
                <strong class="title">
                    <?=$section['NAME']?>
                </strong>

                <? if ($key == 0) { ?>
                    <span class="toggle mi--chevron-down-2 mi">
                        <?=GetMessage("WEBTU_GOVERMENT_CLOSE")?>
                    </span>
                <? } else { ?>
                    <span class="toggle mi--chevron-down-2 mi">
                        <?=GetMessage("WEBTU_GOVERMENT_OPEN")?>
                    </span>
                <? } ?>
    
            </a>
    
            <div class="info-accordion_content"
                <? if ($key == 0) { ?>
                    style="display: block;"
                <? } ?>
            >
                
                <? foreach ($section['ITEMS'] as $item) { ?>
                    <? $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
                    <? $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
                    <article id="<?=$this->GetEditAreaId($item['ID']);?>" class="hq-entry page-section content-area clearfix">
                        
                        <? if ($item['PREVIEW_PICTURE']) { ?>
                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>" class="content-area_image">
                        <? } ?>
        
                        <div class="content-area_text">
        
                            <div class="hq-entry_heading">
        
                                <div class="title">
        
                                    <?=$item['PROPERTIES']['POSITION']['VALUE']?>
        
                                    <h3 class="page-title--4 page-title">
                                        <a href="<?=$item['DETAIL_PAGE_URL']?>">
                                            <?=$item['NAME']?>
                                        </a>
                                    </h3>

                                    <?=GetMessage("WEBTU_GOVERMENT_BIRTHDATE")?> <?=$item['PROPERTIES']['BIRTHDATE']['VALUE']?>
        
                                </div>
        
                                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="button">
                                    <?=GetMessage("WEBTU_GOVERMENT_BIOGRAPHY")?>
                                </a>
        
                            </div>
        
                            <?=$item['PREVIEW_TEXT']?>
        
                        </div>
        
                    </article>
                <? } ?>
                
            </div>
    
        </li>
    <? } ?>
</ul>