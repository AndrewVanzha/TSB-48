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
$init_curr = '';
if ($_GET['q']) {
    $init_curr = htmlspecialchars(trim($_GET['q']));
}
$counter_init = 0;
foreach ($arResult["PROPERTIES"]["MONEY_CURRENCY"]["VALUE"] as $key => $currency) {
    if ($currency == $init_curr) {
        $counter_init = $key;
    }
}
?>

<h1 class="v21-h1" id="VKLAD_NAME"><?= $arResult['NAME'] ?></h1>

<div class="v21-section v21-section--sm js-v21-tabs">
    <div class="v21-deposit-tabs">
        <div class="v21-deposit-tabs__city v21-tabs-header js-v21-tabs-header">
            <button class="v21-tabs-header__nav v21-tabs-header__nav--next js-v21-tabs-header-next"></button>
            <button class="v21-tabs-header__nav v21-tabs-header__nav--prev js-v21-tabs-header-prev"></button>
            <div class="js-v21-tabs-header-slider">
                <? foreach ($arResult["SECTIONS"] as $key => $section) { ?>
                    <div>
                        <a href="<?= $section["SRC"] ?>" data-slide="<?= $key ?>" class="v21-tabs-header__item <?= $arResult["IBLOCK_SECTION_ID"] == $key ? " is-active" : "" ?>" <?= $APPLICATION->GetCurPage(false) == $section["SRC"] ? 'onclick="return false;"' : '' ?>>
                            <?= $section["NAME"] ?>
                        </a>
                    </div>
                <? } ?>
            </div><!-- /.js-v21-tabs-header-slider -->
        </div><!-- /.v21-deposit-tabs__city -->

        <div class="v21-deposit-tabs__currency v21-tabs-header js-v21-tabs-header">
            <button class="v21-tabs-header__nav v21-tabs-header__nav--next js-v21-tabs-header-next"></button>
            <button class="v21-tabs-header__nav v21-tabs-header__nav--prev js-v21-tabs-header-prev"></button>
            <div class="js-v21-tabs-header-slider">
                <? $counter = 0; ?>
                <? foreach ($arResult["PROPERTIES"]["MONEY_CURRENCY"]["VALUE"] as $key => $currency) { ?>
                    <div>
                        <a href="#" data-tab-id="currency<?= $key ?>" data-tab-group="currency" data-slide="<?= $key ?>" class="v21-tabs-header__item js-v21-tabs-header-item js-v21-tabs-toggle<?= $key == $counter_init ? " is-active" : "" ?>">
                            <?= $currency ?>
                        </a>
                    </div>
                    <? $counter++; ?>
                <? } ?>
            </div><!-- /.js-v21-tabs-header-slider -->
        </div><!-- /.v21-deposit-tabs__currency -->
    </div><!-- /.v21-deposit-tabs -->

    <div class="v21-tabs-content"><?= $arResult["PREVIEW_TEXT"] ?></div>
</div>

<? if ($arResult["PROPERTIES"]["OPTIONS"]["VALUE"][0]) { ?>
    <div class="v21-section">
        <h3 class="v21-section__subtitle v21-h5">Основные опции</h3>
        <ul class="v21-deposit-features v21-ul">
            <? foreach ($arResult["PROPERTIES"]["OPTIONS"]["VALUE"] as $option) {
            ?>
                <li><?= $option ?></li>
            <?
            } ?>
        </ul><!-- /.v21-deposit-features -->
    </div><!-- /.v21-section -->
<? } ?>

