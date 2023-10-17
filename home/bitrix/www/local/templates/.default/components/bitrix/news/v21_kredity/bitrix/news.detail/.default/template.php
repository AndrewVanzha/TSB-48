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
?>

<h1 class="v21-h1-new"><?//= $arResult['PROPERTIES']['SUBTITLE']['~VALUE'] ?><?= $arResult['NAME'] ?></h1>
<?//debugg($arResult); ?>
<div class="v21-section v21-section--border">
    <div class="v21-intro-card v21-intro-card--credit-2">
        <div class="v21-intro-card__image">
            <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult['NAME'] ?>">
        </div><!-- /.intro-card__image -->
        <div class="v21-intro-card__content">
            <div class="v21-credit-stats v21-grid">

                <? if ($arResult["PROPERTIES"]["MAX_SUM"]["VALUE"]) { ?>
                    <div class="v21-credit-stats__item v21-grid__item v21-grid__item--1x2@sm">
                        <div>сумма кредита</div>
                        <div class="v21-credit-stats__value"><?= $arResult["PROPERTIES"]["MAX_SUM"]["VALUE"] ?></div>
                    </div><!-- /.v21-credit-stats__item -->
                <? } ?>
                <? if ($arResult["PROPERTIES"]["INTEREST_RATE"]["VALUE"]) { ?>
                    <div class="v21-credit-stats__item v21-grid__item v21-grid__item--1x2@sm">
                        <div>% ставка</div>
                        <div class="v21-credit-stats__value"><?= $arResult["PROPERTIES"]["INTEREST_RATE"]["VALUE"] ?></div>
                    </div><!-- /.v21-credit-stats__item -->
                <? } ?>
                <? if ($arResult["PROPERTIES"]["MAX_DATE"]["VALUE"]) { ?>
                    <div class="v21-credit-stats__item v21-grid__item v21-grid__item--1x2@sm">
                        <div>срок кредита</div>
                        <div class="v21-credit-stats__value"><?= $arResult["PROPERTIES"]["MAX_DATE"]["VALUE"] ?></div>
                    </div><!-- /.v21-credit-stats__item -->
                <? } ?>
                <? if ($arResult["PROPERTIES"]["ATT_CURRENCY"]["VALUE"][0]) { ?>
                    <div class="v21-credit-stats__item v21-grid__item v21-grid__item--1x2@sm">
                        <div>валюта</div>
                        <div class="v21-credit-stats__value"><?= implode(", ", $arResult["PROPERTIES"]["ATT_CURRENCY"]["VALUE"]) ?></div>
                    </div><!-- /.v21-credit-stats__item -->
                <? } ?>
            </div><!-- /.v21-credit-stats -->
        </div><!-- /.v21-intro-card__content -->
    </div><!-- /.v21-intro-card -->
</div><!-- /.v21-section -->

<div class="v21-section v21-section--border">
    <h2 class="v21-section__title v21-h2">Требования к заемщику</h2>
    <div class="v21-benefits v21-benefits--credit-1">
        <div class="v21-benefits__grid v21-grid">
            <? foreach ($arResult["PROPERTIES"]["BORROWER_REQUIREMENTS"]["VALUE"] as $key => $item) { ?>
                <?if($item !='Страховой полис залога' && $item != 'Предмет залога') :         // закомментированы две позиции ?>
                <div class="v21-benefits__grid-item v21-grid__item v21-grid__item--1x2@sm">
                    <div class="v21-benefits__item">
                        <? if ($arResult["PROPERTIES"]["BORROWER_REQUIREMENTS_ICONS"]["VALUE"][$key]) {
                        ?>
                            <img src="<?= CFile::GetPath($arResult["PROPERTIES"]["BORROWER_REQUIREMENTS_ICONS"]["VALUE"][$key]) ?>" alt="<?= $item ?>" class="v21-benefits__image">
                        <?
                        } ?>
                        <div class="v21-benefits__text">
                            <h3 class="v21-benefits__title v21-h6"><?= $item ?></h3>
                            <p class="v21-benefits__brief v21-p"><?= $arResult["PROPERTIES"]["BORROWER_REQUIREMENTS"]["DESCRIPTION"][$key] ?></p>
                        </div>
                    </div><!-- .v21-benefits__item -->
                </div> <!-- /.v21-benefits__grid-item -->
                <?endif; ?>
            <? } ?>
        </div><!-- /.v21-benefits__grid -->
    </div><!-- /.v21-benefits -->
</div><!-- /.v21-section -->

