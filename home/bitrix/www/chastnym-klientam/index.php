<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (АО) предлагает своим клиентам - физическим лицам - обширное количество банковских продуктов для осуществления и реализации Ваших планов. Все продукты разработаны с учетом потребностей и специфики банковского сектора, и каждый обратившейся клиент сможет найти подходящий для него продукт.");
$APPLICATION->SetPageProperty("keywords", "Услуги банка для частных и физических лиц");
$APPLICATION->SetPageProperty("title", "Услуги для частных и физических лиц акционерного коммерческого банка «ТрансСтройБанк»");
$APPLICATION->SetTitle("Частным клиентам");
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"v21_main_slider_private",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE", ""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "184",
		"IBLOCK_TYPE" => "slider_main",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "399",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("LINK", ""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	)
); ?>
<div class="v21-section">
	<div class="v21-container">
        <h2 class="v21-chastnym-products--header">Продукты для частных лиц</h2>
		<div class="v21-grid">
			<div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x4@lg">
				<a href="/chastnym-klientam/vklady/" class="v21-category-card">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-category-1.png" alt="" class="v21-category-card__image">
					<h3 class="v21-category-card__title v21-h6">Вклады</h3>
					<p class="v21-category-card__brief v21-p">Разнообразные деопзиты для накоплений в рублях или валюте</p>
				</a><!-- /.v21-category-card -->
			</div><!-- /.v21-grid__item -->

			<div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x4@lg">
				<a href="/chastnym-klientam/investitsii/" class="v21-category-card">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-category-2.png" alt="" class="v21-category-card__image">
					<h3 class="v21-category-card__title v21-h6">Инвестиции</h3>
					<p class="v21-category-card__brief v21-p">Повышайте доход с профессионалами фондовых рынков</p>
				</a><!-- /.v21-category-card -->
			</div><!-- /.v21-grid__item -->

			<div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x4@lg">
				<a href="https://coins.tsbnk.ru/" target="_blank" class="v21-category-card">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-category-3.png" alt="" class="v21-category-card__image">
					<h3 class="v21-category-card__title v21-h6">Магазин монет</h3>
					<p class="v21-category-card__brief v21-p">Соберите инвестиционный портфель из драгоценных монет со всего мира</p>
				</a><!-- /.v21-category-card -->
			</div><!-- /.v21-grid__item -->

			<div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x4@lg">
				<a href="/bankovskie-karty/" class="v21-category-card">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-category-4.png" alt="" class="v21-category-card__image">
					<h3 class="v21-category-card__title v21-h6">Банковские карты</h3>
					<p class="v21-category-card__brief v21-p">Кэшбэк, проценты на остаток, доставка и эксклюзивные привилегии</p>
				</a><!-- /.v21-category-card -->
			</div><!-- /.v21-grid__item -->

		</div><!-- /.v21-grid -->
	</div><!-- /.v21-container -->
</div><!-- /.v21-section -->
<?
$citySes = ($_SESSION['city']) ? $_SESSION['city'] : 399;
if ($citySes == 399 && !\GarbageStorage::get('OfficeId')) {
	\GarbageStorage::set('OfficeId', 433);
} ?>
<? $APPLICATION->IncludeComponent(
	"webtu:synch.currency",
	"def",
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CBR_IBLOCK_ID" => "116",
		"OFFICE_IBLOCK_ID" => "115"
	)
); ?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news-list",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "news-list",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0 => "PREVIEW_PICTURE", 1 => "DETAIL_PICTURE", 2 => "",),
		"FILTER_NAME" => "specialFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "about",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0 => "LINKS", 1 => "",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
); ?>
<div class="v21-section">
	<div class="v21-container">
		<div class="v21-grid">

			<div class="v21-grid__item v21-grid__item--1x2@sm">
				<a href="/finansovaya-gramotnost/Finliteracy.php" class="v21-help-card">
					<div class="v21-help-card__text">
						<h3 class="v21-help-card__title v21-h3">Финансовая<br> грамотность</h3>
						<p class="v21-help-card__brief v21-p">Трансстройбанк убедительно просит Вас ознакомиться с простыми правилами защиты от мошеннических действий.</p>
						<div class="v21-help-card__button v21-button">Подробнее</div>
					</div>
                    <?/*?><img src="/local/templates/v21_template_home/img/v21_v21-help-1.png" alt="Финансовая грамотность" class="v21-help-card__image"><?*/?>
                    <img src="/local/templates/v21_template_home/img/v21_v21-help-1.webp" alt="Финансовая грамотность" class="v21-help-card__image">
				</a><!-- /.v21-help-card -->
			</div><!-- /.v21-grid__item -->

			<div class="v21-grid__item v21-grid__item--1x2@sm">
				<a href="/ofisy-i-bankomaty/" class="v21-help-card">
					<div class="v21-help-card__text">
						<h3 class="v21-help-card__title v21-h3">Офисы и<br> банкоматы</h3>
						<p class="v21-help-card__brief v21-p">Кроме сети банкоматов Транстройбанка, Вы можете также воспользоваться услугами банкоматов и ПВН наших партнеров.</p>
						<div class="v21-help-card__button v21-button">Подробнее</div>
					</div>
                    <?/*?><img src="/local/templates/v21_template_home/img/v21_v21-help-2.png" alt="Офисы и банкоматы" class="v21-help-card__image"><?*/?>
                    <img src="/local/templates/v21_template_home/img/v21_v21-help-2.webp" alt="Офисы и банкоматы" class="v21-help-card__image">
				</a><!-- /.v21-help-card -->
			</div><!-- /.v21-grid__item -->

		</div><!-- /.v21-grid -->
	</div><!-- /.v21-container -->
</div><!-- ./v21-section -->

<?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true);
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>