<? $APPLICATION->IncludeComponent(
    "webtu:feedback",
    "v21_vklad_detail",
    array(
        "ADMIN_EVENT" => "WEBTU_FEEDBACK_DEPOSIT_ADMINISTRATOR",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "IBLOCK_ID" => "32",
        "PROPERTIES" => array("BIRTHDATE", "SEX", "PHONE", "EMAIL", "CITY", "CITYZENSHIP", "CURRENCY", "SUM", "CREDIT_NAME","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
        "SITES" => array("s1"),
        "USER_EVENT" => "WEBTU_FEEDBACK_DEPOSIT_USER",
        "EVENT_CALLBACK" => function ($post) {
            if ($post['SEX'] == 'Мужской') {
                $post['RECOURSE'] = 'Уважаемый';
            } else {
                $post['RECOURSE'] = 'Уважаемая';
            }
            return $post;
        },
        "POST_CALLBACK" => function ($post) {
            if (!isset($post['CITYZENSHIP'])) {
                $post['CITYZENSHIP'] = 'Нет';
            } else {
                $post['CITYZENSHIP'] = 'Да';
            }
            if (!empty($post['FIRST_NAME'])) {
                $post['NAME'] = $post['LAST_NAME'] . ' ' . $post['FIRST_NAME'] . ' ' . $post['SECOND_NAME'];
            }
            return $post;
        },
        "UTM" => "100",

    )
); ?>

<? if ($arResult["DETAIL_TEXT"]) { ?>
    <div class="v21-section v21-section--border v21-section--sm">
        <div class="v21-deposit-description v21-content">
            <?= $arResult["DETAIL_TEXT"] ?>
        </div>
    </div>
<? } ?>

<? if (count($arResult["PROPERTIES"]["DOCS"]["VALUE"]) > 0 || count($arResult["GENERAL_DOCS"]) > 0) { ?>
    <div class="v21-section">
        <h2 class="v21-section__subtitle v21-h6">Документы</h2>
        <div class="v21-grid">
            <? foreach ($arResult["PROPERTIES"]["DOCS"]["VALUE"] as $key => $document) { ?>
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <a href="<?= CFile::GetPath($document) ?>" class="v21-document v21-link" target="_blank">
                        <div class="v21-document__title">
                            <?= $arResult["PROPERTIES"]["DOCS"]["DESCRIPTION"][$key] ?>
                        </div>
                        <div class="v21-document__download">
                            <span class="v21-link__text">Скачать</span>
                            <svg width="11" height="12" class="v21-document__download-icon">
                                <use xlink:href="img/v21_v21-icons.svg#download"></use>
                            </svg>
                        </div>
                    </a><!-- /.v21-document -->
                </div><!-- /.v21-grid__item -->
            <? } ?>

            <? foreach ($arResult["GENERAL_DOCS"] as $key => $document) { ?>
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <a href="<?= $document["SRC"] ?>" class="v21-document v21-link" target="_blank">
                        <div class="v21-document__title">
                            <?= $document["NAME"] ?>
                        </div>
                        <div class="v21-document__download">
                            <span class="v21-link__text">Скачать</span>
                            <svg width="11" height="12" class="v21-document__download-icon">
                                <use xlink:href="img/v21_v21-icons.svg#download"></use>
                            </svg>
                        </div>
                    </a><!-- /.v21-document -->
                </div><!-- /.v21-grid__item -->
            <? } ?>

        </div><!-- /.v21-grid -->
        <? $archiveDocs = $arResult["PROPERTIES"]["ARCHIVE_DOCUMENTS"]["VALUE"] ?>
        <? if ($archiveDocs) { ?>
            <div class="v21-more v21-more--side">
                <?/*?><a href="<?= $archiveDocs ?>" class="v21-button v21-button--border" target="_blank">Архив документов</a><?*/?>

                <div class="rko-doc__all">
                    <a href="<?= $archiveDocs ?>" class="rko-doc__all--link-button">
                        <span>Архив тарифов и документов</span>
                    </a>
                    <a href="<?= $archiveDocs ?>" target="_blank" class="rko-doc__all--link-details">
                        <!--span>Подробнее </span-->
                        <svg class="rko-doc__all--link-arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                            <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                        </svg>
                    </a>
                </div>
            </div>
        <? } ?>
    </div><!-- /.v21-section -->
<? } ?>

<script>
    $(document).ready(function () {
        if("<?=$init_curr?>" == 'CNY') {
            let select_currency = $(document.querySelector('.v21-deposit-tabs__currency')).find('.js-v21-tabs-header-item.is-active');
            let active_currency_data = $(select_currency).data('tab-id');
            let tab = document.querySelector('.v21-tabs-content');
            //let tabs = tab.querySelectorAll('.v21-tabs-content__item');
            tab.querySelectorAll('.v21-tabs-content__item').forEach(function (elem) {
                $(elem).removeClass('is-active');
                if($(elem).data('tab-id') == active_currency_data) {
                    $(elem).addClass('is-active');
                }
            });
        }
    });
</script>

