<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<? $previousLevel = 0; ?>
    <? $subheader_count = 1; ?>
	<ul class="v21-header__mid-nav <?= $arParams["TYPE_MENU"] ?? "" ?>">
		<? foreach ($arResult as $arItem) : ?>
			<?
			if (mb_substr($arItem["LINK"], 0, 1) !== '/') {
				$target = 'target="_blank"';
			} else {
				$target = '';
			}
			?>
			<? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) : ?>
				<?= str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
			<? endif ?>
			<? if ($arItem["IS_PARENT"]) : ?>
				<li class="v21-header__mid-nav-item js-v21-header__mid-nav-item">
                    <a href="<?=$arItem['LINK']?>" class="v21-header__mid-nav-link<?= $arItem["SELECTED"] ? " is-active" : "" ?>">
						<?= $arItem["TEXT"] ?>
					</a>
					<div class="v21-header__bot-nav v21-fade">

                        <div class="v21-header__bot-nav-wrap">
						<ul class="v21-header__bot-nav-list">
						<? else : ?>

							<? if ($arItem["PERMISSION"] > "D") : ?>

								<? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
									<li class="v21-header__mid-nav-item">
										<a href="<?= $arItem["LINK"] ?>" class="v21-header__mid-nav-link<?= $arItem["SELECTED"] ? " is-active" : "" ?>" <?= $target ?>><?= $arItem["TEXT"] ?></a>
									</li>
								<? else : ?>
                                    <? if ($arItem["PARAMS"]['subheader']) : ?>
                                        <? if ($arItem["PARAMS"]['subblock'] == 'start' && $arItem["PARAMS"]['subgroup'] == 1) : ?>
                                            <div class="v21-column v21-column-<?=$arItem["PARAMS"]['subgroup']?>">
                                        <? endif; ?>
                                        <? if ($arItem["PARAMS"]['subblock'] == 'start' && $arItem["PARAMS"]['subgroup'] == 3) : ?>
                                            <div class="v21-column v21-column-<?=$arItem["PARAMS"]['subgroup']?>">
                                        <? endif; ?>
                                        <? if ($arItem["PARAMS"]['subblock'] == 'start') : ?>
                                            <div class="subblock subblock-<?=$arItem["PARAMS"]['subgroup']?>">
                                            <div class="subblock__verline verline-<?=$arItem["PARAMS"]['subgroup']?>"></div>
                                            <div class="subblock-title"><?= $arItem["TEXT"] ?></div>
                                            <div class="subblock__horline horline-<?=$arItem["PARAMS"]['subgroup']?>"></div>
                                        <? endif; ?>
                                    <? elseif ($arItem["PARAMS"]['subblock'] == 'end') : ?>
                                        <li class="v21-header__bot-nav-item">
                                            <a href="<?= $arItem["LINK"] ?>" class="v21-header__bot-nav-link" <?= $target ?>><?= $arItem["TEXT"] ?></a>
                                        </li>
                                        </div>
                                        <? if ($arItem["PARAMS"]['subblock'] == 'end' && $arItem["PARAMS"]['subgroup'] == 2) : ?>
                                            </div>
                                        <? endif; ?>
                                        <? if ($arItem["PARAMS"]['subblock'] == 'end' && $arItem["PARAMS"]['subgroup'] == 4) : ?>
                                            </div>
                                        <? endif; ?>
                                    <? else: ?>
                                        <li class="v21-header__bot-nav-item">
                                            <a href="<?= $arItem["LINK"] ?>" class="v21-header__bot-nav-link" <?= $target ?>><?= $arItem["TEXT"] ?></a>
                                        </li>
                                    <? endif; ?>
								<? endif ?>

							<? endif ?>

						<? endif ?>

						<? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

                            <? if ($arItem['LINK'] == '/' || $arItem['LINK'] == '/corporative-clients/' || $arItem['LINK'] == '/chastnym-klientam/') {
                                $APPLICATION->ShowViewContent('show_block_'.str_replace('/', '', $arItem['LINK']));
                            } ?>

                            <?// $kkk_special += 1; ?>
					<? endforeach ?>

					<? if ($previousLevel > 1) : //close last item tags
					?>
						<?= str_repeat("</ul></div></div></li>", ($previousLevel - 1)); ?>
					<? endif ?>

				</li>
			<? endif ?>

	</ul>
