<?php

namespace Inkass\Service\Entity;

use Bitrix\Main\Entity;

class CodeTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'inkass_code';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('id', array('primary' => true, 'autocomplete' => true)),
            new Entity\IntegerField('order_id'),
            new Entity\DatetimeField('date'),
            new Entity\DatetimeField('date_expired'),
            new Entity\StringField('fio'),
            new Entity\StringField('code'),
            new Entity\IntegerField('attempts'),
            new Entity\IntegerField('status'),

            new Entity\IntegerField('phone_number'),
            new Entity\IntegerField('status_phone'),
        );
    }
}
