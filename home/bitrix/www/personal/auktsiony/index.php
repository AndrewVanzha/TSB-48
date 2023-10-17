<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Аукцион");
global $USER;

if (!$USER->IsAuthorized()) {
    LocalRedirect('/login/');
}
?>
<?
#Получаем количество активных элементов в инфоблоке
$sect = CIBlockSection::GetList(Array("sort" => "asc", "name" => "asc"), Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "GLOBAL_ACTIVE" => "Y", "CNT_ACTIVE" => true), true, array("NAME"));

while($el = $sect->Fetch()) {
    $count += $el["ELEMENT_CNT"];
}

$price_sort_desc = 'catalog_PRICE_1-desc';
$price_sort_asc = 'catalog_PRICE_1-asc';

#варианты сортировки
$arSorts = array(
    "shows-desc"                => "По популярности",
    $price_sort_desc            => "По цене (дороже)",
    $price_sort_asc             => "По цене (дешевле)",
    "name-asc"                  => "По названию (возр.)",
    "name-desc"                 => "По названию (убыв.)",
);

$sort = array_key_exists( $_REQUEST["sort"], $arSorts ) ? $_REQUEST["sort"] : "shows-desc";
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

$GLOBALS["arrFilter"] = array("=PROPERTY_USER_ID" => $USER->GetID());

?>

<?$APPLICATION->IncludeComponent(
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
<div class="filter-wrap">
	<div class="block clearfix">
		<div class="controls-wrap clearfix">
		    <? if(count($arParams["SORTS"]) > 0) { ?>
		        <div class="size size-1">
		            <select name="sort-product" id="sort-product">
		                <? foreach ($arParams["SORTS"] as $key => $sort) {
		                    if ($sort["ACTIVE"] == 'Y') $selected = " selected";
		                    else $selected = "";
		                    ?>
		                    <option value="<?=$sort["LINK"]?>" <?=$selected?>><?=$sort["LABEL"]?></option>
		                <? } ?>
		            </select>
		        </div>
		        <script>
		            $( "#sort-product" ).change(function() {
		                window.location = $(this).val();
		            });
		        </script>
		    <? } ?>
		    <div class="controls-view-wrap">
		        <div class="controls-view list <?= ( ($_COOKIE['view'] == "list") ? 'active' : '')?>"></div>
		        <div class="controls-view table <?= ( ($_COOKIE['view'] == "table" || empty($_COOKIE['view'])) ? 'active' : '')?>"></div>
		    </div>
		</div>
		<? /*--- Форма добавления аукциона ---*/ ?> <?$APPLICATION->IncludeComponent(
			"webtu:auction.add.lot",
			"",
			Array(
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"USE_CAPTCHA" => "Y"
			)
		);?>
	</div>
	<div class="filter-btn-wrap on-personal">

		<?
		if(CModule::IncludeModule('iblock')){
			global $DB;

			$elementFilter = array('IBLOCK_ID' => 16, 'PROPERTY_USER_ID' => $USER->GetID());
			$elements_pre = CIBlockElement::GetList(array(), $elementFilter);
			$elements = array();
			while ($element = $elements_pre->GetNext()) {
				$elements[] = $element;
			}

			$elements2_pre = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 16), false, false, array(
				"ID",
				"NAME",
				"IBLOCK_SECTION_ID",
			));
			$elements2 = array();
			while ($element = $elements2_pre->GetNext()) {
				$element['BETS'] = array();
				$elements2[$element['ID']] = $element;
			}

			$bets_pre = $DB->query("SELECT * FROM b_iblock_element_property WHERE IBLOCK_PROPERTY_ID = 129;");

			while ($bet = $bets_pre->Fetch()) {
				if (!is_null($bet['VALUE'])) {
					$bet['VALUE'] = json_decode($bet['VALUE'], true);
					if ($bet['VALUE']['USER_ID'] == $USER->GetID()) {
						$elements2[$bet['IBLOCK_ELEMENT_ID']]['BETS'][] = $bet;
					}
				}
			}

			$bets = array();

			foreach ($elements2 as $key => $element) {
				if (!empty($element['BETS'])) {
					$bets[$key] = $element;
				}
			}
			
		   	$arSelect = Array('ID', 'NAME', 'CODE');
		   	$arFilter = Array('IBLOCK_ID'=>16);
		   	$res = CIBlockSection::GetList(Array('SORT'=>'ASC', ), $arFilter, true, $arSelect);
		   	$sections = array();
		   	while($section = $res->GetNext())
		   	{
		   		$section['ELEMENTS_OWNER'] = array();
		      	foreach ($elements as $element) {
		      		if ($element['IBLOCK_SECTION_ID'] == $section['ID']) {
		      			$section['ELEMENTS_OWNER'][] = $element;
		      		}
		      	}

		      	$section['ELEMENTS_BETS'] = array();
		      	foreach ($bets as $element) {
		      		if ($element['IBLOCK_SECTION_ID'] == $section['ID']) {
		      			$section['ELEMENTS_BETS'][] = $element;
		      		}
		      	}

		      	$sections[] = $section;
		   	}

		 	$subscribes_pre = $DB->query("SELECT * FROM b_iblock_element_property WHERE IBLOCK_PROPERTY_ID = 133;");
			$arrEmailSubscribe = array();

			while ($subscribes = $subscribes_pre->Fetch()) 
			{
				$arrEmailSubscribe[] = $subscribes['VALUE'];
			}
			$rsUser = CUser::GetByID($USER->GetID());
			$arUser = $rsUser->Fetch();
			$CntSubscb = array();

			$arrEmailSubscribe =array_count_values($arrEmailSubscribe); 
			foreach($arrEmailSubscribe as $key => $value) {
				if($key == $arUser['EMAIL'])
					$CntSubscb[] = $value; 
			}
		}
		?>
		<div class="filter-btn filter-btn-2 aligner" id="tabs">
			<a data-tab="tab-1" href="#">Я участвую (<?=count($sections[0]['ELEMENTS_BETS']);?>)</a>
			<a data-tab="tab-2" href="#">Планирую участвовать (<? if (empty($CntSubscb)){ echo "0"; } else { echo $CntSubscb[0];}?> )</a>
			<a data-tab="tab-3" href="#">Я участвовал (<?=count($sections[2]['ELEMENTS_BETS']);?>)</a>
			<?$j=4;?>
			<? foreach ($sections as $section) { ?>
				<a data-tab="tab-<?=$j?>" href="#">Мои <?=$section['NAME']?> (<?=count($section['ELEMENTS_OWNER']);?>)</a>
				<?$j++;?>
			<? } ?>
		</div>
	</div>
