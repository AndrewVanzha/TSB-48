<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$elPos = $index + 1;
	if ($arResult[$index]["TITLE"]!='Вклады' && $arResult[$index]["TITLE"]!='Инвестиции') {

		$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

		if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
		{
			$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="'.$arResult[$index]["LINK"].'" title="'.$title.'"><span itemprop="name">'.$title.'</span></a>
				<meta itemprop="position" content="' . $elPos . '" /></li>';
		}
		else
		{
			$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.$title.'</span><meta itemprop="position" content="' . $elPos . '" /></li>';
		}

	}

}

$strReturn .= '</ul>';
return $strReturn;
