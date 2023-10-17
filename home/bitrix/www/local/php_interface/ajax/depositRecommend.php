<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
function multiexplode ($delimiters, $string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

if($_REQUEST['CURRENCY'] == 'Руб.') $cur = 'RUB';
if($_REQUEST['CURRENCY'] == '$') $cur = 'USD';
if($_REQUEST['CURRENCY'] == '€') $cur = 'EUR';

$elements = array();
$sum = $_REQUEST['SUM'];
$date = $_REQUEST['DATE'];

$rsDeposits = CIBlockElement::GetList(
    array(),
    array('IBLOCK_ID'=>'47'),
    false,
    false,
    array('ID', 'PROPERTY_INTEREST_RATES')
);

while ($arDeposits = $rsDeposits->Fetch()) {
	if ( !empty($arDeposits['PROPERTY_INTEREST_RATES_VALUE']) ) {
		$rsTerms = CIBlockElement::GetList(
		    array(),
		    array('SECTION_ID'=>$arDeposits['PROPERTY_INTEREST_RATES_VALUE']),
		    false,
		    false,
		    array('NAME')
		);
		$maxTerm = 0;
		while ($arrayTerms = $rsTerms->Fetch()) {
			$interval = preg_replace("/[^0-9-–]/", "", $arrayTerms['NAME']);
            if (strstr($interval, '-') || strstr($interval, '–')) {
            	$interval = multiexplode(array("-","–"), $interval);
            	if (intval($interval[1]) > $maxTerm) $maxTerm = intval($interval[1]);
            }
		}
		$rsTerms = CIBlockElement::GetList(
		    array(),
		    array('SECTION_ID'=>$arDeposits['PROPERTY_INTEREST_RATES_VALUE']),
		    false,
		    false,
		    array('ID', 'NAME', 'IBLOCK_ID', 'PROPERTY_*')
		);
		while ($arTerms = $rsTerms->GetNextElement()) {
            $term = preg_replace("/[^0-9-–]/", "", $arTerms->GetFields()['NAME']);
            if (strstr($term, '-') || strstr($term, '–')) {
            	$term =  multiexplode(array("-","–"), $term);
            	if (intval($term[1]) == $maxTerm) {
            		$subtrahend = 0;
            	} else {
            		$subtrahend = 1;
            	}
            }
            if (
            	(is_string($term) && round($term/30) == $date) ||
        		(is_array($term) && $date >= round($term[0]/30) && $date <= round(intval($term[1])/30) - $subtrahend)
        	) {
            	$intervals = $arTerms->GetProperties()[$cur]['VALUE'];
            	if (!empty($intervals)) {
	            	$firstInterval = multiexplode(array("-","–"), $intervals[0]);
	            	$lastInterval = multiexplode(array("-","–"), $intervals[count($intervals)-1]);
	            	$minVal = floatval(str_replace(',', '.', preg_replace("/[^0-9,.]/", "", $firstInterval[0])));
	            	if ( !empty($lastInterval[1]) ) {
	            		$maxVal = floatval(str_replace(',', '.', preg_replace("/[^0-9,.]/", "", $lastInterval[1])));
	            	} else {
	            		$maxVal = INF;
	            	}
	            	if ($sum > $minVal && $sum < $maxVal) {
	            		$elements[] = $arDeposits['ID'];
	            		foreach ($intervals as $key => $interval) {
	            			$interval = multiexplode(array("-","–"), $interval);
                            $min = floatval(str_replace(',', '.', preg_replace("/[^0-9,.]/", "", $interval[0])));
                            $max = floatval(str_replace(',', '.', preg_replace("/[^0-9,.]/", "", $interval[1])));
                            if ($sum >= $min) {
                                if ($sum <= $max || empty($max)) {
                                    $rate = str_replace(',', '.', $arTerms->GetProperties()[$cur]['DESCRIPTION'][$key]);
                                    break;
                                }
                            }
                            unset($min);
                            unset($max);
	            		}
	            		$GLOBALS['RATES'][$arDeposits['ID']] = $rate;
	            	}
	            }
            }
        }
	}
}

if (!empty($elements)) {
	$GLOBALS['arrFilter']['ID'] = $elements;
	if(in_array('Частичное снятие', $_REQUEST['PROPERTIES'])) $GLOBALS['arrFilter']["PROPERTY_ATT_PARTIAL_VALUE"]='Да';
	if(in_array('Выплата процентов', $_REQUEST['PROPERTIES'])) $GLOBALS['arrFilter']["PROPERTY_ATT_PERCENT_VALUE"]='Да';
	if(in_array('Капитализация', $_REQUEST['PROPERTIES'])) $GLOBALS['arrFilter']["PROPERTY_ATT_CAPITAL_VALUE"]='Да';
	if(in_array('Пополнение', $_REQUEST['PROPERTIES'])) $GLOBALS['arrFilter']["PROPERTY_ATT_REFILL_VALUE"]='Да';
} else {
	$GLOBALS['arrFilter']['ID'] = 0;
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"deposit_recommend",
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
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/chastnym-klientam/vklady-i-investitsii/vklady/#ELEMENT_CODE#/",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("", ""),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "47",
		"IBLOCK_TYPE" => "private_clients",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
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
		"PROPERTY_CODE" => array("MIN_SUMM", "MAX_SUM", "MAX_DATE", "RECOMMEND", "ATT_RECOMMENDED", "INTEREST_RATE", ""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