</div>
<?
$filterID = array();
foreach ($sections[2]['ELEMENTS_BETS'] as $element) {
	$filterID[] = $element['ID'];
}
//var_dump($filterID);
?>
<?$GLOBALS["arrBetsActive"] = array("SECTION_ID"=>"23", "ID"=>$filterID);?>

<div class="tab-content" id="tab-1">
	<?if(!empty($filterID)) {?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"auction_personal",
			Array(
				"ACTION_VARIABLE" => "action",
				"ADD_PICT_PROP" => "-",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "ADD",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"BASKET_URL" => "/personal/cart",
				"BROWSER_TITLE" => "-",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPATIBLE_MODE" => "Y",
				"COMPONENT_TEMPLATE" => "auction_personal",
				"CONVERT_CURRENCY" => "N",
				"CUSTOM_FILTER" => "",
				"DETAIL_URL" => "",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_COMPARE" => "N",
				"DISPLAY_TOP_PAGER" => "N",
		        "ELEMENT_SORT_FIELD" => !empty($sort_masiv[0]) ? $sort_masiv[0] : "shows",
		        "ELEMENT_SORT_ORDER" => count($sort_masiv)>1 ? $sort_masiv[1] : "desc",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER2" => "desc",
				"ENLARGE_PRODUCT" => "STRICT",
				"FILTER_NAME" => "arrBetsActive",
				"HIDE_NOT_AVAILABLE" => "N",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",
				"IBLOCK_ID" => "16",
				"IBLOCK_TYPE" => "catalog",
				"INCLUDE_SUBSECTIONS" => "Y",
				"LABEL_PROP" => array(),
				"LAZY_LOAD" => "N",
				"LINE_ELEMENT_COUNT" => "3",
				"LOAD_ON_SCROLL" => "N",
				"MESSAGE_404" => "",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_BTN_SUBSCRIBE" => "Подписаться",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"META_DESCRIPTION" => "-",
				"META_KEYWORDS" => "-",
				"OFFERS_LIMIT" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Товары",
				"PAGE_ELEMENT_COUNT" => "18",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRICE_CODE" => array(0=>"BASE",),
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_PROPERTIES" => array(),
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
				"PRODUCT_SUBSCRIPTION" => "Y",
				"PROPERTY_CODE" => array(0=>"METAL",1=>"PROBA",2=>"RELEASE_YEAR",3=>"SERIES",4=>"WEIGHT",),
				"PROPERTY_CODE_MOBILE" => array(),
				"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
				"RCM_TYPE" => "personal",
				"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
				"SECTION_CODE_PATH" => "",
				"SECTION_ID" => $_REQUEST["SECTION_ID"],
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
				"SEF_MODE" => "Y",
				"SEF_RULE" => "#SECTION_CODE#",
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "Y",
				"SHOW_404" => "N",
				"SHOW_ALL_WO_SECTION" => "Y",
				"SHOW_CLOSE_POPUP" => "N",
				"SHOW_DISCOUNT_PERCENT" => "N",
				"SHOW_FROM_SECTION" => "N",
				"SHOW_MAX_QUANTITY" => "N",
				"SHOW_OLD_PRICE" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"SHOW_SLIDER" => "Y",
				"SLIDER_INTERVAL" => "3000",
				"SLIDER_PROGRESS" => "N",
				"TEMPLATE_THEME" => "blue",
				"USE_ENHANCED_ECOMMERCE" => "N",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"USE_PRICE_COUNT" => "N",
				"USE_PRODUCT_QUANTITY" => "N"
			)
		);?>
	<?}?>
