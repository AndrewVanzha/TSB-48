<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

$moduleId = 'webtu.catalog';

if ($APPLICATION->GetGroupRight($moduleId) < "S") {
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

\Bitrix\Main\Loader::includeModule($moduleId);
\Bitrix\Main\Loader::includeModule('iblock');
$request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();

$iblockSource = array();
$iblocks = CIBlock::GetList();

while ($iblock = $iblocks->fetch()) {
    $iblockSource[$iblock['ID']] = $iblock['NAME'];
}

$propertySource = array();
$properties = CIBlockProperty::GetList();

while ($property = $properties->fetch()) {
    $propertySource[$property['CODE']] = $property['NAME'];
}

$citiesIblockId       = COption::GetOptionInt('webtu.catalog', 'geotargeting_iblock_id', 0);

$aTabs = array(
    array(
        'DIV' => 'edit1',
        'TAB' => 'Инфоблоки',
        'TITLE' => 'Инфоблоки',
        'OPTIONS' => array(
            array(
                "geotargeting_iblock_id",
                "Инфоблок городов",
                $citiesIblockId,
                array(
                    "selectbox",
                    $iblockSource,
                )
            ),
        )
    ),
    array(
        'DIV' => 'edit4',
        'TAB' => 'Права доступа',
        'TITLE' => 'Права доступа'
    ),
);

if ($request->isPost() && $request['Update'] && check_bitrix_sessid())
{
    foreach ($aTabs as $aTab)
    {
        foreach ($aTab['OPTIONS'] as $arOption)
        {
            if (!is_array($arOption)){ continue; }
            if ($arOption['note']){ continue; }

            $optionName = $arOption[0];
            $optionValue = $request->getPost($optionName);

            Option::set($moduleId, $optionName, is_array($optionValue) ? implode(",", $optionValue):$optionValue);
        }
    }
}

$tabControl = new CAdminTabControl('tabControl', $aTabs);

$tabControl->Begin(); ?>
    <form method='post' action='<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($request['mid'])?>&amp;lang=<?=$request['lang']?>' name='webtu_salefood_settings'>
        <?
        foreach ($aTabs as $aTab):
            if($aTab['OPTIONS']):

                $tabControl->BeginNextTab();
                __AdmSettingsDrawList($moduleId, $aTab['OPTIONS']);
            endif;
        endforeach;

        $tabControl->BeginNextTab();
        require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php" );
        $tabControl->Buttons();
        ?>
        <input type="submit" name="Update" value="<?echo GetMessage('MAIN_SAVE')?>" />
        <input type="reset" name="reset" value="<?echo GetMessage('MAIN_RESET')?>" />
        <?=bitrix_sessid_post();?>
    </form>
<? $tabControl->End(); ?>