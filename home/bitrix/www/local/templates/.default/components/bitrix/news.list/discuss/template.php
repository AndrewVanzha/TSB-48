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
<?global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>

<div class="topic-title">Мои обсуждения</div>
<div class="discussion-block-wrap">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="discussion-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="header">
			<div class="block">
				<div class="name"><?=$arUser[NAME];?> <?=$arUser[LAST_NAME];?></div>
			</div>
			<div class="block"><?=$arItem["ACTIVE_FROM"]?></div>
			<div class="block">Приватное сообщение для "Транстройбанк"</div>
		</div>
		<div class="discussion">
			<div class="inner clearfix">
				<div class="img-user"><img src="/assets/images/avatar.jpg" alt=""></div>
				<div class="text">
					<p>
						<?echo $arItem["PREVIEW_TEXT"];?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<?if ( strlen($arItem["DETAIL_TEXT"]) > 0):?>
		<div class="discussion-block">
			<div class="header">
				<div class="block">
					<div class="name">Сообщение от администратора</div>
				</div>
				<div class="block">Приватное сообщение для <?=$arUser[NAME];?> <?=$arUser[LAST_NAME];?></div>
			</div>
			<div class="discussion">
				<div class="inner clearfix">
					<div class="img-user"><img src="/assets/images/logo-main-2.png" alt=""></div>
					<div class="text">
						<p>
							<?=$arItem["DETAIL_TEXT"]?>
						</p>
					</div>
				</div>
			</div>
		</div>
	<?endif?>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
