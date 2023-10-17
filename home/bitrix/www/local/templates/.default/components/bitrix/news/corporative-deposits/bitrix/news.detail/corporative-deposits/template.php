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
<?//debugg($arResult)?>
<h2 class="v21-h2-new v21-deposits--subheader">Условия банковского депозита «БИЗНЕС»</h2>
<section class="detail-section">
    <table class="v21-table">
        <tr class="v21-table__heading">
            <td class="detail-table--cell-3r" rowspan="3"><span>Срок депозита</span></td>
            <td class="detail-table--cell-head" colspan="8"><span>Валюта / Минимальная сумма взноса в депозит / Опции</span></td>
        </tr>
        <tr class="v21-table__heading">
            <td class="detail-table--cell-head" colspan="4">Рубли</td>
            <td class="detail-table--cell-head" colspan="4">Юани</td>
        </tr>
        <tr class="v21-table__heading">
            <td class="detail-table--cell">Сумма</td>
            <? foreach ($arResult['PROPERTIES']['ADD_DEPOSIT_OPTION']['~VALUE'] as $option) : ?>
                <td class="detail-table--cell"><?=$option?></td>
            <? endforeach; ?>
            <td class="detail-table--cell">Сумма</td>
            <? foreach ($arResult['PROPERTIES']['ADD_DEPOSIT_OPTION']['~VALUE'] as $option) : ?>
                <td class="detail-table--cell"><?=$option?></td>
            <? endforeach; ?>
        </tr>
        <? $tt = 1; ?>
        <? foreach ($arResult['PROPERTIES']['ADD_DEPOSIT_PERIOD']['~VALUE'] as $period) : ?>
            <? $deposit_code_1 = 'ADD_DEPOSIT_' . $tt . '1'; ?>
            <? $deposit_code_2 = 'ADD_DEPOSIT_' . $tt . '2'; ?>
            <tr class="detail-table--body">
                <td class="v21-table__cell-1b">
                    <div class="v21-table__caption v21-table__title">Срок взноса</div>
                    <div class="v21-table__content">
                        <div class="v21-table__caption v21-table__note v21-table__value"><?=$period?></div>
                    </div>
                </td>
                <td class="detail-table--cell-2r" rowspan="2"><?=$period?></td>
                <td class="v21-table__cell-1b">
                    <div class="v21-table__caption v21-table__title">Сумма взноса / процент</div>
                </td>
                <td class="detail-table--cell"><?=$arResult['PROPERTIES']['ADD_DEPOSIT_SUM_RUB_1']['~VALUE']?></td>
                <? foreach ($arResult['PROPERTIES'][$deposit_code_1]['~VALUE'] as $percent) :
                    $symbol_pos = strpos($percent, '/');
                    if ($symbol_pos == false) : ?>
                        <td class="detail-table--cell">
                            <div class="v21-table__content">-</div>
                        </td>
                    <? else: ?>
                        <td class="detail-table--cell">
                            <div class="v21-table__content">
                                <div class="v21-table__caption v21-table__title"><?=$arResult['PROPERTIES']['ADD_DEPOSIT_OPTION']['~VALUE'][$tt-1]?></div>
                                <div><?= trim(substr($percent, 0, $symbol_pos)) ?></div>
                            </div>
                        </td>
                    <? endif; ?>
                <? endforeach; ?>
                <td class="v21-table__cell-1b">
                    <div class="v21-table__caption v21-table__title">Сумма взноса / процент</div>
                </td>
                <td class="detail-table--cell"><?=$arResult['PROPERTIES']['ADD_DEPOSIT_SUM_CNY_1']['~VALUE']?></td>
                <? foreach ($arResult['PROPERTIES'][$deposit_code_1]['~VALUE'] as $percent) :
                    $symbol_pos = strpos($percent, '/');
                    if ($symbol_pos == false) : ?>
                        <td class="detail-table--cell">
                            <div class="v21-table__content">-</div>
                        </td>
                    <? else: ?>
                        <td class="detail-table--cell">
                            <div class="v21-table__content">
                                <div class="v21-table__caption v21-table__title"><?=$arResult['PROPERTIES']['ADD_DEPOSIT_OPTION']['~VALUE'][$tt-1]?></div>
                                <div><?= trim(substr($percent,  $symbol_pos+1)) ?></div>
                            </div>
                        </td>
                    <? endif; ?>
                <? endforeach; ?>
            </tr>
            <tr class="detail-table--body">
                <td class="v21-table__cell-1b">
                    <div class="v21-table__caption v21-table__title">Сумма взноса / процент</div>
                </td>
                <td class="detail-table--cell"><?=$arResult['PROPERTIES']['ADD_DEPOSIT_SUM_RUB_2']['~VALUE']?></td>
                <? foreach ($arResult['PROPERTIES'][$deposit_code_2]['~VALUE'] as $percent) :
                    $symbol_pos = strpos($percent, '/');
                    if ($symbol_pos == false) : ?>
                        <td class="detail-table--cell">
                            <div class="v21-table__content">-</div>
                        </td>
                    <? else: ?>
                        <td class="detail-table--cell">
                            <div class="v21-table__content">
                                <div class="v21-table__caption v21-table__title"><?=$arResult['PROPERTIES']['ADD_DEPOSIT_OPTION']['~VALUE'][$tt-1]?></div>
                                <div><?= trim(substr($percent, 0, $symbol_pos)) ?></div>
                            </div>
                        </td>
                    <? endif; ?>
                <? endforeach; ?>
                <td class="v21-table__cell-1b">
                    <div class="v21-table__caption v21-table__title">Сумма взноса / процент</div>
                </td>
                <td class="detail-table--cell"><?=$arResult['PROPERTIES']['ADD_DEPOSIT_SUM_CNY_2']['~VALUE']?></td>
                <? foreach ($arResult['PROPERTIES'][$deposit_code_2]['~VALUE'] as $percent) :
                    $symbol_pos = strpos($percent, '/');
                    if ($symbol_pos == false) : ?>
                        <td class="detail-table--cell">
                            <div class="v21-table__content">-</div>
                        </td>
                    <? else: ?>
                        <td class="detail-table--cell">
                            <div class="v21-table__content">
                                <div class="v21-table__caption v21-table__title"><?=$arResult['PROPERTIES']['ADD_DEPOSIT_OPTION']['~VALUE'][$tt-1]?></div>
                                <div><?= trim(substr($percent,  $symbol_pos+1)) ?></div>
                            </div>
                        </td>
                    <? endif; ?>
                <? endforeach; ?>
            </tr>
            <? $tt += 1; ?>
        <? endforeach; ?>
    </table>
</section>

<section class="page-section dopdetail-section">

	<article class="content-area clearfix">

		<? if (!empty($arResult['DETAIL_PICTURE']['SRC'])) {?>
            <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="" class="content-area_image">
        <? } ?>

		<div class="content-area_text">

			<?=$arResult['DETAIL_TEXT']?>

            <?/*?>
			</br></br>
            <div class="deposit-item--control">
                <a href="#fDepositForm" class="v21-plastic-card__controls-order v21-button js-fDepositForm" data-item="<?=$arItem['ID']?>">Оставить заявку</a>
            </div>
            <?*/?>
			<?/*?><a href="#depositLegal" data-fancybox="" class="button">Открыть вклад</a><?*/?>

		</div>

	</article>

</section>
