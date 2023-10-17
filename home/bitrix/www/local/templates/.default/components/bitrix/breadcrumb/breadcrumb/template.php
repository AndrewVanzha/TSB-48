<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;
global $USER;

//delayed function must return a string
if(empty($arResult))
    return "";

$strReturn = '';

$strReturn .= '<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs clearfix">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    if ( !$USER->IsAuthorized() && $arResult[$index]["LINK"] == "/personal/") continue;
    $position = $index+1;
    if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
    {
        $strReturn .= '
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="'.$arResult[$index]["LINK"].'" title="'.$title.'">
				    <span itemprop="name">'.$title.'</span>
				</a>
				<meta itemprop="position" content="'.$position.'" />
			</li>';
    }
    else
    {
        $strReturn .= '
			<li  itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			    <span itemprop="name">'.$title.'</span>
			    <meta itemprop="position" content="'.$position.'" />
			</li>';
    }
}

$strReturn .= '</ul>';

return $strReturn;

