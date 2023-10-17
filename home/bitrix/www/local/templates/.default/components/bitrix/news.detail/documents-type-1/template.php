<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$files = $arResult["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"];

if (isset($files['ID'])) {
	$files = [$files];
}
?>
<? foreach ($files as $key => $arItem) : ?>
	<? $fileName = $arItem["DESCRIPTION"]; ?>
	<? if (!$fileName) {
		$fileName = substr($arItem["FILE_NAME"], 0, strrpos($arItem["FILE_NAME"], '.'));
	} ?>
	<div class="ls-documents__item <?= $arResult["DISPLAY_PROPERTIES"]["CLASSES"]["VALUE"] ?>">
		<div class="ls-documents__name"><?= $fileName ?></div>
		<a class="ls-documents__link" target="_blank" href="<?= $arItem["SRC"] ?>" download>
			<span>Скачать</span>
			<img src="/images/arrow.svg">
		</a>
	</div>
<? endforeach; ?>