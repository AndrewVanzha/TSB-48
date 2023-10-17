<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<? $previousLevel = 0; ?>
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
				<li class="v21-header__mid-nav-item">
					<a href="#" class="v21-header__mid-nav-link">
						<?= $arItem["TEXT"] ?>
					</a>
					<div class="v21-header__bot-nav v21-fade">
						<ul class="v21-header__bot-nav-list">
						<? else : ?>

							<? if ($arItem["PERMISSION"] > "D") : ?>

								<? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
									<li class="v21-header__mid-nav-item">
										<a href="<?= $arItem["LINK"] ?>" class="v21-header__mid-nav-link<?= $arItem["SELECTED"] ? " is-active" : "" ?>" <?= $target ?>><?= $arItem["TEXT"] ?></a>
									</li>
								<? else : ?>
									<li class="v21-header__bot-nav-item">
										<a href="<?= $arItem["LINK"] ?>" class="v21-header__bot-nav-link" <?= $target ?>><?= $arItem["TEXT"] ?></a>
									</li>
								<? endif ?>

							<? endif ?>

						<? endif ?>

						<? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

					<? endforeach ?>

					<? if ($previousLevel > 1) : //close last item tags
					?>
						<?= str_repeat("</ul></div></li>", ($previousLevel - 1)); ?>
					<? endif ?>

				</li>
			<? endif ?>
	</ul>