</div>

<?$GLOBALS["arrBetsPlan"] = array("SECTION_ID"=>"24", "PROPERTY_SUBSRIBE_LOT"=>$arUser['EMAIL']);?>
<div class="tab-content" id="tab-2">
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"auction_personal",
		Array(
			"ACTION_VARIABLE" => "action",
			"ADD_PICT_PROP" => "-",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BACKGROUND_IMAGE" => "-",
			"BASKET_URL" => "/personal/cart",
			"BROWSER_TITLE" => "-",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPATIBLE_MODE" => "Y",
			"COMPONENT_TEMPLATE" => "auction_personal",
			"CONVERT_CURRENCY" => "N",
			"CUSTOM_FILTER" => "",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_COMPARE" => "N",
			"DISPLAY_TOP_PAGER" => "N",
	        "ELEMENT_SORT_FIELD" => !empty($sort_masiv[0]) ? $sort_masiv[0] : "shows",
	        "ELEMENT_SORT_ORDER" => count($sort_masiv)>1 ? $sort_masiv[1] : "desc",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER2" => "desc",
			"ENLARGE_PRODUCT" => "STRICT",
			"FILTER_NAME" => "arrBetsPlan",
			"HIDE_NOT_AVAILABLE" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "16",
			"IBLOCK_TYPE" => "catalog",
			"INCLUDE_SUBSECTIONS" => "Y",
			"LABEL_PROP" => array(),
			"LAZY_LOAD" => "N",
			"LINE_ELEMENT_COUNT" => "3",
			"LOAD_ON_SCROLL" => "N",
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_BTN_SUBSCRIBE" => "Подписаться",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"OFFERS_LIMIT" => "5",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "18",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(0=>"BASE",),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
			"PRODUCT_SUBSCRIPTION" => "Y",
			"PROPERTY_CODE" => array(0=>"METAL",1=>"PROBA",2=>"RELEASE_YEAR",3=>"SERIES",4=>"WEIGHT",),
			"PROPERTY_CODE_MOBILE" => array(),
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
			"RCM_TYPE" => "personal",
			"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
			"SECTION_CODE_PATH" => "",
			"SECTION_ID" => $_REQUEST["SECTION_ID"],
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
			"SEF_MODE" => "Y",
			"SEF_RULE" => "#SECTION_CODE#",
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SHOW_ALL_WO_SECTION" => "Y",
			"SHOW_CLOSE_POPUP" => "N",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_FROM_SECTION" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SLIDER" => "Y",
			"SLIDER_INTERVAL" => "3000",
			"SLIDER_PROGRESS" => "N",
			"TEMPLATE_THEME" => "blue",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N"
		)
	);
	?>
