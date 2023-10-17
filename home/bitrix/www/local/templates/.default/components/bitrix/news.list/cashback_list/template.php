<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="cashback-conditions__list col-md-12 col-lg-10 offset-lg-1">
	<div class="row conditions-slider swiper-container">
		<div class="swiper-wrapper conditions-slider__wrapper">
			<?foreach($arResult["ITEMS"] as $key => $arItem):?>
				<div class="cashback-conditions__item swiper-slide conditions-item">
				<div class="conditions-item__wrapper <?if($key == 0):?>conditions-item--turquoise<?elseif($key == 1):?>conditions-item--blue<?elseif($key == 2):?>conditions-item--gold<?endif;?>">
						<div class="conditions-item__header">
							<?=$arItem['NAME']?>
						</div>
						<div class="conditions-item__desc">
							<?=$arItem['PREVIEW_TEXT']?>
						</div>
						<div class="conditions-item__if">
							<p>Условие:</p>
							<?=$arItem['DETAIL_TEXT']?>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
	<div class="conditions-slider__pagination d-md-none"></div>
</div>