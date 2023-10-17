<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<form action="" class="company-info-filter clearfix">

    <div class="type select-box">

        <select name="">

            <option value="">
                Все категории информации
            </option>

            <?foreach($arResult['FILTER']['CATEGORY'] as $arCat){?>

                <option value="">
                    <?=$arCat?>
                </option>

            <?}?>

        </select>

    </div>

    <div class="date select-box">

        <select name="">

            <option value="">
                За все время
            </option>

            <?foreach($arResult['FILTER']['YEARS'] as $arYear){?>

                <option value="">
                    <?=$arYear?>
                </option>

            <?}?>

        </select>

    </div>

</form>

<ul class="info-accordion">

    <?foreach($arResult['ITEMS'] as $arItem){?>

        <li>

            <a href="#" class="info-accordion_heading" id="<?=$arItem['CODE']?>" <?if (trim($arItem['NAME']) == 'Информация о ставках') echo 'id="rates-info"';?>>

                <strong class="title">
                    <?=$arItem['NAME']?>
                </strong>

                <span class="toggle mi--chevron-down-2 mi">
                    Развернуть
                </span>

            </a>

            <div class="info-accordion_content">
                
                <?=$arItem['DESCRIPTION']?>

                <?foreach ($arItem['ITEMS'] as $arElement){?>
                    <div download data-year="<?=$arElement['YEAR']?>" data-category="<?=$arElement['PROPERTY_ATT_CATEGORY_VALUE']?>" class="download-element">
                        <div ><?=$arElement['DETAIL_TEXT']?></div>
                        <?if($arElement['FILE']) {?>
                            <a  href="<?=$arElement['FILE']?>" class="download-item mi--download-1 mi" target="_blank">
                                <span class="name">
                                    <?=$arElement['NAME']?>
                                </span>
                                <time class="page-date mi--calendar mi">
                                    Дата публикации: <?=$arElement['DATE_ACTIVE_FROM']?>
                                </time>
                            </a>
                        <?}?>
                    </div>
                <?}?>

            </div>

        </li>

    <?}?>

</ul>