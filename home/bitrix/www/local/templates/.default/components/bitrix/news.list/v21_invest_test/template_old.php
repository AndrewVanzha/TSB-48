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
	<div class="v21-section">
		<? foreach ($arResult["ITEMS"] as $key => $arItem) : ?>
			<div class="v21-service-card">
				<div class="v21-service-card__image">
					<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>">
				</div><!-- /.v21-service-card__image -->
				<div class="v21-service-card__text">
					<h3 class="v21-service-card__title v21-h4"><?= $arItem["NAME"] ?></h3>
					<?
					if (isStats($arItem["PROPERTIES"])) {
					?>
						<div class="v21-service-card__item">
							<?= $arItem["PREVIEW_TEXT"] ?>
						</div><!-- /.v21-service-card__item -->
					<?
						echo getStats($arItem["PROPERTIES"]);
					} else {
					?>
						<div class="v21-service-card__brief">
							<?= $arItem["PREVIEW_TEXT"] ?>
						</div>
					<?
					}
					?>

					<? if ($arItem["PROPERTIES"]["LINK_PAGE"]["VALUE"]) {
						$linkPage = $arItem["PROPERTIES"]["LINK_PAGE"]["VALUE"];
						$target = ' target="_blank"';
					} else {
						$linkPage = '#v21_investInfo' . $key;
						$target = '';
					} ?>
					<div class="v21-service-card__controls">
						<a href="#v21_brokerageOrder" data-name="<?= $arItem["NAME"] ?>" class="v21-service-card__order v21-service-card__controls-item v21-button js-v21-modal-toggle open">Оставить заявку</a>
						<a href="<?= $linkPage ?>" class="v21-service-card__controls-item v21-button v21-button--link <?= $target ? "" : "js-v21-modal-toggle" ?>" <?= $target ?>>
							<div>Подробнее</div>
							<svg width="9" height="9" class="v21-button__icon">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#arrowRightSmall"></use>
							</svg>
						</a>
					</div><!-- /.v21-service-card__controls -->
				</div><!-- /.v21-service-card__text -->
			</div><!-- /.v21-service-card -->

			<? if (!$arItem["PROPERTIES"]["LINK_PAGE"]["VALUE"]) { ?>
				<div data-overlay="v21_overlay" class="v21-modal v21-fade js-v21-modal" id="v21_investInfo<?= $key ?>">
					<div class="v21-modal__window js-v21-modal-window">
						<a href="#v21_investInfo<?= $key ?>" class="v21-modal__close js-v21-modal-toggle">
							<svg width="24" height="24">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
							</svg>
						</a>
						<div class="v21-service-card v21-service-card--modal">
							<h2 class="v21-service-card__title v21-modal__title v21-h2"><?= $arItem["NAME"] ?></h2>

							<div class="v21-service-card__item">
								<div class="v21-service-card__text v21-content">
									<?= $arItem["DETAIL_TEXT"] ?>
								</div><!-- /.v21-service-card__text -->
							</div><!-- /.v21-service-card__item -->
							<?
							$documents = getDocuments($arItem["PROPERTIES"]["DOCS"]);
							$archiveDocs = $arItem["PROPERTIES"]["ARCHIVE_DOCUMENTS"]["VALUE"];
							if ($documents || $archiveDocs) {
							?>
								<div class="v21-service-card__item--sm v21-service-card__item">
									<h2 class="v21-service-card__subtitle v21-h6">Документы</h2>
									<div class="v21-grid">
										<?
										foreach ($documents as $document) { ?>

											<div class="v21-grid__item v21-grid__item--1x2@md">
												<a href="<?= $document["LINK"] ?>" class="v21-document v21-link" target="_blank">
													<div class="v21-document__title">
														<?= $document["NAME"] ?>
													</div>
													<div class="v21-document__download">
														<span class="v21-link__text">Скачать</span>
														<svg width="11" height="12" class="v21-document__download-icon">
															<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#download"></use>
														</svg>
													</div>
												</a><!-- /.v21-document -->
											</div><!-- /.v21-grid__item -->
										<? }
										?>
									</div><!-- /.v21-grid -->
									<? if ($archiveDocs) { ?>
										<div class="v21-more v21-more--side">
											<a href="<?= $archiveDocs ?>" class="v21-button v21-button--border" target="_blank">Архив документов</a>
										</div>
									<? } ?>
								</div><!-- /.v21-service-card__item -->
							<?
							} ?>

							<a href="#v21_brokerageOrder" data-name="<?= $arItem["NAME"] ?>" data-order="mortgage1" class="v21-modal__button v21-button js-v21-order-toggle js-v21-modal-toggle open">Отправить заявку</a>
						</div><!-- /.v21-service-card -->
					</div><!-- /.v21-modal__window -->
				</div><!-- /.v21-modal -->
			<? } ?>
		<? endforeach; ?>
	</div>
<? } ?>