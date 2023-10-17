<?php

namespace Inkass\Service\Entity;

use Bitrix\Main\Entity;
use Exception;

class UsersTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'inkass_users';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('id', array('primary' => true, 'autocomplete' => true)),
            new Entity\IntegerField('inkass_id'),
            new Entity\IntegerField('inkass_fio'),
        );
    }

    /**
     * Получение пользователя
     * @param $params
     * @return array|null
     * @throws Exception
     */
    public static function get_user($params)
    {
        return UsersTable::getRow(array(
            "filter" => $params,
        ));
    }
}
