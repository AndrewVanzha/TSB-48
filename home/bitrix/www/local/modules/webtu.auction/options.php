<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

#объявляем имя переменной именной в таком написании $module_id
#обязательно, иначе права доступа не работают!
$module_id = 'webtu.auction';

#подключаем языковые константы
Loc::loadMessages($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
Loc::loadMessages(__FILE__);

#Проверяем есть ли доступ к модулю
if ($APPLICATION->GetGroupRight($module_id)<"S"){
    #Метод вызывает форму авторизации
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

#Подключаем наш модуль
\Bitrix\Main\Loader::includeModule($module_id);

#Получаем данные отправленные пользователем с формы
$request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();

#Описание опций
$aTabs = array(
    array(
        'DIV' => 'edit1',
        'TAB' => Loc::getMessage('WEBTU_AUC_TAB1'),
        'TITLE' => Loc::getMessage('WEBTU_AUC_TAB1_TITLE'),
        'OPTIONS' => array(
            array('tab1_setting_min_step', Loc::getMessage('WEBTU_AUC_TAB1_SETTING_MIN_STEP'),'',array('text', 30),'',' *1.1'),
            array('tab1_setting_period_of_validity', Loc::getMessage('WEBTU_AUC_TAB1_SETTING_PERIOD_OF_VALIDITY'),'',array('text', 30),'',' *1.2'),
            array('tab1_setting_min_day_moderation', Loc::getMessage('WEBTU_AUC_TAB1_SETTING_MIN_DAY_MODERATION'),'',array('text', 30),'',' *1.3'),
            array('tab1_setting_user_id', Loc::getMessage('WEBTU_AUC_TAB1_SETTING_USER_ID'),'',array('text', 30),'',' *1.4'),
            array('tab1_setting_group_id_full', Loc::getMessage('WEBTU_AUC_TAB1_SETTING_GROUP_ID_FULL'),'',array('text', 30),'',' *1.5'),
            array('tab1_setting_group_id_average', Loc::getMessage('WEBTU_AUC_TAB1_SETTING_GROUP_ID_AVERAGE'),'',array('text', 30),'',' *1.6'),
            array('tab1_setting_group_id_black', Loc::getMessage('WEBTU_AUC_TAB1_SETTING_GROUP_ID_BLACK'),'',array('text', 30),'',' *1.7'),

            array('note'=>Loc::getMessage('WEBTU_AUC_TAB1_NOTE')),
        )
    ),
    array(
        'DIV' => 'edit2',
        'TAB' => Loc::getMessage('WEBTU_AUC_TAB2'),
        'TITLE' => Loc::getMessage('WEBTU_AUC_TAB2_TITLE'),
        'OPTIONS' => array(
            Loc::getMessage('WEBTU_AUC_TAB2_TITLE_HEADER_1'),
            array('tab2_iblock_id', Loc::getMessage('WEBTU_AUC_TAB2_IBLOCK_ID'),'',array('text', 30),'',' *1.1'),
            array('tab2_section_id_active', Loc::getMessage('WEBTU_AUC_TAB2_SECTION_ID_ACTIVE'),'',array('text', 30),'',' *1.2'),
            array('tab2_section_id_plan', Loc::getMessage('WEBTU_AUC_TAB2_SECTION_ID_PLAN'),'',array('text', 30),'',' *1.3'),
            array('tab2_section_id_completed', Loc::getMessage('WEBTU_AUC_TAB2_SECTION_ID_COMPLETED'),'',array('text', 30),'',' *1.4'),

            Loc::getMessage('WEBTU_AUC_TAB2_TITLE_HEADER_2'),
            array('tab2_prop_starting_price_id', Loc::getMessage('WEBTU_AUC_TAB2_PROP_STARTING_PRICE_ID'),'',array('text', 30),'',' *2.1'),
            array('tab2_prop_starting_price_code', Loc::getMessage('WEBTU_AUC_TAB2_PROP_STARTING_PRICE_CODE'),'',array('text', 30),'',''),
            array('tab2_prop_blitz_price_id', Loc::getMessage('WEBTU_AUC_TAB2_PROP_BLITZ_PRICE_ID'),'',array('text', 30),'',' *2.2'),
            array('tab2_prop_blitz_price_code', Loc::getMessage('WEBTU_AUC_TAB2_PROP_BLITZ_PRICE_CODE'),'',array('text', 30),'',''),
            array('tab2_prop_history_bet_id', Loc::getMessage('WEBTU_AUC_TAB2_PROP_HISTORY_BET_ID'),'',array('text', 30),'',' *2.3'),
            array('tab2_prop_history_bet_code', Loc::getMessage('WEBTU_AUC_TAB2_PROP_HISTORY_BET_CODE'),'',array('text', 30),'',''),
            array('tab2_prop_step_rate_id', Loc::getMessage('WEBTU_AUC_TAB2_PROP_STEP_RATE_ID'),'',array('text', 30),'',' *2.4'),
            array('tab2_prop_step_rate_code', Loc::getMessage('WEBTU_AUC_TAB2_PROP_STEP_RATE_CODE'),'',array('text', 30),'',''),
            array('tab2_prop_date_active_id', Loc::getMessage('WEBTU_AUC_TAB2_PROP_DATE_ACTIVE_ID'),'',array('text', 30),'',' *2.5'),
            array('tab2_prop_date_active_code', Loc::getMessage('WEBTU_AUC_TAB2_PROP_DATE_ACTIVE_CODE'),'',array('text', 30),'',''),
            array('tab2_prop_date_completed_id', Loc::getMessage('WEBTU_AUC_TAB2_PROP_DATE_COMPLETED_ID'),'',array('text', 30),'',' *2.6'),
            array('tab2_prop_date_completed_code', Loc::getMessage('WEBTU_AUC_TAB2_PROP_DATE_COMPLETED_CODE'),'',array('text', 30),'',''),

            array('note'=>Loc::getMessage('WEBTU_AUC_TAB2_NOTE')),
        )
    ),
    array(
        'DIV' => 'edit3',
        'TAB' => Loc::getMessage('WEBTU_AUC_TAB3'),
        'TITLE' => Loc::getMessage('WEBTU_AUC_TAB3_TITLE'),
        'OPTIONS' => array(
            Loc::getMessage('WEBTU_AUC_TAB3_TITLE_HEADER_1'),
            array('tab3_iblock_id_buy', Loc::getMessage('WEBTU_AUC_TAB3_IBLOCK_ID_BUY'),'',array('text', 30),'',' *1.1'),

            array('note'=>Loc::getMessage('WEBTU_AUC_TAB3_NOTE')),
        )
    ),
    array(
        'DIV' => 'edit4',
        'TAB' => Loc::getMessage('WEBTU_AUC_TAB4'),
        'TITLE' => Loc::getMessage('WEBTU_AUC_TAB4_TITLE'),
        'OPTIONS' => array(
            array('tab4_shop_id', Loc::getMessage('WEBTU_AUC_TAB4_SHOP_ID'), '', array('text', 30), '', ' *1.1'),
            array('tab4_save_file', Loc::getMessage('WEBTU_AUC_TAB4_SAVE_FILE'),'',array('text', 30),'',' *1.1'),
            array('tab4_save_file_name', Loc::getMessage('WEBTU_AUC_TAB4_SAVE_NAME_FILE'),'',array('text', 30),'',' *1.2'),
            
            array('note'=>Loc::getMessage('WEBTU_AUC_TAB4_NOTE')),
        )
    ),
    array(
        'DIV' => 'edit4',
        'TAB' => Loc::getMessage('MAIN_TAB_RIGHTS'),
        'TITLE' => Loc::getMessage('MAIN_TAB_TITLE_RIGHTS')
    ),
);

#Сохранение
if ($request->isPost() && $request['Update'] && check_bitrix_sessid())
{
    foreach ($aTabs as $aTab)
    {
        #Или можно использовать __AdmSettingsSaveOptions($MODULE_ID, $arOptions);
        foreach ($aTab['OPTIONS'] as $arOption)
        {
            #Строка с подсветкой. Используется для разделения настроек в одной вкладке
            if (!is_array($arOption)){ continue; }
                
            #Уведомление с подсветкой
            if ($arOption['note']){ continue; }
                
            #Или __AdmSettingsSaveOption($MODULE_ID, $arOption);
            $optionName = $arOption[0];

            $optionValue = $request->getPost($optionName);

            Option::set($module_id, $optionName, is_array($optionValue) ? implode(",", $optionValue):$optionValue);
        }
    }
}

#Визуальный вывод
#получаем объект класса от CAdminTabControl где tabControl id формы
$tabControl = new CAdminTabControl('tabControl', $aTabs);

#Открываем форму
$tabControl->Begin(); ?>
<form method='post' action='<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($request['mid'])?>&amp;lang=<?=$request['lang']?>' name='webtu_salefood_settings'>
    <?
        foreach ($aTabs as $aTab):
            if($aTab['OPTIONS']):
                #открываем вкладку
                $tabControl->BeginNextTab();

                #методо который по переданным данным подгружает данные (опции) из бд и формитрет
                __AdmSettingsDrawList($module_id, $aTab['OPTIONS']); 
            endif;
        endforeach;

        #Добавим вкладку управление правами доступами
        $tabControl->BeginNextTab();
            require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php" );
        $tabControl->Buttons(); 
    ?>
    <input type="submit" name="Update" value="<?echo GetMessage('MAIN_SAVE')?>" />
    <input type="reset" name="reset" value="<?echo GetMessage('MAIN_RESET')?>" />
    <?=bitrix_sessid_post();?>
</form>
<? $tabControl->End(); ?>