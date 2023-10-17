<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои мнения");

global $USER;
if (!$USER->IsAuthorized()) {
    LocalRedirect('/login/');
}
?><?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"personal_menu",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "personal_menu",
		"COMPONENT_TEMPLATE" => "personal_menu",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "personal_menu",
		"USE_EXT" => "N"
	)
);?>
<!-- FILTER -->
<?
$arSorts = array(
    "date-asc"                  => "По дате (возр.)",
    "date-desc"                 => "По дате (убыв.)",
);

$sort = array_key_exists( $_REQUEST["sort"], $arSorts ) ? $_REQUEST["sort"] : "date-desc";
$sort_masiv = explode("-", $sort);

$arParams["SORTS"] = array();


if(count($arSorts) > 0) {
    foreach($arSorts as $key => $value){
        $sort_variant = array(
            "CODE"   => $key,
            "NAME"   => $value,
            "LABEL"  => $value,
            "ACTIVE" => $key == $sort_masiv[0].'-'.$sort_masiv[1] ? "Y" : "N"
        );
        $sort_variant["LINK"] = $APPLICATION->GetCurPageParam(
            "sort=".$key,array("sort")
        );

        $arParams["SORTS"][] = $sort_variant;
    }
}
?>
<div class="filter-wrap">
	<div class="block">
		<div class="select-default aligner">
		    <? if(count($arParams["SORTS"]) > 0) { ?>
		            <select name="sort-product" id="sort-reviews">
		                <? foreach ($arParams["SORTS"] as $key => $sort) {
		                    if ($sort["ACTIVE"] == 'Y') $selected = " selected";
		                    else $selected = "";
		                    ?>
		                    <option value="<?=$sort["LINK"]?>" <?=$selected?>><?=$sort["LABEL"]?></option>
		                <? } ?>
		            </select>
		        <script>
		            $( "#sort-reviews" ).change(function() {
		                window.location = $(this).val();
		            });
		        </script>
		    <? } ?>
		</div>
	</div>
</div>

<?$GLOBALS["filterUser"] = array('PROPERTY_USER_ID' => $USER->GetID());?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"good_reviews", 
	array(
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
		"COMPONENT_TEMPLATE" => "good_reviews",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "filterUser",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "feedback_form",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "USER_ID",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => !empty($sort_masiv[0]) ? $sort_masiv[0] : "ACTIVE_FROM",
        "SORT_ORDER1" => count($sort_masiv)>1 ? $sort_masiv[1] : "desc",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>