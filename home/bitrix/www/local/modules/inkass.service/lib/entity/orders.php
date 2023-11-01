<?php

namespace Inkass\Service\Entity;

use Bitrix\Main\Entity;

class OrdersTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'inkass_orders';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('id', array('primary' => true, 'autocomplete' => true)),
            new Entity\IntegerField('user_id'),
            new Entity\DatetimeField('date'),

            new Entity\DatetimeField('check_date'),
            new Entity\DatetimeField('start_time'),
            new Entity\DatetimeField('finish_time'),
            new Entity\DatetimeField('date_expired'),

            new Entity\StringField('fio'),
            new Entity\StringField('office'),

            new Entity\StringField('question_1'),
            new Entity\StringField('question_1_ask'),
            new Entity\StringField('question_1_comment'),
            new Entity\StringField('question_2'),
            new Entity\StringField('question_2_ask'),
            new Entity\StringField('question_2_comment'),
            new Entity\StringField('question_3'),
            new Entity\StringField('question_3_ask'),
            new Entity\StringField('question_3_comment'),
            new Entity\StringField('question_4'),
            new Entity\StringField('question_4_ask'),
            new Entity\StringField('question_4_comment'),
            new Entity\StringField('question_5'),
            new Entity\StringField('question_5_ask'),
            new Entity\StringField('question_5_comment'),
            new Entity\StringField('question_6'),
            new Entity\StringField('question_6_ask'),
            new Entity\StringField('question_6_comment'),
            new Entity\StringField('question_7'),
            new Entity\StringField('question_7_ask'),
            new Entity\StringField('question_7_comment'),
            new Entity\StringField('question_8'),
            new Entity\StringField('question_8_ask'),
            new Entity\StringField('question_8_comment'),
            new Entity\StringField('question_9'),
            new Entity\StringField('question_9_ask'),
            new Entity\StringField('question_9_comment'),
            new Entity\StringField('question_10'),
            new Entity\StringField('question_10_ask'),
            new Entity\StringField('question_10_comment'),
            new Entity\StringField('dop_comment'),

            new Entity\IntegerField('status_captcha'),
            new Entity\IntegerField('status')
        );
    }
}
