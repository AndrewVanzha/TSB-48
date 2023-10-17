<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<ul class="v21-breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
	$elPos = $index + 1;
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
		$strReturn .= '<li class="v21-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a itemprop="item" href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" class="v21-link">
									<span itemprop="name" class="v21-link__text v21-link__text--inv">' . $title . '</span>
									<meta itemprop="position" content="' . $elPos . '">
								</a>
							</li>';
	} else {
		$strReturn .= '<li class="v21-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<span title="' . $title . '" itemprop="item">
									<span itemprop="name">' . $title . '</span>
									<meta itemprop="position" content="' . $elPos . '" />
								</span>
							</li>';
	}
}

$strReturn .= '</ul>';
return $strReturn;
