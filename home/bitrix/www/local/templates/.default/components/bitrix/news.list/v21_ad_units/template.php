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

if (count($arResult["ITEMS"]) > 0) {
	$counter = 1;
?>
	<? foreach ($arResult["ITEMS"] as $arItem) : ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?
		if ($counter === 2 && $arResult["FREE_TOP_UP"]){
			echo $arResult["FREE_TOP_UP"];
		}
		?>
		<div class="v21-plastic-service--<?= $counter ?> v21-plastic-service" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
			<?
			if ($arItem["DISPLAY_PROPERTIES"]["IMAGE_LOCATION"]["VALUE_XML_ID"] === "left") { ?>
				<div class="v21-plastic-service__image">
					<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>">
				</div><!-- /.v21-plastic-service__image -->
			<? } ?>
			<div class="v21-plastic-service__text">
				<h2 class="v21-h3"><?= html_entity_decode($arItem["DISPLAY_PROPERTIES"]["TITLE"]["VALUE"]) ?? $arItem["NAME"] ?></h2>
				<? if ($arItem["PREVIEW_TEXT"]) { ?>
					<div class="v21-plastic-service__brief">
						<?= $arItem["PREVIEW_TEXT"] ?>
					</div>
				<? } ?>

				<ul class="v21-plastic-service__links v21-socials">
					<? foreach ($arItem["DISPLAY_PROPERTIES"]["LINKS"]["VALUE"] as $key => $link) { ?>
						<li class="v21-plastic-service__links-item v21-socials__item">
							<a href="<?= $link ?>" target="_blank" class="v21-socials__link">
								<? if ($arItem["DISPLAY_PROPERTIES"]["ICONS_LINKS"]["VALUE"][$key]) { ?>
                                    <? if ($arItem["DISPLAY_PROPERTIES"]["ICONS_LINKS"]["VALUE"][$key] != 'MIRPay') : ?>
    									<svg width="<?= $arItem["DISPLAY_PROPERTIES"]["ICONS_SIZE"]["VALUE"][$key] ?>" height="<?= $arItem["DISPLAY_PROPERTIES"]["ICONS_SIZE"]["DESCRIPTION"][$key] ?>" class="v21-socials__icon">
	    									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#<?= trim($arItem["DISPLAY_PROPERTIES"]["ICONS_LINKS"]["VALUE"][$key]) ?>"></use>
		    							</svg>
                                    <? else: ?>
                                        <svg width="<?= $arItem["DISPLAY_PROPERTIES"]["ICONS_SIZE"]["VALUE"][$key] ?>" height="<?= $arItem["DISPLAY_PROPERTIES"]["ICONS_SIZE"]["DESCRIPTION"][$key] ?>" class="v21-socials__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 398.28 188.51">
                                            <defs><style>.d{fill:#fff;}.e{fill:#2b664a;}</style></defs>
                                            <g id="a"/>
                                            <g id="b">
                                                <g id="c">
                                                    <g>
                                                        <path class="e" d="M234.79,121.19h11.97c7.26,0,12.25,3.72,12.25,10.08v.1c0,6.93-5.98,10.51-12.86,10.51h-8.91v12.3h-2.45v-32.98Zm11.5,18.42c6.12,0,10.27-3.2,10.27-8.1v-.09c0-5.23-4.05-7.97-9.99-7.97h-9.33v16.16h9.05Z"/><path class="e" d="M262.03,147.19v-.09c0-4.99,4.29-7.82,10.51-7.82,3.34,0,5.65,.42,7.96,1.04v-1.04c0-4.85-2.97-7.35-7.92-7.35-2.92,0-5.32,.8-7.54,1.93l-.85-2.03c2.64-1.23,5.23-2.07,8.53-2.07s5.84,.89,7.58,2.64c1.6,1.6,2.45,3.82,2.45,6.79v14.98h-2.26v-4c-1.65,2.31-4.62,4.57-9.19,4.57s-9.28-2.54-9.28-7.54m18.52-2.03v-2.73c-2.03-.52-4.71-1.09-8.15-1.09-5.08,0-7.91,2.26-7.91,5.61v.1c0,3.49,3.3,5.51,6.97,5.51,4.9,0,9.09-3.01,9.09-7.4"/><path class="e" d="M307.01,130.14h2.54l-10.41,24.87c-2.12,5.04-4.57,6.83-8.01,6.83-1.84,0-3.16-.33-4.76-1.04l.8-2.03c1.27,.61,2.31,.9,4.1,.9,2.5,0,4.15-1.46,5.94-5.65l-11.54-23.89h2.68l9.99,21.48,8.67-21.48Z"/><path class="e" d="M369.67,110.2l.76-.83c-15.23-13.97-35.49-22.57-57.79-22.57H134.33l.06,1.18c.34,6.5,1.28,12.82,2.71,18.95h0v.02c.34,1.33,.65,2.71,1.06,4.1l1.08-.32-1.08,.3c.15,.55,.3,1.1,.46,1.65h0v.02c13.85,43.94,54.9,75.8,103.42,75.8h154.65l.16-.93c.88-4.91,1.42-9.95,1.42-15.14,0-24.99-10.78-47.43-27.85-63.08l-.76,.83-.76,.83c16.63,15.25,27.12,37.08,27.12,61.42,0,5.03-.53,9.94-1.39,14.74l1.11,.2v-1.12H242.04c-47.51,0-87.71-31.21-101.27-74.23l-1.07,.33,1.08-.31c-.16-.53-.31-1.07-.46-1.61h0v-.02c-.38-1.28-.68-2.63-1.03-4.01l-1.09,.28,1.1-.26c-1.4-6.01-2.32-12.2-2.66-18.56l-1.12,.05v1.12h177.12c21.72,0,41.42,8.37,56.27,21.98l.76-.83Z"/><path class="e" d="M234.15,22.27C219.11,8.49,199.13,0,177.12,0H0C.34,6.43,1.27,12.68,2.68,18.76c.35,1.35,.65,2.72,1.04,4.05,.15,.55,.31,1.09,.46,1.63,13.7,43.49,54.33,75.02,102.34,75.02h153.71c.87-4.86,1.4-9.83,1.4-14.94,0-24.67-10.64-46.8-27.49-62.25"/><path class="d" d="M182.34,48.92h-33.09v17.21h10.49v-9.69h4.43l5.95,9.69h11.93l-7.01-10.5c3.37-1.2,6.04-3.64,7.3-6.71"/><path class="d" d="M178.95,36.38c-2.06-1.88-4.79-3.04-7.79-3.04h-22.57c.04,.88,.17,1.73,.37,2.56,.04,.19,.09,.37,.14,.55,.02,.08,.04,.15,.06,.22,1.87,5.94,7.43,10.25,13.99,10.25h19.37c.12-.67,.19-1.35,.19-2.04,0-3.37-1.45-6.4-3.76-8.51"/><path class="d" d="M113.91,37.65l-4.35,15.07h-.75l-4.35-15.07c-.74-2.55-3.07-4.31-5.73-4.31h-10.42v32.79h10.43v-19.38h.75l5.96,19.38h7.45l5.96-19.38h.75v19.38h10.43V33.34h-10.42c-2.66,0-4.99,1.76-5.73,4.31"/><rect class="d" x="134.53" y="33.34" width="10.43" height="32.79"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    <? endif; ?>
								<?
								}

								if ($arItem["DISPLAY_PROPERTIES"]["LINKS"]["DESCRIPTION"][$key]) { ?>
									<span><?= html_entity_decode($arItem["DISPLAY_PROPERTIES"]["LINKS"]["DESCRIPTION"][$key]) ?></span>
								<? } ?>
							</a>
						</li>
						<?
					}

					if ($arItem["DETAIL_TEXT"]) {
						if ($arItem["DISPLAY_PROPERTIES"]["FULL_DESCRIPTION"]["VALUE_XML_ID"] === "window") {
						?>
							<li class="v21-plastic-service__links-item v21-socials__item">
								<a href="#v21_plasticService<?= $counter ?>" class="v21-plastic-service__more v21-button v21-button--link js-v21-modal-toggle">
									<svg width="18" height="18" class="v21-button__icon">
										<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#info"></use>
									</svg>
									<div>Узнать&nbsp;больше</div>
								</a>
							</li>
						<?
						} else if ($arItem["DISPLAY_PROPERTIES"]["FULL_DESCRIPTION"]["VALUE_XML_ID"] === "list") {
						?>
							<li class="v21-plastic-service__links-item v21-socials__item">
								<a href="#v21_plasticService<?= $counter ?>" data-scroll-anchor=".v21-plastic-service__links" class="v21-plastic-service__more v21-button v21-button--link js-v21-dropdown-toggle">
									<div class="v21-plastic-service__more-caption-1">Узнать&nbsp;больше</div>
									<div class="v21-plastic-service__more-caption-2">Свернуть&nbsp;информацию</div>
									<svg width="9" height="9" class="v21-plastic-service__more-icon v21-button__icon">
										<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowDownSmall"></use>
									</svg>
								</a>
							</li>
					<?
						}
					}
					?>
				</ul><!-- /.v21-plastic-service__links -->
			</div><!-- /.v21-plastic-service__text -->
			<? if ($arItem["DISPLAY_PROPERTIES"]["IMAGE_LOCATION"]["VALUE_XML_ID"] === "right") { ?>
				<div class="v21-plastic-service__image">
					<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>">
				</div><!-- /.v21-plastic-service__image -->
				<?
			}

			if ($arItem["DETAIL_TEXT"]) {
				if ($arItem["DISPLAY_PROPERTIES"]["FULL_DESCRIPTION"]["VALUE_XML_ID"] === "list") {
				?>


					<div class="v21-plastic-service__info" id="v21_plasticService1">
						<div class="v21-plastic-service__info-content">
							<div class="v21-plastic-service__info-text v21-content">
								<?= $arItem["DETAIL_TEXT"] ?>
							</div><!-- /.v21-plastic-service__info-text -->

							<a href="#v21_plasticService<?= $counter ?>" data-scroll-anchor=".v21-plastic-service" class="v21-plastic-service__more v21-button v21-button--link js-v21-dropdown-toggle">
								<div class="v21-plastic-service__more-caption-1">Узнать больше</div>
								<div class="v21-plastic-service__more-caption-2">Свернуть информацию</div>
								<svg width="9" height="9" class="v21-plastic-service__more-icon v21-button__icon">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowDownSmall"></use>
								</svg>
							</a>
						</div>
					</div><!-- /.v21-plastic-service__info -->
			<?
				}
			}
			?>
		</div><!-- /.v21-plastic-service -->

		<?
		if ($arItem["DETAIL_TEXT"]) {
			if ($arItem["DISPLAY_PROPERTIES"]["FULL_DESCRIPTION"]["VALUE_XML_ID"] === "window") {
		?>
				<div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_plasticService<?= $counter ?>">
					<div class="v21-modal__window js-v21-modal-window">
						<a href="#v21_plasticService<?= $counter ?>" class="v21-modal__close js-v21-modal-toggle">
							<svg width="24" height="24">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
							</svg>
						</a>
						<h2 class="v21-modal__title v21-h2"><?= html_entity_decode($arItem["DISPLAY_PROPERTIES"]["TITLE"]["VALUE"]) ?? $arItem["NAME"] ?></h2>
						<div class="v21-content">
							<?= $arItem["DETAIL_TEXT"] ?>
						</div>
					</div><!-- /.v21-modal__window -->
				</div><!-- /.v21-modal -->
		<?
			}
		}
		?>
		<? $counter++; ?>
	<? endforeach; ?>
<? } ?>