</div>

<?$GLOBALS["arrBetsEnd"] = array("SECTION_ID"=>"25", "ID"=>$filterID);?>
<div class="tab-content" id="tab-3">
	<?if(!empty($filterID)) {?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"auction_personal",
			Array(
				"ACTION_VARIABLE" => "action",
				"ADD_PICT_PROP" => "-",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "ADD",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"BASKET_URL" => "/personal/cart",
				"BROWSER_TITLE" => "-",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPATIBLE_MODE" => "Y",
				"COMPONENT_TEMPLATE" => "auction_personal",
				"CONVERT_CURRENCY" => "N",
				"CUSTOM_FILTER" => "",
				"DETAIL_URL" => "",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_COMPARE" => "N",
				"DISPLAY_TOP_PAGER" => "N",
		        "ELEMENT_SORT_FIELD" => !empty($sort_masiv[0]) ? $sort_masiv[0] : "shows",
		        "ELEMENT_SORT_ORDER" => count($sort_masiv)>1 ? $sort_masiv[1] : "desc",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER2" => "desc",
				"ENLARGE_PRODUCT" => "STRICT",
				"FILTER_NAME" => "arrBetsEnd",
				"HIDE_NOT_AVAILABLE" => "N",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",
				"IBLOCK_ID" => "16",
				"IBLOCK_TYPE" => "catalog",
				"INCLUDE_SUBSECTIONS" => "Y",
				"LABEL_PROP" => array(),
				"LAZY_LOAD" => "N",
				"LINE_ELEMENT_COUNT" => "3",
				"LOAD_ON_SCROLL" => "N",
				"MESSAGE_404" => "",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_BTN_SUBSCRIBE" => "Подписаться",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"META_DESCRIPTION" => "-",
				"META_KEYWORDS" => "-",
				"OFFERS_LIMIT" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Товары",
				"PAGE_ELEMENT_COUNT" => "18",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRICE_CODE" => array(0=>"BASE",),
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_PROPERTIES" => array(),
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
				"PRODUCT_SUBSCRIPTION" => "Y",
				"PROPERTY_CODE" => array(0=>"METAL",1=>"PROBA",2=>"RELEASE_YEAR",3=>"SERIES",4=>"WEIGHT",),
				"PROPERTY_CODE_MOBILE" => array(),
				"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
				"RCM_TYPE" => "personal",
				"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
				"SECTION_CODE_PATH" => "",
				"SECTION_ID" => $_REQUEST["SECTION_ID"],
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
				"SEF_MODE" => "Y",
				"SEF_RULE" => "#SECTION_CODE#",
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "Y",
				"SHOW_404" => "N",
				"SHOW_ALL_WO_SECTION" => "Y",
				"SHOW_CLOSE_POPUP" => "N",
				"SHOW_DISCOUNT_PERCENT" => "N",
				"SHOW_FROM_SECTION" => "N",
				"SHOW_MAX_QUANTITY" => "N",
				"SHOW_OLD_PRICE" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"SHOW_SLIDER" => "Y",
				"SLIDER_INTERVAL" => "3000",
				"SLIDER_PROGRESS" => "N",
				"TEMPLATE_THEME" => "blue",
				"USE_ENHANCED_ECOMMERCE" => "N",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"USE_PRICE_COUNT" => "N",
				"USE_PRODUCT_QUANTITY" => "N"
			)
		);?>
	<?}?>
</div>

