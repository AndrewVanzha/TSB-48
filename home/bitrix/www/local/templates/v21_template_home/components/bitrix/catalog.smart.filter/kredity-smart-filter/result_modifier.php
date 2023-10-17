<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
			$theme = COption::GetOptionString("main", "wizard_".$templateId."_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

if(isset($arResult["ITEMS"][242])) {
    $arResult["ITEMS"][242]['DISPLAY_SIGNAL'] = '<span>RUB</span>';
}
if(isset($arResult["ITEMS"][243])) { // calendar_icon
    $arResult["ITEMS"][243]['DISPLAY_SIGNAL'] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.12109 0.173218C5.21094 0.0671387 5.34766 0 5.5 0C5.77734 0 6 0.223877 6 0.5V3H14V0.5C14 0.223877 14.2227 0 14.5 0C14.7773 0 15 0.223877 15 0.5V3H19.5898C19.6445 3.00012 19.6992 3.01111 19.75 3.0321C19.7969 3.05322 19.8438 3.08411 19.8828 3.1228C19.9219 3.16162 19.9492 3.20752 19.9688 3.25806C19.9922 3.30847 20 3.36255 20 3.41687V19.5831C20 19.6375 19.9922 19.6915 19.9688 19.7419C19.9492 19.7925 19.9219 19.8384 19.8828 19.8772C19.8438 19.916 19.7969 19.9468 19.75 19.9679C19.6992 19.989 19.6445 19.9999 19.5898 20H0.410156C0.300781 19.9982 0.195312 19.9534 0.121094 19.8755C0.0429688 19.7975 0 19.6925 0 19.5831V3.41687C0 3.30762 0.0429688 3.20276 0.121094 3.12488C0.164062 3.08105 0.214844 3.04773 0.273438 3.02649C0.316406 3.01001 0.363281 3.00085 0.410156 3H5V0.5C5 0.375122 5.04688 0.260864 5.12109 0.173218ZM14 4V5.5C14 5.77612 14.2227 6 14.5 6C14.7773 6 15 5.77612 15 5.5V4H19V8H1V4H5V5.5C5 5.66516 5.07812 5.81165 5.20312 5.90271C5.28516 5.96387 5.38672 6 5.5 6C5.61719 6 5.72266 5.96069 5.80859 5.89453C5.92578 5.80298 6 5.66028 6 5.5V4H14ZM1 19H19V9H1V19Z" fill="#A58A57"/>
</svg>';
}

//debugg($arResult);
