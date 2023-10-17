<?
/**
 * @var $APPLICATION
 * @var $USER
 */

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;
use Inkass\Service\General;
use Inkass\Service\Logger;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Чек-лист инассатора");

global $USER;
$module_id = 'inkass.service';


// Проверяю текущего пользователя на присутствие в группе Инкассация
$arUserGroups = [];
$user_group = \Bitrix\Main\UserGroupTable::getList(array(
    'filter' => array('USER_ID'=>$USER->GetID(), 'GROUP.ACTIVE'=>'Y', 'GROUP.STRING_ID'=>'inkass'),
    'select' => array('GROUP_ID','GROUP_CODE'=>'GROUP.STRING_ID'), // выбираем идентификатор группы и символьный код группы
    'order' => array('GROUP.C_SORT'=>'ASC'), // сортируем в соответствии с сортировкой групп
));
while ($arGroup = $user_group->fetch()) {
    $arUserGroups[] = $arGroup;
}
//echo '<pre>';print_r($arUserGroups);echo '</pre>';
if (empty($arUserGroups)) {
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_init.json', json_encode(['пользователя '.$USER->getID().' нет в группе Инкассации']), FILE_APPEND);
    $USER->logout(); // пользователь не в группе Инкассации
}
unset($arUserGroups);


$arUserGroups = [];
$user_group = \Bitrix\Main\UserGroupTable::getList(array(  //  определяю список пользователей в Инкассации
    'filter' => array('GROUP.ACTIVE'=>'Y', 'GROUP.STRING_ID'=>'inkass'),
    'select' => array('USER_ID', 'GROUP_ID','GROUP_CODE'=>'GROUP.STRING_ID'), // выбираем идентификатор группы и символьный код группы
    //'order' => array('GROUP.C_SORT'=>'ASC'), // сортируем в соответствии с сортировкой групп
));
while ($arGroup = $user_group->fetch()) {
    $arUserGroups[] = $arGroup['USER_ID'];
}
//echo '<pre>';print_r($arUserGroups);echo '</pre>';

$users= [];
$user = \Bitrix\Main\UserTable::getList(array( // Выборка всех авторизовавшихся пользователей Инкассации
    'filter' => array('ID' => $arUserGroups),
    'select' => array('ID', 'SHORT_NAME', 'LAST_LOGIN',), // выберем идентификатор и генерируемое (expression) поле SHORT_NAME
    'order' => array('LAST_LOGIN' => 'DESC'), // все группы, кроме основной группы администраторов,
    //'limit' => 7
));
while ($arUser = $user->fetch()) {
    $users[] = $arUser;
}

//echo '<pre>';print_r($users);echo '</pre>';
$current_time = time();
/*
foreach ($users as $user) {
    if ($user['LAST_LOGIN']) {
        $user_auth_time = $user['LAST_LOGIN']->getTimestamp();
    } else {
        $user_auth_time = $user['DATE_REGISTER']->getTimestamp();
    }
    $period = $current_time - $user_auth_time;
    if ($period > 1*60) {
        $current_user = \Bitrix\Main\Engine\CurrentUser::get()->getId();
        if ($user['ID'] == $current_user && $current_user != 1) {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_agent_logout_user.json', json_encode([$period, $user]));
            //$USER->logout();
        }
    }
}
*/
//file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_users_agent.json', json_encode([$users]));
unset($users);
unset($arUserGroups);


//unset($_SESSION['INKASS']);  //  при тестировании

if ($USER->IsAuthorized()) {
    $session_start = time();
    $var_value = $_SESSION['SESS_AUTH'];
} else {
    LocalRedirect('/inkass/');
}

Asset::getInstance()->addCss("/inkass.service/assets/style.css");
Asset::getInstance()->addCss("/inkass.service/assets/daterangepicker.min.css");
Asset::getInstance()->addJs("/inkass.service/assets/moment.min.js");
Asset::getInstance()->addJs("/inkass.service/assets/daterangepicker.min.js");
Asset::getInstance()->addJs("/inkass.service/assets/jquery.maskedinput.min.js");
Asset::getInstance()->addJs("/inkass.service/assets/script.js");
$session = \Bitrix\Main\Application::getInstance()->getSession();
?>
<?php
//debugg('init');
try {
    //debugg('try');
    if (Loader::IncludeModule($module_id)) {
        try {
            $request = Application::getInstance()->getContext()->getRequest();
            $get = $request->getQueryList();
            $post = $request->getPostList();
            $check = General::check_access($get['h']);
            $check = 1;

            switch ($check) {
                case 1:
                    $APPLICATION->IncludeFile("/local/modules/$module_id/views/init/manager.php", array(
                        'module_id' => $module_id,
                        'get' => $get,
                        'post' => $post
                    ));
                    break;
                case 2:
                    $APPLICATION->IncludeFile("/local/modules/$module_id/views/init/user.php", array(
                        'module_id' => $module_id,
                        'hash' => $get['h'],
                        'get' => $get,
                        'post' => $post
                    ));
                    break;
                default:
                    $APPLICATION->IncludeFile("/local/modules/$module_id/views/init/forbidden.php");
                    //LocalRedirect('/inkass/');/*dop*/
            }
        } catch (Exception $e) {
            Logger::write('error', $e->getMessage());
        }
    }
} catch (Exception $e) {
    Logger::write('error', $e->getMessage());
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
