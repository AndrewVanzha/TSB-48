<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

if (empty($arResult["ALL_ITEMS"]))
	return;
?>
<ul class="v21-nav__list v21-nav__list--outer">
	<? foreach ($arResult["MENU_STRUCTURE"] as $itemID => $arColumns) : ?>
		<!-- first level-->
		<li class="v21-nav__top-item">
			<? if (is_array($arColumns) && count($arColumns) > 0) : ?>
				<a href="#navMid<?= $itemID ?>" class="v21-nav__top-link v21-nav__link js-v21-dropdown-toggle">
					<span><?= $arResult["ALL_ITEMS"][$itemID]["TEXT"] ?></span>
					<svg width="7" height="4" class="v21-nav__link-icon">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#chevron"></use>
					</svg>
				</a>
				<? foreach ($arColumns as $key => $arRow) : ?>
					<ul id="navMid<?= $itemID ?>" class="v21-nav__list v21-nav__list--inner">
						<? foreach ($arRow as $itemIdLevel_2 => $arLevel_3) : ?>
							<!-- second level-->
							<li class="v21-nav__mid-item">
								<? if (is_array($arLevel_3) && count($arLevel_3) > 0) : ?>
									<a href="#navBot<?= $itemID . $itemIdLevel_2 ?>" class="v21-nav__mid-link v21-nav__link js-v21-dropdown-toggle">
										<span><?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"] ?></span>
										<svg width="7" height="4" class="v21-nav__link-icon">
											<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#chevron"></use>
										</svg>
									</a>
									<ul id="navBot<?= $itemID . $itemIdLevel_2 ?>" class="v21-nav__list v21-nav__list--inner">
										<? foreach ($arLevel_3 as $itemIdLevel_3) : ?>
											<!-- third level-->
											<li class="v21-nav__bot-item">
												<a href="<?= $arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"] ?>" class="v21-nav__bot-link v21-nav__link"><?= $arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"] ?></a>
											</li>
										<? endforeach; ?>
									</ul>
								<? else : ?>
									<a href="<?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"] ?>" class="v21-nav__mid-link v21-nav__link"><?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"] ?></a>
								<? endif ?>
							</li>
						<? endforeach; ?>
					</ul>
				<? endforeach; ?>
			<? else : ?>
				<a href="<?= $arResult["ALL_ITEMS"][$itemID]["LINK"] ?>" class="v21-nav__top-link v21-nav__link"><?= $arResult["ALL_ITEMS"][$itemID]["TEXT"] ?></a>
			<? endif ?>
		</li>
	<? endforeach; ?>
</ul>