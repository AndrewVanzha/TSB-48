<?php

namespace Inkass\Service;

use Bitrix\Main\Config\Option;
use Bitrix\Main\ORM\Data\UpdateResult;
use Bitrix\Main\Type\DateTime as DateTimeBitrix;
use DateInterval;
use DateTime;
use Exception;
use Inkass\Service\Entity\CodeTable;
use Inkass\Service\General;

class Code
{
    /**
     * Генерация хэша для валидации email
     * @param int $length
     * @return string
     */
    public static function generate_hash($length = 16)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }

    /**
     * Генерация кода для верификации смс
     * @return string
     */
    public static function generate_sms_code()
    {
        $min = 0;
        $max = 9999;

        return str_pad(rand($min, $max), 4, 0, STR_PAD_LEFT);
    }

    /**
     * Получение кода
     * @param $params
     * @return array|null
     * @throws Exception
     */
    public static function get_code($params)
    {
        return CodeTable::getRow([
            'filter' => $params,
            'order' => ['id' => 'desc']
        ]);
    }

    /**
     * Получение всех кодов
     * @param $params
     * @return \Bitrix\Main\ORM\Query\Result
     * @throws Exception
     */
    public static function get_code_all($params)
    {
        return CodeTable::getList([
            'filter' => $params
        ]);
    }

    /**
     * Обновление кода
     * @param $id
     * @param $params
     * @return UpdateResult
     * @throws Exception
     */
    public static function update_code($id, $params)
    {
        return CodeTable::update($id, $params);
    }

    /**
     * Создание кода в БД
     * @param $data
     * @return string
     * @throws Exception
     */
    public static function add_code($data)
    {
        $time_link = Option::get('inkass.service', 'other_time_link');
        $time_code = Option::get('inkass.service', 'other_time_key');
        $date_start = new DateTimeBitrix();
        $date_end = new DateTime();
        $date_end = DateTimeBitrix::createFromPhp($date_end);
        $code = 'Запись данных чек-листа в БД';
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_add_code_$data.json', json_encode($data));

        $arQuestionsList = General::get_questions_list();
        $params = [
            'CHECK_NUM' => $data['check_id'],
            'INKASS' => $data['user_fio'],
            'DATE' => $data['check_date'],
            'START_TIME' => $data['params']['start_time'],
            'FINISH_TIME' => $data['params']['finish_time'],

            'OFFICE' => $data['params']['office'],
            'ADDRESS' => $data['params']['address'],
            'CASHIER' => $data['params']['fio'],

            'QUESTION_1' => $arQuestionsList[0],
            'QUESTION_1_ANSWER' => $data['params']['question_1'],
            'QUESTION_1_COMMENT' => $data['params']['question_1_comment'],
            'QUESTION_2' => $arQuestionsList[1],
            'QUESTION_2_ANSWER' => $data['params']['question_2'],
            'QUESTION_2_COMMENT' => $data['params']['question_2_comment'],
            'QUESTION_3' => $arQuestionsList[2],
            'QUESTION_3_ANSWER' => $data['params']['question_3'],
            'QUESTION_3_COMMENT' => $data['params']['question_3_comment'],
            'QUESTION_4' => $arQuestionsList[3],
            'QUESTION_4_ANSWER' => $data['params']['question_4'],
            'QUESTION_4_COMMENT' => $data['params']['question_4_comment'],
            'QUESTION_5' => $arQuestionsList[4],
            'QUESTION_5_ANSWER' => $data['params']['question_5'],
            'QUESTION_5_COMMENT' => $data['params']['question_5_comment'],
            'QUESTION_6' => $arQuestionsList[5],
            'QUESTION_6_ANSWER' => $data['params']['question_6'],
            'QUESTION_6_COMMENT' => $data['params']['question_6_comment'],
            'QUESTION_7' => $arQuestionsList[6],
            'QUESTION_7_ANSWER' => $data['params']['question_7'],
            'QUESTION_7_COMMENT' => $data['params']['question_7_comment'],
            'QUESTION_8' => $arQuestionsList[7],
            'QUESTION_8_ANSWER' => $data['params']['question_8'],
            'QUESTION_8_COMMENT' => $data['params']['question_8_comment'],
            'DOP_COMMENT' => $data['params']['dop_comment'],
        ];

        // отправка уведомления по email
        $email_message = General::send_email([
            'email' => $data['email_to'],
            //'code' => $code,
            'params' => $params,
        ]);
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_add_order_$email_message.json', json_encode($email_message->getId()));
        // добавление события отправки email-уведомления
        Event::add_event([
            'name' => 'check_email_sent',
            'order_id' => $data['order_id']
        ]);

        return $code;
    }

    /**
     * Создание нового кода
     * @param $order
     * @return false|string
     * @throws Exception
     */
    public static function renew_code($order)
    {
        $code = self::get_code(['order_id' => $order['id'], 'status' => 0]);
        if (!empty($code['id'])) {
            self::update_code($code['id'], ['status' => 3]);
        }

        return self::add_code([
            'order_id' => $order['id'],
            'type' => $order['type'],
            'from' => $order['type'] === 'email'
                ? $order['email']
                : $order['phone_number']
        ]);
    }
}