<?$GLOBALS["arrMyActive"] = array("SECTION_ID"=>"23", "PROPERTY_USER_ID"=>$USER->GetID());?>
<div class="tab-content" id="tab-4">
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"auction_personal",
		Array(
			"ACTION_VARIABLE" => "action",
			"ADD_PICT_PROP" => "-",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BACKGROUND_IMAGE" => "-",
			"BASKET_URL" => "/personal/cart",
			"BROWSER_TITLE" => "-",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPATIBLE_MODE" => "Y",
			"COMPONENT_TEMPLATE" => "auction_personal",
			"CONVERT_CURRENCY" => "N",
			"CUSTOM_FILTER" => "",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_COMPARE" => "N",
			"DISPLAY_TOP_PAGER" => "N",
	        "ELEMENT_SORT_FIELD" => !empty($sort_masiv[0]) ? $sort_masiv[0] : "shows",
	        "ELEMENT_SORT_ORDER" => count($sort_masiv)>1 ? $sort_masiv[1] : "desc",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER2" => "desc",
			"ENLARGE_PRODUCT" => "STRICT",
			"FILTER_NAME" => "arrMyActive",
			"HIDE_NOT_AVAILABLE" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "16",
			"IBLOCK_TYPE" => "catalog",
			"INCLUDE_SUBSECTIONS" => "Y",
			"LABEL_PROP" => array(),
			"LAZY_LOAD" => "N",
			"LINE_ELEMENT_COUNT" => "3",
			"LOAD_ON_SCROLL" => "N",
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_BTN_SUBSCRIBE" => "Подписаться",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"OFFERS_LIMIT" => "5",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "18",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(0=>"BASE",),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
			"PRODUCT_SUBSCRIPTION" => "Y",
			"PROPERTY_CODE" => array(0=>"METAL",1=>"PROBA",2=>"RELEASE_YEAR",3=>"SERIES",4=>"WEIGHT",),
			"PROPERTY_CODE_MOBILE" => array(),
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
			"RCM_TYPE" => "personal",
			"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
			"SECTION_CODE_PATH" => "",
			"SECTION_ID" => "23",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
			"SEF_MODE" => "Y",
			"SEF_RULE" => "#SECTION_CODE#",
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SHOW_ALL_WO_SECTION" => "Y",
			"SHOW_CLOSE_POPUP" => "N",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_FROM_SECTION" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SLIDER" => "Y",
			"SLIDER_INTERVAL" => "3000",
			"SLIDER_PROGRESS" => "N",
			"TEMPLATE_THEME" => "blue",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N"
		)
	);?>
</div>
<?$GLOBALS["arrMyPlan"] = array("SECTION_ID"=>"24", "PROPERTY_USER_ID"=>$USER->GetID());?>
<div class="tab-content" id="tab-5">
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"auction_personal",
		Array(
			"ACTION_VARIABLE" => "action",
			"ADD_PICT_PROP" => "-",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BACKGROUND_IMAGE" => "-",
			"BASKET_URL" => "/personal/cart",
			"BROWSER_TITLE" => "-",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPATIBLE_MODE" => "Y",
			"COMPONENT_TEMPLATE" => "auction_personal",
			"CONVERT_CURRENCY" => "N",
			"CUSTOM_FILTER" => "",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_COMPARE" => "N",
			"DISPLAY_TOP_PAGER" => "N",
	        "ELEMENT_SORT_FIELD" => !empty($sort_masiv[0]) ? $sort_masiv[0] : "shows",
	        "ELEMENT_SORT_ORDER" => count($sort_masiv)>1 ? $sort_masiv[1] : "desc",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER2" => "desc",
			"ENLARGE_PRODUCT" => "STRICT",
			"FILTER_NAME" => "arrMyPlan",
			"HIDE_NOT_AVAILABLE" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "16",
			"IBLOCK_TYPE" => "catalog",
			"INCLUDE_SUBSECTIONS" => "Y",
			"LABEL_PROP" => array(),
			"LAZY_LOAD" => "N",
			"LINE_ELEMENT_COUNT" => "3",
			"LOAD_ON_SCROLL" => "N",
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_BTN_SUBSCRIBE" => "Подписаться",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"OFFERS_LIMIT" => "5",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "18",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(0=>"BASE",),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
			"PRODUCT_SUBSCRIPTION" => "Y",
			"PROPERTY_CODE" => array(0=>"METAL",1=>"PROBA",2=>"RELEASE_YEAR",3=>"SERIES",4=>"WEIGHT",),
			"PROPERTY_CODE_MOBILE" => array(),
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
			"RCM_TYPE" => "personal",
			"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
			"SECTION_CODE_PATH" => "",
			"SECTION_ID" => $_REQUEST["SECTION_ID"],
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
			"SEF_MODE" => "Y",
			"SEF_RULE" => "#SECTION_CODE#",
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SHOW_ALL_WO_SECTION" => "Y",
			"SHOW_CLOSE_POPUP" => "N",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_FROM_SECTION" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SLIDER" => "Y",
			"SLIDER_INTERVAL" => "3000",
			"SLIDER_PROGRESS" => "N",
			"TEMPLATE_THEME" => "blue",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N"
		)
	);?>
