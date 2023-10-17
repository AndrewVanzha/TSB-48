<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<style>
    .page-lf .bd-spoiler__topic {
        padding-bottom: 24px;
        margin-bottom: 24px;
        border-bottom: 1px solid #a08a57
    }
    @media screen and (max-width: 630px) {
        .page-lf .bd-spoiler__topic:last-child {
            margin-bottom: 0
        }
    }
    .page-lf .bd-spoiler__line {
        position: relative;
        color: #a08a57;
        cursor: pointer;
        padding-right: 15px
    }
    @media screen and (max-width: 630px) {
        .page-lf .bd-spoiler__line {
            font-size: 14px
        }
    }
    .page-lf .bd-spoiler__line:after {
        position: absolute;
        content: "";
        top: 10px;
        right: 0;
        width: 12px;
        height: 7px;
        background-image: url(/assets/images/broker-deposit/arrow.svg);
        transform: rotate(180deg)
    }
    .page-lf .bd-spoiler__line--active:after {
        transform: rotate(0deg)
    }
</style>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
		'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
	),
	$component
);?>

<?
if($ElementID == 7497){
	?>
	<style>
		.breadcrumbs {margin-bottom:44px}
	</style>
	<link rel="stylesheet" href="/assets/css/style-broker-deposit.css?v=1.0.3">
	<div class="page-lf"><!--deposit-->
		<div class="container">
			<section class="circs-deposit">
			<div class="row">
				<div class="circs-deposit__info col-lg-3 col-md-4">
				<div class="circs-deposit__license col-lg-12">
					Депозитарий АКБ «Трансстройбанк» (АО) действует на основании лицензии Банка России на осуществление
					депозитарной деятельности № 045-14072-000100 от 03 июля 2019 года. Лицензия выдана без ограничения срока
					действия.
				</div>
				<div class="circs-deposit__contact col-lg-12">
					<header>Контакты</header>
					<div class="circs-deposit__phone">
					<a href="tel:+74957863773">+7 (495) 786-37-73</a>, доб. 294<br />
					<a href="mailto:broker@tsbnk.ru">broker@tsbnk.ru</a>
					</div>
					<div class="circs-deposit__rezhim">
					Пн-Пт с 10.00 до 16.00<br />
					Обед с 13.00 до 14.00
					</div>
				</div>
				</div>
				<div class="circs-deposit__content col-md-8 offset-lg-1">
				<div class="circs-deposit__header row">
					<header class="col-lg-11">
					<h2 class="page-title page-title__h2">Условия депозитарного обслуживания</h2>
					</header>
					<p class="circs-deposit__desc col-lg-11">
					Условия не являются публичным предложением (офертой) Банка заключить депозитарный договор с каждым
					обратившимся лицом. Условия регулируют порядок взаимоотношений между Банком и Депонентом на основании
					депозитарного договора, заключенного в порядке и на условиях, определенных в настоящем документе.
					</p>
				</div>
				<div class="circs-deposit__document document-list">
					<div class="row">
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"documents",
							Array(
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
								"CHECK_DATES" => "N",
								"DETAIL_URL" => "",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "N",
								"DISPLAY_PICTURE" => "N",
								"DISPLAY_PREVIEW_TEXT" => "N",
								"DISPLAY_TOP_PAGER" => "N",
								"FIELD_CODE" => array("NAME",""),
								"FILTER_NAME" => "",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"IBLOCK_ID" => "186",
								"IBLOCK_TYPE" => "private_clients",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"INCLUDE_SUBSECTIONS" => "N",
								"MESSAGE_404" => "",
								"NEWS_COUNT" => "20",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => ".default",
								"PAGER_TITLE" => "Новости",
								"PARENT_SECTION" => "431",
								"PARENT_SECTION_CODE" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PROPERTY_CODE" => array("","DOCUMENTS",""),
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
						);?>
					</div>
				</div>
				<div class="circs-deposit__dogovor deposit-dogovor">
					<div class="row">
					<div class="deposit-dogovor__header col-lg-10 offset-lg-1">
						<div class="row">
						<header class="col-lg-11">
							<h3 class="page-title page-title__h3">Депозитарный договор</h3>
						</header>
						<div class="deposit-dogovor__desc col-lg-11">
							<p>
							Депозитарный договор заключается путём присоединения заинтересованного лица к Условиям
							осуществления депозитарной деятельности АКБ «Трансстройбанк» (АО) в соответствии со ст. 428 ГК
							РФ.
							</p>
							<p>
							Форма Заявления на заключение депозитарного договора размещена в подразделе «Формы документов,
							предоставляемые депонентами в Депозитарий».
							</p>
						</div>
						</div>
					</div>
					<div class="deposit-dogovor__spoiler bd-spoiler col-lg-11 offset-lg-1">
                        <?/*?><div class="bd-spoiler__item"><?*/?>
                        <div class="bd-spoiler__topic">
                        <?/*?><div class="bd-spoiler__title"><?*/?>
                        <div class="bd-spoiler__line js-spoiler--line">
							<span>Формы документов, предоставляемые депонентами в Депозитарий</span>
						</div>
						<div class="bd-spoiler__content">
							<div class="document-list col-lg-10">
							<div class="row">
								<?$APPLICATION->IncludeComponent(
									"bitrix:news.list",
									"documents",
									Array(
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
										"CHECK_DATES" => "N",
										"DETAIL_URL" => "",
										"DISPLAY_BOTTOM_PAGER" => "N",
										"DISPLAY_DATE" => "N",
										"DISPLAY_NAME" => "N",
										"DISPLAY_PICTURE" => "N",
										"DISPLAY_PREVIEW_TEXT" => "N",
										"DISPLAY_TOP_PAGER" => "N",
										"FIELD_CODE" => array("NAME",""),
										"FILTER_NAME" => "",
										"HIDE_LINK_WHEN_NO_DETAIL" => "N",
										"IBLOCK_ID" => "186",
										"IBLOCK_TYPE" => "private_clients",
										"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
										"INCLUDE_SUBSECTIONS" => "N",
										"MESSAGE_404" => "",
										"NEWS_COUNT" => "40",
										"PAGER_BASE_LINK_ENABLE" => "N",
										"PAGER_DESC_NUMBERING" => "N",
										"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
										"PAGER_SHOW_ALL" => "N",
										"PAGER_SHOW_ALWAYS" => "N",
										"PAGER_TEMPLATE" => ".default",
										"PAGER_TITLE" => "Новости",
										"PARENT_SECTION" => "428",
										"PARENT_SECTION_CODE" => "",
										"PREVIEW_TRUNCATE_LEN" => "",
										"PROPERTY_CODE" => array("","DOCUMENTS",""),
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
								);?>
							</div>
							</div>
						</div>
						</div>
                        <?/*?><div class="bd-spoiler__item"><?*/?>
                        <div class="bd-spoiler__topic">
                        <?/*?><div class="bd-spoiler__title"><?*/?>
                        <div class="bd-spoiler__line js-spoiler--line">
							<span>Формы документов, предоставляемые Депозитарием депонентам</span>
						</div>
						<div class="bd-spoiler__content">
							<div class="document-list col-lg-10">
							<div class="row">
								<?$APPLICATION->IncludeComponent(
									"bitrix:news.list",
									"documents",
									Array(
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
										"CHECK_DATES" => "N",
										"DETAIL_URL" => "",
										"DISPLAY_BOTTOM_PAGER" => "N",
										"DISPLAY_DATE" => "N",
										"DISPLAY_NAME" => "N",
										"DISPLAY_PICTURE" => "N",
										"DISPLAY_PREVIEW_TEXT" => "N",
										"DISPLAY_TOP_PAGER" => "N",
										"FIELD_CODE" => array("NAME",""),
										"FILTER_NAME" => "",
										"HIDE_LINK_WHEN_NO_DETAIL" => "N",
										"IBLOCK_ID" => "186",
										"IBLOCK_TYPE" => "private_clients",
										"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
										"INCLUDE_SUBSECTIONS" => "N",
										"MESSAGE_404" => "",
										"NEWS_COUNT" => "20",
										"PAGER_BASE_LINK_ENABLE" => "N",
										"PAGER_DESC_NUMBERING" => "N",
										"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
										"PAGER_SHOW_ALL" => "N",
										"PAGER_SHOW_ALWAYS" => "N",
										"PAGER_TEMPLATE" => ".default",
										"PAGER_TITLE" => "Новости",
										"PARENT_SECTION" => "429",
										"PARENT_SECTION_CODE" => "",
										"PREVIEW_TRUNCATE_LEN" => "",
										"PROPERTY_CODE" => array("","DOCUMENTS",""),
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
								);?>
							</div>
							</div>
						</div>
						</div>
                        <?/*?><div class="bd-spoiler__item"><?*/?>
                        <div class="bd-spoiler__topic">
                        <?/*?><div class="bd-spoiler__title"><?*/?>
                        <div class="bd-spoiler__line js-spoiler--line">
							<span>Тарифы комиссионного вознаграждения за депозитарную деятельность</span>
						</div>
						<div class="bd-spoiler__content">
							<div class="document-list col-lg-10">
							<div class="row">
								<?$APPLICATION->IncludeComponent(
									"bitrix:news.list",
									"documents",
									Array(
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
										"CHECK_DATES" => "N",
										"DETAIL_URL" => "",
										"DISPLAY_BOTTOM_PAGER" => "N",
										"DISPLAY_DATE" => "N",
										"DISPLAY_NAME" => "N",
										"DISPLAY_PICTURE" => "N",
										"DISPLAY_PREVIEW_TEXT" => "N",
										"DISPLAY_TOP_PAGER" => "N",
										"FIELD_CODE" => array("NAME",""),
										"FILTER_NAME" => "",
										"HIDE_LINK_WHEN_NO_DETAIL" => "N",
										"IBLOCK_ID" => "186",
										"IBLOCK_TYPE" => "private_clients",
										"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
										"INCLUDE_SUBSECTIONS" => "N",
										"MESSAGE_404" => "",
										"NEWS_COUNT" => "20",
										"PAGER_BASE_LINK_ENABLE" => "N",
										"PAGER_DESC_NUMBERING" => "N",
										"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
										"PAGER_SHOW_ALL" => "N",
										"PAGER_SHOW_ALWAYS" => "N",
										"PAGER_TEMPLATE" => ".default",
										"PAGER_TITLE" => "Новости",
										"PARENT_SECTION" => "430",
										"PARENT_SECTION_CODE" => "",
										"PREVIEW_TRUNCATE_LEN" => "",
										"PROPERTY_CODE" => array("","DOCUMENTS",""),
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
								);?>
							</div>
							</div>
						</div>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
			</section>
		</div>
		<div class="container">
            <?// $archiveDocs = $arItem["PROPERTIES"]["ARCHIVE_DOCUMENTS"]["VALUE"]; ?>
            <? $archiveDocs = "/chastnym-klientam/arkhiv-tarifov-i-dokumentov-individual/depozitarnoe-obsluzhivanie/"; ?>
            <div class="v21-section v21-section--xs">
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
            </div>

            <?/*?>
			<section class="doc-archive">
				<header class="doc-archive__header">
					<h3 class="doc-archive__title page-title page-title__h3">
					Архив документов
					</h3>
				</header>
				<div class="doc-archive__wrapper">
					<div class="row">
					<div class="doc-archive__contract archive-contract col-md-4">
						<div class="row">
						<div class="col-md-11">
							<header class="archive-contract__header">
							<h4 class="archive-contract__title page-title page-title__h4">
								Условия осуществления депозитарного обслуживания
							</h4>
							</header>
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"documents_broker_archive",
								Array(
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
									"CHECK_DATES" => "N",
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "N",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array("NAME",""),
									"FILTER_NAME" => "",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => "186",
									"IBLOCK_TYPE" => "private_clients",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"INCLUDE_SUBSECTIONS" => "N",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "20",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => ".default",
									"PAGER_TITLE" => "Новости",
									"PARENT_SECTION" => "443",
									"PARENT_SECTION_CODE" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"PROPERTY_CODE" => array("DOCUMENTS",""),
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
							);?>
						</div>
						</div>
					</div>
					</div>
				</div>
			</section>
            <?*/?>
		</div>
	</div>
	<script src="/assets/js/script-broker-deposit.js?v=1.0.1"></script>
<?
}
elseif($ElementID == 7498){
	?>

	<style>
		.breadcrumbs {margin-bottom:44px}
	</style>
	<link rel="stylesheet" href="/assets/css/style-broker-deposit.css?v=1.0.4">
	<div class="page-lf">
		<div class="container">
			<section class="circs-deposit">
				<div class="row">
					<div class="circs-deposit__info col-md-4 col-lg-3">
						<div class="circs-deposit__preim">
							<div class="circs-deposit__preim-item">
								<img src="/assets/images/broker-deposit/tarif.svg" alt="Tariff"/>
								<p>Гибкие тарифы</p>
							</div>
							<div class="circs-deposit__preim-item">
								<img src="/assets/images/broker-deposit/time.svg" alt="Time"/>
								<p>Открытие торгового счёта в течение 2-х рабочих дней</p>
							</div>
						</div>
						<div class="circs-deposit__contact">
							<header>Контакты</header>
							<div class="circs-deposit__phone">
								<a href="tel:+74957863797">+7 (495) 786-37-97</a><br/>
								<a href="mailto:broker@tsbnk.ru">broker@tsbnk.ru</a>
							</div>
							<div class="circs-deposit__rezhim">
								Пн-Пт с 10.00 до 17.00<br/>
								Обед с 13.00 до 14.00
							</div>
						</div>
					</div>
					<div class="circs-deposit__content col-md-8 offset-lg-1">
						<div class="circs-deposit__header row">
							<header class="col-lg-11">
								<h2 class="page-title page-title__h2">Условия брокерского обслуживания</h2>
							</header>
							<p class="circs-deposit__desc col-lg-10">
								Условия предоставления брокерских услуг как с открытием и ведением индивидуального
								инвестиционного
								счёта, так и отдельно.
							</p>
						</div>
						<div class="circs-deposit__document document-list">
							<div class="row">
								<?$APPLICATION->IncludeComponent(
									"bitrix:news.list",
									"documents_broker",
									Array(
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
										"CHECK_DATES" => "N",
										"DETAIL_URL" => "",
										"DISPLAY_BOTTOM_PAGER" => "N",
										"DISPLAY_DATE" => "N",
										"DISPLAY_NAME" => "N",
										"DISPLAY_PICTURE" => "N",
										"DISPLAY_PREVIEW_TEXT" => "N",
										"DISPLAY_TOP_PAGER" => "N",
										"FIELD_CODE" => array("NAME",""),
										"FILTER_NAME" => "",
										"HIDE_LINK_WHEN_NO_DETAIL" => "N",
										"IBLOCK_ID" => "187",
										"IBLOCK_TYPE" => "private_clients",
										"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
										"INCLUDE_SUBSECTIONS" => "N",
										"MESSAGE_404" => "",
										"NEWS_COUNT" => "20",
										"PAGER_BASE_LINK_ENABLE" => "N",
										"PAGER_DESC_NUMBERING" => "N",
										"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
										"PAGER_SHOW_ALL" => "N",
										"PAGER_SHOW_ALWAYS" => "N",
										"PAGER_TEMPLATE" => ".default",
										"PAGER_TITLE" => "Новости",
										"PARENT_SECTION" => "432",
										"PARENT_SECTION_CODE" => "",
										"PREVIEW_TRUNCATE_LEN" => "",
										"PROPERTY_CODE" => array("","DOCUMENTS",""),
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
								);?>
							</div>
						</div>
						<div class="circs-deposit__dogovor deposit-dogovor">
							<div class="row">
								<div class="deposit-dogovor__header col-lg-10 offset-lg-1">
									<div class="row">
										<header class="col-lg-11">
											<h3 class="page-title page-title__h3">Договор брокерского обслуживания</h3>
										</header>
										<div class="deposit-dogovor__desc col-lg-11">
											<p>
												Брокерский договор заключается путём присоединения заинтересованного лица к
												Условиям
												предоставления АКБ «Трансстройбанк» (АО) брокерских услуг в соответствии со
												ст. 428 ГК РФ.
											</p>
										</div>
									</div>
								</div>
								<div class="deposit-dogovor__spoiler bd-spoiler col-lg-11 offset-lg-1">
                                    <?/*?><div class="bd-spoiler__item"><?*/?>
                                    <div class="bd-spoiler__topic">
                                        <?/*?><div class="bd-spoiler__title"><?*/?>
                                        <div class="bd-spoiler__line js-spoiler--line">
											<span>Формы документов, предоставляемые клиентами для открытия брокерского счета</span>
										</div>
										<div class="bd-spoiler__content">
											<div class="document-list">
												<div class="row">
													<?$APPLICATION->IncludeComponent(
														"bitrix:news.list",
														"documents",
														Array(
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
															"CHECK_DATES" => "N",
															"DETAIL_URL" => "",
															"DISPLAY_BOTTOM_PAGER" => "N",
															"DISPLAY_DATE" => "N",
															"DISPLAY_NAME" => "N",
															"DISPLAY_PICTURE" => "N",
															"DISPLAY_PREVIEW_TEXT" => "N",
															"DISPLAY_TOP_PAGER" => "N",
															"FIELD_CODE" => array("NAME",""),
															"FILTER_NAME" => "",
															"HIDE_LINK_WHEN_NO_DETAIL" => "N",
															"IBLOCK_ID" => "187",
															"IBLOCK_TYPE" => "private_clients",
															"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
															"INCLUDE_SUBSECTIONS" => "N",
															"MESSAGE_404" => "",
															"NEWS_COUNT" => "20",
															"PAGER_BASE_LINK_ENABLE" => "N",
															"PAGER_DESC_NUMBERING" => "N",
															"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
															"PAGER_SHOW_ALL" => "N",
															"PAGER_SHOW_ALWAYS" => "N",
															"PAGER_TEMPLATE" => ".default",
															"PAGER_TITLE" => "Новости",
															"PARENT_SECTION" => "436",
															"PARENT_SECTION_CODE" => "",
															"PREVIEW_TRUNCATE_LEN" => "",
															"PROPERTY_CODE" => array("","DOCUMENTS",""),
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
													);?>
												</div>
											</div>
										</div>
									</div>
                                    <?/*?><div class="bd-spoiler__item"><?*/?>
                                    <div class="bd-spoiler__topic">
                                        <?/*?><div class="bd-spoiler__title"><?*/?>
                                        <div class="bd-spoiler__line js-spoiler--line">
											<span>Формы документов, предоставляемые клиентами для открытия ИИС</span>
										</div>
										<div class="bd-spoiler__content">
											<div class="document-list">
												<div class="row">
													<?$APPLICATION->IncludeComponent(
														"bitrix:news.list",
														"documents",
														Array(
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
															"CHECK_DATES" => "N",
															"DETAIL_URL" => "",
															"DISPLAY_BOTTOM_PAGER" => "N",
															"DISPLAY_DATE" => "N",
															"DISPLAY_NAME" => "N",
															"DISPLAY_PICTURE" => "N",
															"DISPLAY_PREVIEW_TEXT" => "N",
															"DISPLAY_TOP_PAGER" => "N",
															"FIELD_CODE" => array("NAME",""),
															"FILTER_NAME" => "",
															"HIDE_LINK_WHEN_NO_DETAIL" => "N",
															"IBLOCK_ID" => "187",
															"IBLOCK_TYPE" => "private_clients",
															"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
															"INCLUDE_SUBSECTIONS" => "N",
															"MESSAGE_404" => "",
															"NEWS_COUNT" => "20",
															"PAGER_BASE_LINK_ENABLE" => "N",
															"PAGER_DESC_NUMBERING" => "N",
															"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
															"PAGER_SHOW_ALL" => "N",
															"PAGER_SHOW_ALWAYS" => "N",
															"PAGER_TEMPLATE" => ".default",
															"PAGER_TITLE" => "Новости",
															"PARENT_SECTION" => "437",
															"PARENT_SECTION_CODE" => "",
															"PREVIEW_TRUNCATE_LEN" => "",
															"PROPERTY_CODE" => array("","DOCUMENTS",""),
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
													);?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="deposit-dogovor__tarif col-lg-10 offset-lg-1">
									<div class="row">
										<header class="col-lg-11">
											<h3 class="page-title page-title__h3">Тарифы комиссионного вознаграждения за брокерскую деятельность</h3>
										</header>
										<div class="deposit-dogovor__desc col-lg-11">
											<!--<p>Тарифы комиссионного вознаграждения за брокерскую деятельность</p>-->
										</div>
										<div class="document-list col-lg-11">
											<div class="row">
												<?$APPLICATION->IncludeComponent(
													"bitrix:news.list",
													"documents",
													Array(
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
														"CHECK_DATES" => "N",
														"DETAIL_URL" => "",
														"DISPLAY_BOTTOM_PAGER" => "N",
														"DISPLAY_DATE" => "N",
														"DISPLAY_NAME" => "N",
														"DISPLAY_PICTURE" => "N",
														"DISPLAY_PREVIEW_TEXT" => "N",
														"DISPLAY_TOP_PAGER" => "N",
														"FIELD_CODE" => array("NAME",""),
														"FILTER_NAME" => "",
														"HIDE_LINK_WHEN_NO_DETAIL" => "N",
														"IBLOCK_ID" => "187",
														"IBLOCK_TYPE" => "private_clients",
														"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
														"INCLUDE_SUBSECTIONS" => "N",
														"MESSAGE_404" => "",
														"NEWS_COUNT" => "20",
														"PAGER_BASE_LINK_ENABLE" => "N",
														"PAGER_DESC_NUMBERING" => "N",
														"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
														"PAGER_SHOW_ALL" => "N",
														"PAGER_SHOW_ALWAYS" => "N",
														"PAGER_TEMPLATE" => ".default",
														"PAGER_TITLE" => "Новости",
														"PARENT_SECTION" => "434",
														"PARENT_SECTION_CODE" => "",
														"PREVIEW_TRUNCATE_LEN" => "",
														"PROPERTY_CODE" => array("","DOCUMENTS",""),
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
												);?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<div class="container">
            <? $archiveDocs = "/chastnym-klientam/arkhiv-tarifov-i-dokumentov-individual/brokerskoe-obsluzhivanie/"; ?>
            <div class="v21-section v21-section--xs">
                <? if ($archiveDocs) { ?>
                    <div class="v21-more v21-more--side">
                        <a href="<?= $archiveDocs ?>" class="archive-section" target="_blank">
                            <span>Архив документов </span>
                            <svg class="archive-section__arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                            </svg>
                        </a>
                    </div>
                <? } ?>
            </div>

            <?/*?>
			<section class="doc-archive">
                <header class="doc-archive__header">
                    <h3 class="doc-archive__title page-title page-title__h3">
                        Архив документов
                    </h3>
                </header>
                <div class="doc-archive__wrapper">
                    <div class="row">
                        <div class="doc-archive__contract archive-contract col-md-4">
                            <div class="row">
                                <div class="col-md-11">
                                    <header class="archive-contract__header">
                                        <h4 class="archive-contract__title page-title page-title__h4">
                                            Договор на брокерское обслуживание
                                        </h4>
                                    </header>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:news.list",
                                        "documents_broker_archive",
                                        Array(
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
                                            "CHECK_DATES" => "N",
                                            "DETAIL_URL" => "",
                                            "DISPLAY_BOTTOM_PAGER" => "N",
                                            "DISPLAY_DATE" => "N",
                                            "DISPLAY_NAME" => "N",
                                            "DISPLAY_PICTURE" => "N",
                                            "DISPLAY_PREVIEW_TEXT" => "N",
                                            "DISPLAY_TOP_PAGER" => "N",
                                            "FIELD_CODE" => array("NAME",""),
                                            "FILTER_NAME" => "",
                                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                            "IBLOCK_ID" => "187",
                                            "IBLOCK_TYPE" => "private_clients",
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "INCLUDE_SUBSECTIONS" => "N",
                                            "MESSAGE_404" => "",
                                            "NEWS_COUNT" => "20",
                                            "PAGER_BASE_LINK_ENABLE" => "N",
                                            "PAGER_DESC_NUMBERING" => "N",
                                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                            "PAGER_SHOW_ALL" => "N",
                                            "PAGER_SHOW_ALWAYS" => "N",
                                            "PAGER_TEMPLATE" => ".default",
                                            "PAGER_TITLE" => "Новости",
                                            "PARENT_SECTION" => "438",
                                            "PARENT_SECTION_CODE" => "",
                                            "PREVIEW_TRUNCATE_LEN" => "",
                                            "PROPERTY_CODE" => array("","DOCUMENTS",""),
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
                                    );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    <header class="archive-contract__header">
                                        <h4 class="archive-contract__title page-title page-title__h4">
                                            Информация для получателей финансовых услуг
                                        </h4>
                                    </header>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:news.list",
                                        "documents_broker_archive",
                                        Array(
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
                                            "CHECK_DATES" => "N",
                                            "DETAIL_URL" => "",
                                            "DISPLAY_BOTTOM_PAGER" => "N",
                                            "DISPLAY_DATE" => "N",
                                            "DISPLAY_NAME" => "N",
                                            "DISPLAY_PICTURE" => "N",
                                            "DISPLAY_PREVIEW_TEXT" => "N",
                                            "DISPLAY_TOP_PAGER" => "N",
                                            "FIELD_CODE" => array("NAME",""),
                                            "FILTER_NAME" => "",
                                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                            "IBLOCK_ID" => "187",
                                            "IBLOCK_TYPE" => "private_clients",
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "INCLUDE_SUBSECTIONS" => "N",
                                            "MESSAGE_404" => "",
                                            "NEWS_COUNT" => "20",
                                            "PAGER_BASE_LINK_ENABLE" => "N",
                                            "PAGER_DESC_NUMBERING" => "N",
                                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                            "PAGER_SHOW_ALL" => "N",
                                            "PAGER_SHOW_ALWAYS" => "N",
                                            "PAGER_TEMPLATE" => ".default",
                                            "PAGER_TITLE" => "Новости",
                                            "PARENT_SECTION" => "489",
                                            "PARENT_SECTION_CODE" => "",
                                            "PREVIEW_TRUNCATE_LEN" => "",
                                            "PROPERTY_CODE" => array("","DOCUMENTS",""),
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
                                    );?>
                                </div>
                            </div>
                        </div>
                        <div class="doc-archive__contract archive-contract col-md-4">
                            <div class="row">
                                <div class="col-md-11">
                                    <header class="archive-contract__header">
                                        <h4 class="archive-contract__title page-title page-title__h4">
                                            Условия осуществления брокерской деятельности
                                        </h4>
                                    </header>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:news.list",
                                        "documents_broker_archive",
                                        Array(
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
                                            "CHECK_DATES" => "N",
                                            "DETAIL_URL" => "",
                                            "DISPLAY_BOTTOM_PAGER" => "N",
                                            "DISPLAY_DATE" => "N",
                                            "DISPLAY_NAME" => "N",
                                            "DISPLAY_PICTURE" => "N",
                                            "DISPLAY_PREVIEW_TEXT" => "N",
                                            "DISPLAY_TOP_PAGER" => "N",
                                            "FIELD_CODE" => array("NAME",""),
                                            "FILTER_NAME" => "",
                                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                            "IBLOCK_ID" => "187",
                                            "IBLOCK_TYPE" => "private_clients",
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "INCLUDE_SUBSECTIONS" => "N",
                                            "MESSAGE_404" => "",
                                            "NEWS_COUNT" => "20",
                                            "PAGER_BASE_LINK_ENABLE" => "N",
                                            "PAGER_DESC_NUMBERING" => "N",
                                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                            "PAGER_SHOW_ALL" => "N",
                                            "PAGER_SHOW_ALWAYS" => "N",
                                            "PAGER_TEMPLATE" => ".default",
                                            "PAGER_TITLE" => "Новости",
                                            "PARENT_SECTION" => "439",
                                            "PARENT_SECTION_CODE" => "",
                                            "PREVIEW_TRUNCATE_LEN" => "",
                                            "PROPERTY_CODE" => array("DOCUMENTS",""),
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
                                    );?>
                                </div>
                            </div>
                        </div>
                        <div class="doc-archive__contract archive-contract col-md-4">
                            <div class="row">
                                <div class="col-md-11">
                                    <header class="archive-contract__header">
                                        <h4 class="archive-contract__title page-title page-title__h4">
                                            Политика совершения операций за счёт клиентов АКБ «Трансстройбанк» (АО)
                                        </h4>
                                    </header>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:news.list",
                                        "documents_broker_archive",
                                        Array(
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
                                            "CHECK_DATES" => "N",
                                            "DETAIL_URL" => "",
                                            "DISPLAY_BOTTOM_PAGER" => "N",
                                            "DISPLAY_DATE" => "N",
                                            "DISPLAY_NAME" => "N",
                                            "DISPLAY_PICTURE" => "N",
                                            "DISPLAY_PREVIEW_TEXT" => "N",
                                            "DISPLAY_TOP_PAGER" => "N",
                                            "FIELD_CODE" => array("NAME",""),
                                            "FILTER_NAME" => "",
                                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                            "IBLOCK_ID" => "187",
                                            "IBLOCK_TYPE" => "private_clients",
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "INCLUDE_SUBSECTIONS" => "N",
                                            "MESSAGE_404" => "",
                                            "NEWS_COUNT" => "20",
                                            "PAGER_BASE_LINK_ENABLE" => "N",
                                            "PAGER_DESC_NUMBERING" => "N",
                                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                            "PAGER_SHOW_ALL" => "N",
                                            "PAGER_SHOW_ALWAYS" => "N",
                                            "PAGER_TEMPLATE" => ".default",
                                            "PAGER_TITLE" => "Новости",
                                            "PARENT_SECTION" => "440",
                                            "PARENT_SECTION_CODE" => "",
                                            "PREVIEW_TRUNCATE_LEN" => "",
                                            "PROPERTY_CODE" => array("DOCUMENTS",""),
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
                                    );?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</section>
            <?*/?>
		</div>
	</div>
	<script src="/assets/js/script-broker-deposit.js?v=1.0.4"></script>
<?
}
?>

<script>
    $(document).ready(function () {
        $('.js-spoiler--line').click(function () {
            let $this = $(this);
            $this.toggleClass('bd-spoiler__line--active');
            $this.next('.bd-spoiler__content').toggle(600);
        });
    });
</script>

<?/*$APPLICATION->IncludeComponent(
    "webtu:subscribe",
    ".default",
    array(
        "AJAX_MODE" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "RUBRIC" => array(
            0 => "1",
        )
    ),
    false
);*/?>


