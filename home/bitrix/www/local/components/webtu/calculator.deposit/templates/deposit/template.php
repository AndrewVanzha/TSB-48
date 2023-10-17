<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<script src='/local/templates/.default/js/vendor/pdfmake.min.js'></script>
<script src='/local/templates/.default/js/vendor/vfs_fonts.js'></script>
<form action="" class="page-section">

    <div class="clearfix">

        <div class="deposit-calc-block-1 clearfix">

            <?foreach($arResult['SETTINGS']['ATT_CURRENTY'] as $arCurrenty){?>
                <label class="check-box currency">
                    <input data-currency="<?=$arCurrenty['VALUE']?>" type="radio" name="testName7" <?if ($arCurrenty['VALUE'] == 'Руб.'){?>checked<?}?>>
                    <span class="check-box_caption">
                        <?=$arCurrenty['DESCRIPTION']?>
                    </span>
                </label>
            <?}?>

        </div>

        <div class="deposit-calc-block-2 clearfix">

            <?foreach ($arResult['SETTINGS']['PROPERTIES'] as $arProp){?>

                <label class="check-box prop">

                    <input data-prop="<?=$arProp['VALUE']?>" type="checkbox" name="">

                    <span class="check-box_caption">

                        <?=$arProp['VALUE']?>

                        <span class="tooltip">

                            <a href="#" class="tooltip_icon mi--help-o mi"></a>

                            <span class="tooltip_text">

                                <a href="#" class="tooltip_close mi--close-2 mi"></a>

                                <?=$arProp['DESCRIPTION']?>

                            </span>

                        </span>

                    </span>

                </label>

            <?}?>

        </div>

    </div>

    <div class="calc-range-block calc-range-block_rub">

        <div class="calc-range-block_heading clearfix">

            <h3 class="page-title--3 page-title">
                Сумма вклада
            </h3>

            <div class="value clearfix">
                <input id="summ" type="text" name="" data-steps="<?=$arResult['SETTINGS']['STEPS_SUMM']?>" data-increment="1" value="<?=$arResult['SETTINGS']['DEFAULT_SUMM']?>" class="input-field">
                <span class="currency-text"></span>
            </div>

        </div>

        <div class="calc-range-block_slider"></div>

        <ul class="calc-range-block_steps clearfix"></ul>

    </div>

    <div class="calc-range-block calc-range-block_cur" style="display: none;">

        <div class="calc-range-block_heading clearfix">

            <h3 class="page-title--3 page-title">
                Сумма вклада
            </h3>

            <div class="value clearfix">
                <input id="summ_cur" type="text" name="" data-steps="<?=$arResult['SETTINGS']['STEPS_SUMM_CUR']?>"  data-increment="1" value="<?=$arResult['SETTINGS']['DEFAULT_SUMM_CUR']?>" class="input-field">
                <span class="currency-text"></span>
            </div>

        </div>

        <div class="calc-range-block_slider"></div>

        <ul class="calc-range-block_steps clearfix"></ul>

    </div>

    <div class="calc-range-block">

        <div class="calc-range-block_heading clearfix">

            <h3 class="page-title--3 page-title">
                Срок вклада
            </h3>

            <div class="value clearfix">
                <input id="date" type="number" name="" data-steps="<?=$arResult['SETTINGS']['STEPS_DATE']?>" data-increment="1" data-set_value="Y" value="<?=$arResult['SETTINGS']['DEFAULT_DATE']?>" class="input-field">
                Мес.
            </div>

        </div>

        <div class="calc-range-block_slider"></div>

        <ul class="calc-range-block_steps clearfix"></ul>

    </div>

</form>

<div id="list">

</div>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "safes_reply",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("", ""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "144",
        "IBLOCK_TYPE" => "private_clients",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "4",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("FILE", ""),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>
