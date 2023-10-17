<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?//print_r($arResult)?>
<?/*foreach($arResult["ITEMS"] as $arItem):?>
<div class="document-list__item col-sm-12 col-lg-6">
	<?foreach($arItem["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"] as $arDoc):?>
		<div class="document-list__icon">
			<img src="/assets/images/broker-deposit/doc.svg" alt="Document" />
		</div>
		<div class="document-list__title">
			<a href="<?=$arDoc["SRC"]?>" download><?=$arDoc['FILE_NAME']?></a>
		</div>
	<?endforeach;?>
</div>
<?endforeach;*/?>

<?foreach($arResult["ITEMS"] as $key => $arItem):?>
<div class="document-list__item col-sm-12 col-lg-6">
	<div class="document-list__icon">
		<img src="/assets/images/broker-deposit/doc.svg" alt="Document" />
	</div>
	<div class="document-list__title">
		<a href="<?=$arItem["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"]["SRC"]?>" download><?=$arItem["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"]["FILE_NAME"]?></a>
	</div>
</div>
<?endforeach;?>