<div class="v21-section">
    <h2 class="v21-section__title v21-h2">Перечень основных документов</h2>
    <div class="v21-benefits v21-benefits--credit-2">
        <ol class="v21-benefits__grid v21-grid">
            <? foreach ($arResult["PROPERTIES"]["LIST_DOCUMENTS"]["VALUE"] as $key => $item) { ?>
                <!--li class="v21-benefits__grid-item v21-grid__item v21-grid__item--1x2@md"-->
                <li class="v21-benefits__grid-item v21-grid__item v21-grid__item--1x2@md v21-grid__item--1x3@lg v21-benefits__grid-item--docs">
                    <div class="v21-benefits__item">
                        <div class="v21-benefits__text">
                            <h3 class="v21-benefits__title v21-h6"><?= $item ?></h3>
                            <p class="v21-benefits__brief v21-p"><?= $arResult["PROPERTIES"]["LIST_DOCUMENTS"]["DESCRIPTION"][$key] ?></p>
                        </div>
                    </div><!-- .v21-benefits__item -->
                </li> <!-- /.v21-benefits__grid-item -->
            <? } ?>
        </ol><!-- /.v21-benefits__grid -->
    </div><!-- /.v21-benefits -->
</div><!-- /.v21-section -->

<div class="v21-section">
    <div class="v21-credit-note__header v21-h2">Офисы Трансстройбанка для оформления кредита</div>
    <div class="v21-credit-note__container v21-grid">
        <? foreach ($arResult["CREDIT_OFFICES"] as $key => $arOffice) : ?>
            <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                <div class="v21-credit-note__block">
                    <a class="v21-credit-note__block--title" href="<?= $arOffice[0]["DETAIL_PAGE_URL"] ?>"><?= $arOffice[0]["SECTION"]["NAME"] ?></a>
                    <a class="v21-credit-note__block--line" href="<?= $arOffice[0]["DETAIL_PAGE_URL"] ?>">
                        <span class="block-line-1"><?= $arOffice[1]["ATT_ADDRESS"]["VALUE"] ?></span>
                        <span class="block-line-2"><?= $arOffice[1]["ATT_MODE"]["VALUE"] ?> | <?= $arOffice[1]["ATT_PHONE"]["VALUE"] ?></span>
                    </a>
                    <div class="v21-credit-note__block--line-geobox">
                        <a class="v21-credit-note__block--line-geobox--show v21-yandex-map" href="<?= $arOffice[1]["ATT_YANDEX_LOCATION"]["VALUE"] ?>" target="_blank">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" viewBox="0 0 20 25" fill="none">
<path d="M9.62563 0.00292969C4.3094 0.00292969 0 4.31233 0 9.62856C0 12.2857 1.07663 14.6916 2.8179 16.4334C4.55966 18.1761 8.66307 20.698 8.90371 23.3451C8.93979 23.742 9.22713 24.067 9.62563 24.067C10.0241 24.067 10.3115 23.742 10.3476 23.3451C10.5882 20.698 14.6916 18.1761 16.4334 16.4334C18.1746 14.6916 19.2513 12.2857 19.2513 9.62856C19.2513 4.31233 14.9419 0.00292969 9.62563 0.00292969Z" fill="#C5AE7C"/>
<path d="M9.62581 12.9977C11.4864 12.9977 12.9947 11.4894 12.9947 9.62874C12.9947 7.7681 11.4864 6.25977 9.62581 6.25977C7.76519 6.25977 6.25684 7.7681 6.25684 9.62874C6.25684 11.4894 7.76519 12.9977 9.62581 12.9977Z" fill="white"/>
                                </svg>
                            </span>
                            <span>Яндекс.Карты</span>
                        </a>
                        <a class="v21-credit-note__block--line-geobox--show v21-2gis-map" href="<?= $arOffice[1]["ATT_2GIS_LOCATION"]["VALUE"] ?>" target="_blank">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
<circle cx="11.6262" cy="12.0349" r="8.5149" fill="white"/>
<path d="M17.2453 14.3223C13.0619 14.3436 12.3852 16.9606 12.1596 19.1734L12.0571 20.1521H11.2163L11.1138 19.1734C10.8882 16.9606 10.191 14.3436 6.15109 14.3223C5.47437 12.8754 5.18728 11.7052 5.18728 10.386C5.18728 7.0882 7.79167 4.00297 11.6469 4.00297C15.5022 4.00297 18.0656 7.06681 18.0656 10.4074C18.0656 11.7052 17.9426 12.8754 17.2453 14.3223ZM11.606 0.00292969C5.24885 0.00292969 0.0400391 5.40729 0.0400391 12.0243C0.0400391 18.6627 5.24885 24.067 11.606 24.067C18.0246 24.067 23.2129 18.6627 23.2129 12.0243C23.2129 5.40731 18.0246 0.00292969 11.606 0.00292969Z" fill="white"/>
<path d="M17.2453 14.3223C13.0619 14.3436 12.3852 16.9606 12.1596 19.1734L12.0571 20.1521H11.2163L11.1138 19.1734C10.8882 16.9606 10.191 14.3436 6.15109 14.3223C5.47437 12.8754 5.18728 11.7052 5.18728 10.386C5.18728 7.0882 7.79167 4.00297 11.6469 4.00297C15.5022 4.00297 18.0656 7.06681 18.0656 10.4074C18.0656 11.7052 17.9426 12.8754 17.2453 14.3223ZM11.606 0.00292969C5.24885 0.00292969 0.0400391 5.40729 0.0400391 12.0243C0.0400391 18.6627 5.24885 24.067 11.606 24.067C18.0246 24.067 23.2129 18.6627 23.2129 12.0243C23.2129 5.40731 18.0246 0.00292969 11.606 0.00292969Z" fill="#C5AE7C"/>
                                </svg>
                            </span>
                            <span>2ГИС</span>
                        </a>
                    </div>
                    <div class="v21-credit-note__block--double"></div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>

