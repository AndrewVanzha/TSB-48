<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?//print_r($arResult)?>
<? if ($arParams['PARENT_SECTION'] == 438) {
    //debugg($arResult["ITEMS"]);
    foreach($arResult["ITEMS"] as $key => $arItem) {
        //debugg($arItem["NAME"]);
    }
} ?>
<?foreach($arResult["ITEMS"] as $key => $arItem):?>
	<div class="doc-archive__item">
		<div class="doc-archive__desc">
			<?=$arItem["~PREVIEW_TEXT"]?>
		</div>
		<div class="document-list">
			<div class="row">
				
				<?if(is_array($arItem["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"][0])):?>
					<?foreach($arItem["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"] as $arDoc):?>
						<div class="document-list__item col-sm-12 col-lg-12">
							<div class="document-list__icon">
								<img src="/assets/images/broker-deposit/doc.svg" alt="Document" />
							</div>
							<div class="document-list__title">
								<a href="<?=$arDoc["SRC"]?>" download><?=$arDoc["FILE_NAME"]?></a>
							</div>
						</div>
					<?endforeach;?>
				<?else:?>
					<?$arDoc=$arItem["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"]?>
					<div class="document-list__item col-lg-12">
						<div class="document-list__icon">
							<img src="/assets/images/broker-deposit/doc.svg" alt="Document" />
						</div>
						<div class="document-list__title">
							<a href="<?=$arDoc["SRC"]?>" download><?=$arDoc["FILE_NAME"]?></a>
						</div>
					</div>
				<?endif;?>
				
			</div>
		</div>
	</div>
<?endforeach;?>

