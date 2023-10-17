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
<?// debugg($arResult); ?>
<div class="v21-section">
    <h2 class="v21-h2-new v21-credit-note__header">Офисы Трансстройбанка для оформления депозита</h2>
    <div class="v21-credit-note__container v21-grid">
        <? foreach ($arResult["DEPOSIT_OFFICES"] as $key => $arOffice) : ?>
            <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                <div class="v21-credit-note__block">
                    <a class="v21-credit-note__block--title" href="<?= $arOffice['FIELDS']['DETAIL_PAGE_URL'] ?>"><?= $arOffice['FIELDS']['SECTION']['NAME'] ?></a>
                    <a class="v21-credit-note__block--line" href="<?= $arOffice['FIELDS']['DETAIL_PAGE_URL'] ?>">
                        <span class="block-line-1"><?= $arOffice['PROPS']['ATT_ADDRESS']['VALUE'] ?></span>
                        <span class="block-line-2"><?= $arOffice['PROPS']['ATT_MODE']['VALUE'] ?> | <?= $arOffice['PROPS']['ATT_PHONE']['VALUE'] ?></span>
                    </a>
                    <div class="v21-credit-note__block--line-geobox">
                        <a class="v21-credit-note__block--line-geobox--show v21-yandex-map" href="<?= $arOffice['PROPS']['ATT_YANDEX_LOCATION']['VALUE'] ?>" target="_blank">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" viewBox="0 0 20 25" fill="none">
<path d="M9.62563 0.00292969C4.3094 0.00292969 0 4.31233 0 9.62856C0 12.2857 1.07663 14.6916 2.8179 16.4334C4.55966 18.1761 8.66307 20.698 8.90371 23.3451C8.93979 23.742 9.22713 24.067 9.62563 24.067C10.0241 24.067 10.3115 23.742 10.3476 23.3451C10.5882 20.698 14.6916 18.1761 16.4334 16.4334C18.1746 14.6916 19.2513 12.2857 19.2513 9.62856C19.2513 4.31233 14.9419 0.00292969 9.62563 0.00292969Z" fill="#C5AE7C"/>
<path d="M9.62581 12.9977C11.4864 12.9977 12.9947 11.4894 12.9947 9.62874C12.9947 7.7681 11.4864 6.25977 9.62581 6.25977C7.76519 6.25977 6.25684 7.7681 6.25684 9.62874C6.25684 11.4894 7.76519 12.9977 9.62581 12.9977Z" fill="white"/>
                                </svg>
                            </span>
                            <span>Яндекс.Карты</span>
                        </a>
                        <a class="v21-credit-note__block--line-geobox--show v21-2gis-map" href="<?= $arOffice['PROPS']['ATT_2GIS_LOCATION']['VALUE'] ?>" target="_blank">
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