</div>
<?$GLOBALS["arrMyEnd"] = array("SECTION_ID"=>"25", "PROPERTY_USER_ID"=>$USER->GetID());?>
<div class="tab-content" id="tab-6">
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"auction_personal",
		Array(
			"ACTION_VARIABLE" => "action",
			"ADD_PICT_PROP" => "-",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BACKGROUND_IMAGE" => "-",
			"BASKET_URL" => "/personal/cart",
			"BROWSER_TITLE" => "-",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPATIBLE_MODE" => "Y",
			"COMPONENT_TEMPLATE" => "auction_personal",
			"CONVERT_CURRENCY" => "N",
			"CUSTOM_FILTER" => "",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_COMPARE" => "N",
			"DISPLAY_TOP_PAGER" => "N",
	        "ELEMENT_SORT_FIELD" => !empty($sort_masiv[0]) ? $sort_masiv[0] : "shows",
	        "ELEMENT_SORT_ORDER" => count($sort_masiv)>1 ? $sort_masiv[1] : "desc",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER2" => "desc",
			"ENLARGE_PRODUCT" => "STRICT",
			"FILTER_NAME" => "arrMyEnd",
			"HIDE_NOT_AVAILABLE" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "16",
			"IBLOCK_TYPE" => "catalog",
			"INCLUDE_SUBSECTIONS" => "Y",
			"LABEL_PROP" => array(),
			"LAZY_LOAD" => "N",
			"LINE_ELEMENT_COUNT" => "3",
			"LOAD_ON_SCROLL" => "N",
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_BTN_SUBSCRIBE" => "Подписаться",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"OFFERS_LIMIT" => "5",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "18",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(0=>"BASE",),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
			"PRODUCT_SUBSCRIPTION" => "Y",
			"PROPERTY_CODE" => array(0=>"METAL",1=>"PROBA",2=>"RELEASE_YEAR",3=>"SERIES",4=>"WEIGHT",),
			"PROPERTY_CODE_MOBILE" => array(),
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
			"RCM_TYPE" => "personal",
			"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
			"SECTION_CODE_PATH" => "",
			"SECTION_ID" => "25",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
			"SEF_MODE" => "Y",
			"SEF_RULE" => "#SECTION_CODE#",
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SHOW_ALL_WO_SECTION" => "Y",
			"SHOW_CLOSE_POPUP" => "N",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_FROM_SECTION" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SLIDER" => "Y",
			"SLIDER_INTERVAL" => "3000",
			"SLIDER_PROGRESS" => "N",
			"TEMPLATE_THEME" => "blue",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N"
		)
	);?>
</div>


<script>
	$('#tabs a').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('#tabs a').removeClass('is-active');
		$('.tab-content').removeClass('current');

		$(this).addClass('is-active');
		$("#"+tab_id).addClass('current');
	})
</script>
<style>

	.tab-content{
		display: none;
	}
	.tab-content.current{
		display: inherit;
	}
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>