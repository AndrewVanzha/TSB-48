<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>


	<?
	$previousLevel = 0;
	?>


	<ul>
		<?
		foreach ($arResult as $arItem) : ?>

			<?
			if (mb_substr($arItem["LINK"], 0, 1) !== '/') {
				$target = 'target="_blank"';
			} else {
				$target = '';
			}
			?>

			<? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) : ?>
				<?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
			<? endif ?>

			<? if ($arItem["IS_PARENT"]) : ?>

				<li>
					<a href="#" class="menu-arrow-top">
						<?= $arItem["TEXT"] ?>
					</a>
					<? if ($arItem["DEPTH_LEVEL"] != 2) { ?>
						<ul>
						<? } else { ?>
							<ul>
							<? } ?>
							<!-- 
				<? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
					<li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
						<ul class="root-item">
				<? else : ?>
					<li><a href="<?= $arItem["LINK"] ?>" class="parent<? if ($arItem["SELECTED"]) : ?> item-selected<? endif ?>"><?= $arItem["TEXT"] ?></a>
						<ul>
				<? endif ?> -->

						<? else : ?>

							<? if ($arItem["PERMISSION"] > "D") : ?>

								<? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
									<li><a href="<?= $arItem["LINK"] ?>" class="<? if ($arItem["SELECTED"]) : ?>root-item-selected<? else : ?>root-item<? endif ?>" <?= $target ?>><?= $arItem["TEXT"] ?></a></li>
								<? else : ?>
									<li><a href="<?= $arItem["LINK"] ?>" <? if ($arItem["SELECTED"]) : ?> class="item-selected" <? endif ?> <?= $target ?>><?= $arItem["TEXT"] ?></a></li>
								<? endif ?>

							<? else : ?>

								<? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
									<li><a href="" class="<? if ($arItem["SELECTED"]) : ?>root-item-selected<? else : ?>root-item<? endif ?>" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>" <?= $target ?>><?= $arItem["TEXT"] ?></a></li>
								<? else : ?>
									<li><a href="" class="denied" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>" <?= $target ?>><?= $arItem["TEXT"] ?></a></li>
								<? endif ?>

							<? endif ?>

						<? endif ?>

						<? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

					<? endforeach ?>

					<? if ($previousLevel > 1) : //close last item tags
					?>
						<?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
					<? endif ?>

				</li>
			<? endif ?>
	</ul>









	<?/*
$previousLevel = 0;
?>

<nav class="nav-menu">
	<ul class="nav-menu_upper">
		<?
		foreach($arResult as $arItem):?>

<?
if (mb_substr($arItem["LINK"], 0, 1) !== '/') {
    $target = 'target="_blank"';
} else {
    $target = '';
}
?>

			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

			<?if ($arItem["IS_PARENT"]):?>
			
			<li class="has-submenu">	
				<a href="#">
                    <span class="mi--chevron-down-1 mi">
                        <?=$arItem["TEXT"]?>
                    </span>
                </a>	
				<?if ($arItem["DEPTH_LEVEL"] != 2){?>
	                <ul class="nav-menu_middle">
				<?} else {?>
					<ul class="nav-menu_lower">
				<?}?>
<!-- 
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						<ul class="root-item">
				<?else:?>
					<li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?endif?> -->

			<?else:?>

				<?if ($arItem["PERMISSION"] > "D"):?>

					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" <?=$target?>><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?> <?=$target?>><?=$arItem["TEXT"]?></a></li>
					<?endif?>

				<?else:?>

					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" <?=$target?>><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" <?=$target?>><?=$arItem["TEXT"]?></a></li>
					<?endif?>

				<?endif?>

			<?endif?>

			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

		<?endforeach?>

		<?if ($previousLevel > 1)://close last item tags?>
			<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
		<?endif?>

		</li>
		<?endif?>
	</ul>
</nav>
