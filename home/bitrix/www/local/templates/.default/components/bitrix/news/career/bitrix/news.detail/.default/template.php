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
<article class="hq-entry page-section content-area">
    <div class="content-area_text">

		<?=$arResult['DETAIL_TEXT']?>

	</div>
</article>

<? if ($arResult['PROPERTIES']['ATT_FILE']['VALUE'] !== false) { ?>
	<section class="page-section">
		<?foreach($arResult['PROPERTIES']['ATT_FILE']['VALUE'] as $key => $file){?>
			<?$arFile = CFile::GetFileArray($file);?>
			<?$arTime = explode(" ", $arFile['TIMESTAMP_X']);?>

			<a href="<?=$arFile['SRC']?>" download class="attached-file mi--download-2 mi">

				<span class="aligner">

					<span class="name">
						<?=$arFile['FILE_NAME']?>
					</span>

					<time class="page-date mi--calendar mi">
						Дата публикации: <?=$arTime['0'];?>
					</time>

				</span>

			</a>

			<p><?=$arFile['DESCRIPTION']?></p>

		<?}?>
	</section>
<? } ?>

<div class="article-bottom-bar">

	<div class="share">
		<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
		<script src="//yastatic.net/share2/share.js"></script>
		<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus" data-limit="3"></div>
	</div>

</div>
