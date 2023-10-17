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
?>
	<div data-tab-anchor="true" class="v21-section js-v21-tabs">
		<div class="v21-tabs-header js-v21-tabs-header">
			<button class="v21-tabs-header__nav v21-tabs-header__nav--next js-v21-tabs-header-next"></button>
			<button class="v21-tabs-header__nav v21-tabs-header__nav--prev js-v21-tabs-header-prev"></button>
			<div class="js-v21-tabs-header-slider">
				<div>
					<a href="#" data-tab-id="tab0" data-slide="0" class="v21-tabs-header__item js-v21-tabs-header-item js-v21-tabs-toggle is-active">
						Все программы
					</a>
				</div>
				<? foreach ($arResult["PROGRAM_TYPE_HTML"] as $programType) { ?>
					<div>
						<?
						echo $programType;
						?>
					</div>
				<? } ?>
			</div><!-- /.js-v21-tabs-header-slider -->
		</div><!-- /.v21-tabs-header -->
		<? foreach ($arResult["ITEMS"] as $key => $arItem) : ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

			<?
			$isActive = ' is-active';
			$tabs = 'tab0';
			foreach ($arItem["PROPERTIES"]["PROGRAM_TYPE"]["VALUE_XML_ID"] as $type) {
				if ($type === "tab5") {
					$tabs = $type;
					$isActive = '';
					break;
				}

				$tabs .= " " . $type;
			}

			$stats = "";
			if (isStats($arItem["PROPERTIES"])) {
				$stats = getStats($arItem["PROPERTIES"]);
			}
			?>
			<div data-tab-id="<?= $tabs ?>" class="v21-service-card v21-service-card--filter<?= $isActive ?>">
				<div class="v21-service-card__image">
					<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>">
				</div><!-- /.v21-service-card__image -->
				<div class="v21-service-card__text">
					<h3 class="v21-service-card__title v21-h4"><?= $arItem["NAME"] ?></h3>
					<div class="v21-service-card__item v21-content"><?= $arItem["PREVIEW_TEXT"] ?></div>
					<?= $stats ?? "" ?>
					<div class="v21-service-card__controls">
						<? if ($arItem["PROPERTIES"]["LINK_PAGE"]["VALUE"] && $arItem["PROPERTIES"]["LINK_PAGE"]["DESCRIPTION"]) { ?>
							<a href="<?= $arItem["PROPERTIES"]["LINK_PAGE"]["DESCRIPTION"] ?>" target="_blank" rel="nofollow" class="v21-service-card__order--xl v21-service-card__order v21-service-card__controls-item v21-button">
								<?= $arItem["PROPERTIES"]["LINK_PAGE"]["VALUE"] ?>
							</a>
						<? } else { ?>
							<a href="#v21_mortgageOrder" data-name="<?= $arItem["NAME"] ?>" class="v21-service-card__order--lg v21-service-card__order v21-service-card__controls-item v21-button js-v21-modal-toggle open">Оставить заявку</a>
						<? } ?>
						<? if ($arItem["DETAIL_TEXT"]) { ?>
							<a href="#v21_mortgageInfo<?= $key ?>" class="v21-service-card__controls-item v21-button v21-button--link js-v21-modal-toggle">
								<div>Подробнее</div>
								<svg width="9" height="9" class="v21-button__icon">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowRightSmall"></use>
								</svg>
							</a>
						<? } ?>
					</div><!-- /.v21-service-card__controls -->
				</div><!-- /.v21-service-card__text -->
			</div><!-- /.v21-service-card -->
			<? if ($arItem["DETAIL_TEXT"]) { ?>
				<div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_mortgageInfo<?= $key ?>">
					<div class="v21-modal__window js-v21-modal-window">
						<a href="#v21_mortgageInfo<?= $key ?>" class="v21-modal__close js-v21-modal-toggle">
							<svg width="24" height="24">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
							</svg>
						</a>
						<div class="v21-service-card v21-service-card--modal">
							<h2 class="v21-service-card__title v21-modal__title v21-h2"><?= $arItem["NAME"] ?></h2>

							<?= $stats ?? "" ?>

							<div class="v21-service-card__item">
								<div class="v21-service-card__text v21-content">
									<?= $arItem["DETAIL_TEXT"] ?>
								</div><!-- /.v21-service-card__text -->
							</div><!-- /.v21-service-card__item -->
							<?
							// echo "<pre>";
							// var_dump($arItem["PROPERTIES"]["DOCS"]["VALUE"]);
							// echo "</pre>";
							?>
							<?
							$documents = getDocuments($arItem["PROPERTIES"]["DOCS"]["VALUE"]);
							if ($documents) { ?>
								<div class="v21-service-card__item--sm v21-service-card__item">
									<h2 class="v21-service-card__subtitle v21-h6">Документы</h2>
									<div class="v21-grid">
										<? foreach ($documents as $document) { ?>
											<div class="v21-grid__item v21-grid__item--1x2@md">
												<a href="<?= $document["LINK"] ?>" class="v21-document v21-link">
													<div class="v21-document__title"><?= $document["NAME"] ?></div>
													<div class="v21-document__download">
														<span class="v21-link__text">Скачать</span>
														<svg width="11" height="12" class="v21-document__download-icon">
															<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#download"></use>
														</svg>
													</div>
												</a><!-- /.v21-document -->
											</div><!-- /.v21-grid__item -->
										<? } ?>
									</div><!-- /.v21-grid -->
								</div><!-- /.v21-service-card__item -->
							<? } ?>
							<? if (!$arItem["PROPERTIES"]["LINK_PAGE"]["VALUE"] && !$arItem["PROPERTIES"]["LINK_PAGE"]["DESCRIPTION"]) { ?>
								<a href="#v21_mortgageOrder" data-name="<?= $arItem["NAME"] ?>" class="v21-modal__button v21-button js-v21-modal-toggle">Отправить заявку</a>
							<? } ?>
						</div><!-- /.v21-service-card -->
					</div><!-- /.v21-modal__window -->
				</div><!-- /.v21-modal -->
			<? } ?>
		<? endforeach; ?>
	</div>
<? } ?>