<?/*?>
<div class="v21-section">
    <div class="v21-credit-note">
        <div class="v21-credit-note__container">
            <div class="v21-credit-note__grid v21-grid">
                <div class="v21-credit-note__grid-item v21-grid__item v21-grid__item--1x2@lg">
                    <div class="v21-credit-note__text">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-benefit-6.png" alt="" class="v21-credit-note__icon">
                        <h3 class="v21-credit-note__titl v21-h6">Кредит оформляется только в следующих офисах Трансстройбанка</h3>
                    </div>
                </div><!-- /.v21-credit-note__grid-item -->
                <div class="v21-credit-note__grid-item v21-grid__item v21-grid__item--1x2@lg">
                    <div class="">
<p><a href="/ofisy-i-bankomaty/tsentralnyy-ofis/" target="_blank">Центральный офис АКБ "Трансстройбанк" (АО): 115093, г. Москва, ул. Дубининская, д. 94 </a></p>
<p><a href="/ofisy-i-bankomaty/kko-v-g-kazan/" target="_blank">Дополнительный офис в г. Казани АКБ "Трансстройбанк" (АО): 420111, Республика Татарстан, г. Казань, ул. Карла Маркса, д. 59 </a></p>
<p><a href="/ofisy-i-bankomaty/dopolnitelnyy-ofis-v-g-kaliningrad/" target="_blank">Дополнительный офис в г. Калининград АКБ "Трансстройбанк" (АО): 236022,  Калининградская область, г. Калининград, пер. Кирова, д. 2, пом. IV </a></p>
<p><a href="/ofisy-i-bankomaty/operatsionnyy-ofis-v-g-lipetsk/" target="_blank">Операционный офис в г. Липецк АКБ "Трансстройбанк" (АО): 398000, Липецкая область, г. Липецк, ул. Гагарина, д. 35 </a></p>
<p><a href="/ofisy-i-bankomaty/kreditno-kassovyy-ofis-34-gorkovskiy-34-v-g-nizhniy-novgorod/" target="_blank">Дополнительный офис "Горьковский" в г. Нижний Новгород АКБ "Трансстройбанк" (АО): 603000, Нижегородская область, г. Нижний Новгород, ул. Студеная, д. 5 </a></p>
<p><a href="/ofisy-i-bankomaty/-kko-v-g-perm/" target="_blank">Дополнительный офис в г. Пермь АКБ "Трансстройбанк" (АО): 614007, Пермский край, г. Пермь, ул. Тимирязева, д. 24а </a></p>
<p><a href="/ofisy-i-bankomaty/dopolnitelnyy-ofis-v-g-tuapse/" target="_blank">Дополнительный офис в г. Туапсе АКБ "Трансстройбанк" (АО): 352800, Краснодарский край, г. Туапсе, ул. Октябрьской Революции, д. 7</a></p>
                    </div>
                    <?/*?>
                    <a href="/ofisy-i-bankomaty/" class="v21-credit-note__button v21-button v21-button--border">Адреса офисов</a>
					<?*/?><?/*
                </div><!-- /.v21-credit-note__grid-item -->
            </div><!-- /.v21-credit-note__grid -->
        </div><!-- /.v21-credit-note__container -->
    </div><!-- /.v21-credit-note -->
</div><!-- /.v21-section -->
<?*/?>

<? $archiveDocs = $arResult["PROPERTIES"]["ARCHIVE_DOCUMENTS"]["VALUE"] ?>
<? if ($arResult["PROPERTIES"]["DOCS"]["VALUE"][0] || $archiveDocs) { ?>
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

        </div><!-- /.v21-grid -->
        <? if ($archiveDocs) { ?>
            <div class="v21-more v21-more--side">
                <a href="<?= $archiveDocs ?>" class="v21-button v21-button--border" target="_blank">Архив документов</a>
            </div>
        <? } ?>
        <? if(!empty($arResult["PROPERTIES"]["DOCS_SPECIAL"]["VALUE"])) : ?>
            <h2 class="v21-section__subtitle v21-h6 v21-more">Информация, подлежащая обязательному раскрытию в соответствии с Федеральным законом от 21.12.2013 № 353-ФЗ «О потребительском кредите (займе)»</h2>
        <? endif; ?>
        <div class="v21-grid">
            <? foreach ($arResult["PROPERTIES"]["DOCS_SPECIAL"]["VALUE"] as $key => $document) { ?>
                <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                    <a href="<?= CFile::GetPath($document) ?>" class="v21-document v21-link" target="_blank">
                        <div class="v21-document__title">
                            <?= $arResult["PROPERTIES"]["DOCS_SPECIAL"]["DESCRIPTION"][$key] ?>
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
    </div><!-- /.v21-section -->
<? } ?>