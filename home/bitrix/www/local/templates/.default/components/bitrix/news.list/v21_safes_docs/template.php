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
		<? foreach ($arResult["ITEMS"] as $arItem) : ?>
			<?
			$archiveDocs = $arItem["PROPERTIES"]["ARCHIVE_DOCUMENTS"]["VALUE"];
			if (count($arItem["DISPLAY_PROPERTIES"]["FILE"]["VALUE"]) === 0) {
				if (!$archiveDocs) {
					continue;
				}
			}

			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="v21-section v21-section--xs">
				<h2 class="v21-section__subtitle v21-h6"><?= $arItem["NAME"] ?></h2>
				<div class="v21-grid">

					<? foreach ($arItem["DISPLAY_PROPERTIES"]["FILE"]["VALUE"] as $key => $fileId) { ?>
						<div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                            <?
                            $cond0 = ($arParams["DOC_OUTPUT_LINK_HTML"] == 'Y')? mb_stripos($arItem["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"][$key], $arParams["DOC_OUTPUT_LINK_HTML_PATTERN"]) : false;
                            $cond1 = mb_stripos($arItem["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"][$key], 'равила');
                            $cond2 = mb_stripos($arItem["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"][$key], 'открытия');
                            $cond3 = mb_stripos($arItem["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"][$key], 'ведения');
                            $cond4 = mb_stripos($arItem["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"][$key], 'закрытия');
                            $cond5 = mb_stripos($arItem["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"][$key], 'физическ');
                            if($cond0 != false && $cond1 != false && $cond2 != false && $cond3 != false && $cond4 != false && $cond5 != false) : ?>
                                <a href="/chastnym-klientam/debit-cards/sbp/index1122.html" class="v21-document v21-link" target="_blank">
                                    <div class="v21-document__title">
                                        <?= $arItem["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"][$key] ?>
                                    </div>
                                    <div class="v21-document__download">
                                        <span class="v21-link__text">Скачать</span>
                                        <svg width="11" height="12" class="v21-document__download-icon">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#download"></use>
                                        </svg>
                                    </div>
                                </a>
                            <? else: ?>

							<a href="<?= CFile::GetPath($fileId) ?>" class="v21-document v21-link">
								<div class="v21-document__title">
									<?= $arItem["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"][$key] ?>
								</div>
								<div class="v21-document__download">
									<span class="v21-link__text">Скачать</span>
									<svg width="11" height="12" class="v21-document__download-icon">
										<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#download"></use>
									</svg>
								</div>
							</a><!-- /.v21-document -->
                            <? endif; ?>

						</div><!-- /.v21-grid__item -->
					<? } ?>

				</div><!-- /.v21-grid -->
				<? if ($archiveDocs) { ?>
					<div class="v21-more v21-more--side">
						<?/*?><a href="<?= $archiveDocs ?>" class="v21-button v21-button--border" target="_blank">Архив документов</a><?*/?>
                        <a href="<?= $archiveDocs ?>" class="archive-section" target="_blank">
                            <span>Архив документов </span>
                            <svg class="archive-section__arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                            </svg>
                        </a>
					</div>
				<? } ?>
			</div><!-- /.v21-section -->
		<? endforeach; ?>
	</div><!-- /.v21-section -->
<? } ?>