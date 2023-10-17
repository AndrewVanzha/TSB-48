<?php

namespace Inkass\Service;

use DateTime;
use Exception;

class Agent
{
    /**
     * Проверка статусов
     * @throws Exception
     */
    public static function check()
    {
        global $USER;
        $authPeriod = 1 * 60; // сек, время отключения авторизации пользователя
        /*
        $session = \Bitrix\Main\Application::getInstance()->getSession();
        if ($session['INKASS']) {
            foreach ($session['INKASS'] as $ix=>$arItem) {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_session_agent.json', json_encode([$ix, $arItem]));
            }
        }

        if (\Bitrix\Main\Engine\CurrentUser::get()->getId()) {
            $user = \Bitrix\Main\Engine\CurrentUser::get()->getId();
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_user_agent.json', json_encode([$user]));
        }
        */

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
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_agent_users.json', json_encode($users));

        $current_time = time();
        //echo '<pre>';print_r($current_time);echo '</pre>';
        foreach ($users as $user) {
            //echo '<pre>';print_r($user['LAST_LOGIN']);echo '</pre>';
            //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_agent_user_id.json', json_encode($user['ID']), FILE_APPEND);
            //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_agent_curruser_id.json', json_encode(\Bitrix\Main\Engine\CurrentUser::get()->getId()));
            $user_auth_time = $user['LAST_LOGIN']->getTimestamp();
            //echo '<pre>';print_r($user_auth_time);echo '</pre>';
            //echo '<pre>';print_r($current_time - $user_auth_time);echo '</pre>';
            $period = $current_time - $user_auth_time;
            if ($period > $authPeriod) {
                $current_user = \Bitrix\Main\Engine\CurrentUser::get()->getId();
                if ($user['ID'] == $current_user && $current_user != 1) {
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_agent_logout_user.json', json_encode([$period, $user]));
                    //$USER->logout();
                }
            }
        }

        unset($users);
        unset($arUserGroups);


            /*$codes = Code::get_code_all(['status' => 0]);
            $orders_closes = [];

            while ($code = $codes->fetch()) {
                if (in_array($code['order_id'], $orders_closes)) {
                    continue;
                }

                $date = new DateTime();
                $expired = $code['date_expired'];
                if ($expired->getTimestamp() < $date->getTimestamp()) {
                    Order::cancel_order($code['order_id'], 2);
                    $orders_closes[] = $code['order_id'];
                }
            }*/

        return "\Inkass\Service\Agent::check();";
    }
}