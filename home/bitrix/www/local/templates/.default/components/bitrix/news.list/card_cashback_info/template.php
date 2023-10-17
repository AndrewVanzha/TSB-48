<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<style>
	.breadcrumbs {margin-bottom:44px}
	.popup-form_title, .fancybox-close-small, .popup-form_content .button, .popup-form .switch-box_lever::before {background-color:#A58A57}
	.popup-form_content .button:hover {background-color:#00345E}
	.popup-form .select-box .cs-box_selected, .popup-form .select-box .cs-box_list li.is-active, .popup-form a {color: #A58A57;text-decoration:none}
	.popup-form a:hover {color:#00345E}
	.popup-form_content .button {border-radius:0;height:45px;line-height:42px}
</style>
<link rel="stylesheet" href="/assets/css/style-broker-deposit.css?v=1.0.2">

<div class="row">
	<div class="card-tariff__slider col-md-6 col-lg-5">
		<div class="tariff-slider__title d-md-none">Visa Platinum PayWave</div>
		<div class="swiper-container tariff-slider">
			<div class="swiper-wrapper">
			<?foreach($arResult['ITEMS'] as $key => $arItem):?>
				<? if(strripos($arItem['NAME'], 'MasterCard') !== false) continue; ?>
				<div
						class="swiper-slide tariff-slider__slide"
						style="background-image:url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>)"
						data-card_info='{"title":"<?=$arItem['NAME']?>","url":"<?=$arItem['PROPERTIES']['LINK_CARD']['VALUE']?>","param":<?=htmlspecialcharsEx(json_encode($arItem['PROPERTIES']['INFO_CARD']['VALUE'], JSON_UNESCAPED_UNICODE))?>}'
				></div>
			<?endforeach;?>
			</div>
		</div>
		<div class="tariff-slider__arrows">
			<div class="tariff-slider__arrow tariff-slider__prev">
				<svg width="9" height="14" viewBox="0 0 9 14" fill="none"
						xmlns="http://www.w3.org/2000/svg">
					<path d="M1 13L8 7L0.999999 1" stroke="#62757E"/>
				</svg>
			</div>
			<div class="tariff-slider__number"></div>
			<div class="tariff-slider__arrow tariff-slider__next">
				<svg width="9" height="14" viewBox="0 0 9 14" fill="none"
						xmlns="http://www.w3.org/2000/svg">
					<path d="M1 13L8 7L0.999999 1" stroke="#62757E"/>
				</svg>
			</div>
		</div>
	</div>
	<div class="card-tariff__desc tariff-desc col-sm-8 offset-sm-2 col-md-6 offset-md-0 col-lg-7">
		<h3 class="tariff-desc__title d-none d-md-block">Visa Platinum PayWave</h3>
		<ul class="tariff-desc__ul">
			<li class="tariff-desc__li">Кэшбэк программа</li>
			<li class="tariff-desc__li">до 6,0 % на остаток по картсчету</li>
			<li class="tariff-desc__li">Бесплатный SMS-сервис о проведенных операциях по карте</li>
			<li class="tariff-desc__li">
				Бесплатное пополнение переводом из другого банка через Систему быстрых платежей (СБП) по номеру телефона – до 100 000 ₽ в месяц
			</li>
			<li class="tariff-desc__li">Оплата покупок в одно касание картой с помощью бесконтактной технологии
				
			</li>

		</ul>
		<a
				<?/*?>href="https://www.transstroybank.ru/chastnym-klientam/bankovskie-karty/visa-platinum-pay-wave/"
				class="tariff-desc__link"<?*/?>
                <??>href="https://www.transstroybank.ru/chastnym-klientam/debit-cards/"
                class="tariff-desc__link"<??>
		>
            <?/*?><span style="margin-right: 10px">Подробнее</span>
            <svg width="9" height="14" viewBox="0 0 9 14" fill="none" style="display: inline-block;"<?*/?>
			<??>Подробнее
			<svg width="9" height="14" viewBox="0 0 9 14" fill="none"<??>
					xmlns="http://www.w3.org/2000/svg">
				<path d="M1 13L8 7L0.999999 1" stroke="#62757E"/>
			</svg>
		</a>
	</div>
</div>

<script src="/assets/js/script-broker-deposit.js?v=1.0.2"></script>