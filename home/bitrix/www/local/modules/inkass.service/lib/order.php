<?php

namespace Inkass\Service;

use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\ORM\Data\UpdateResult;
use Bitrix\Main\ORM\Query\Result;
use Bitrix\Main\Type\DateTime;
use Exception;
use Inkass\Service\Entity\OrdersTable;
use Inkass\Service\Entity\UsersTable;

class Order
{
    const ERROR_CAPTCHA = 'Введен некорректно код с картинки';
    const ERROR_CODE = 'Введен некорректно код из смс';

    /**
     * Создание заявки и валидация
     * @param $data
     * @return array
     * @throws Exception
     */
    public static function create_order($data)
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_create_order.json', json_encode($data));
        if (count($data) === 0) {
            return [];
        }
        if (empty($data['check_date'])) {
            return ['data' => $data, 'error' => 'Не указана дата проверки'];
        }
        if (empty($data['start_time'])) {
            return ['data' => $data, 'error' => 'Не указано время начала проверки'];
        }
        if (empty($data['finish_time'])) {
            return ['data' => $data, 'error' => 'Не указано время окончания проверки'];
        }
        if (empty($data['office'])) {
            return ['data' => $data, 'error' => 'Не указан дополнительный офис'];
        }
        if (empty($data['fio'])) {
            return ['data' => $data, 'error' => 'Не указаны ФИО кассира'];
        }
        if (empty($data['question_1'])) {
            return ['data' => $data, 'error' => 'Не указан ответ на доп.вопрос №1'];
        }
        if (empty($data['question_2'])) {
            return ['data' => $data, 'error' => 'Не указан ответ на доп.вопрос №2'];
        }
        if (empty($data['question_3'])) {
            return ['data' => $data, 'error' => 'Не указан ответ на доп.вопрос №3'];
        }
        if (empty($data['question_4'])) {
            return ['data' => $data, 'error' => 'Не указан ответ на доп.вопрос №4'];
        }
        if (empty($data['question_5'])) {
            return ['data' => $data, 'error' => 'Не указан ответ на доп.вопрос №5'];
        }
        if (empty($data['question_6'])) {
            return ['data' => $data, 'error' => 'Не указан ответ на доп.вопрос №6'];
        }
        //if (empty($data['question_7'])) {
        //    return ['data' => $data, 'error' => 'Не указан ответ на доп.вопрос №7'];
        //}
        //if (empty($data['question_8'])) {
        //    return ['data' => $data, 'error' => 'Не указан ответ на доп.вопрос №8'];
        //}

        $date_time = new DateTime();
        $operation_time = new DateTime($data['finish_time']);
        $params = [
            'inkass_id' => $data['inkass_id'],
            'inkass_fio' => $data['inkass_fio'],
            'fio' => $data['fio'],
            'office' => $data['office'],
            'address' => $data['address'],
            'date' => $date_time->getTimestamp(),
            'check_date' => new DateTime($data['check_date']),
            'start_time' => new DateTime($data['start_time']),
            'finish_time' => new DateTime($data['finish_time']),
            'question_1' => $data['question_1'],
            'question_1_ask' => $data['question_1_ask'],
            'question_1_comment' => $data['question_1_comment'],
            'question_2' => $data['question_2'],
            'question_2_ask' => $data['question_2_ask'],
            'question_2_comment' => $data['question_2_comment'],
            'question_3' => $data['question_3'],
            'question_3_ask' => $data['question_3_ask'],
            'question_3_comment' => $data['question_3_comment'],
            'question_4' => $data['question_4'],
            'question_4_ask' => $data['question_4_ask'],
            'question_4_comment' => $data['question_4_comment'],
            'question_5' => $data['question_5'],
            'question_5_ask' => $data['question_5_ask'],
            'question_5_comment' => $data['question_5_comment'],
            'question_6' => $data['question_6'],
            'question_6_ask' => $data['question_6_ask'],
            'question_6_comment' => $data['question_6_comment'],
            'question_7' => $data['question_7'],
            'question_7_ask' => $data['question_7_ask'],
            'question_7_comment' => $data['question_7_comment'],
            'question_8' => $data['question_8'],
            'question_8_ask' => $data['question_8_ask'],
            'question_8_comment' => $data['question_8_comment'],
            'question_9' => $data['question_9'],
            'question_9_ask' => $data['question_9_ask'],
            'question_9_comment' => $data['question_9_comment'],
            'question_10' => $data['question_10'],
            'question_10_ask' => $data['question_10_ask'],
            'question_10_comment' => $data['question_10_comment'],
            'dop_comment' => $data['dop_comment'],
        ];
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_create_order.json', json_encode($data));

        try {
            return [
                'success' => true,
                'data' => $data,
                'response' => self::add_order($params)
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'data' => $data
            ];
        }
    }

    /**
     * Отмена заявки
     * @param $order_id
     * @param int $status
     * @throws Exception
     */
    public static function cancel_order($order_id, $status = 3)
    {
        $event_name = [
            2 => 'expired_order',
            3 => 'cancel_order',
            4 => 'attempts_expired_order',
        ];

        self::update_order($order_id, [
            'email' => '',
            'phone_number' => 0,
            'status_email' => $status,
            'status_captcha' => $status,
            'status_phone' => $status,
            'status' => $status,
        ]);

        Event::add_event([
            'name' => $event_name[$status],
            'order_id' => $order_id
        ]);

        $codes = Code::get_code_all(['order_id' => $order_id, 'status' => 0])->fetchAll();

        foreach ($codes as $code) {
            Code::update_code($code['id'], ['status' => $status]);
        }
    }

    /**
     * Добавление заявки в бд
     * @param $params
     * @return AddResult
     * @throws Exception
     */
    private static function add_order($params)
    {
        $user = UsersTable::get_user(['inkass_id' => $params['inkass_id']]);

        if (!$user) {
            $user_id = self::add_user($params['inkass_id'], $params['inkass_fio'])->getId();
        } else {
            $user_id = $user['id'];
        }
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_add_order_$user_id.json', json_encode($user_id));

        unset($params['inkass_id']);
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_add_order_$params.json', json_encode($params));


        $params['user_id'] = $user_id;
        $params['date'] = new DateTime();
        $response = OrdersTable::add($params);
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_add_order_$response_id.json', json_encode($response->getId()));

        if (!$response->isSuccess()) {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_add_order_$response.json', json_encode($response));
            Logger::write('error', $response->getErrorMessages());
        }
        if ($response) {
            Event::add_event([
                'name' => 'check' . '_inkass_create',
                'order_id' => $response->getId()
            ]);

            Code::add_code([  // высылаю email-сообщение
                'check_id' => $response->getId(),
                'user_id' => $user_id,
                'user_fio' => $params['inkass_fio'],
                'check_date' => $params['check_date'],
                'params' => $params,
                'email_to' => 'a.vanzha@tsbnk.ru',
            ]);

        }

        return $response;
    }

    /**
     * Обновление заявки
     * @param $id
     * @param $data
     * @return UpdateResult
     * @throws Exception
     */
    public static function update_order($id, $data)
    {
        return OrdersTable::Update($id, $data);
    }

    /**
     * Получение заявки по параметрам
     * @param $params
     * @return array|false
     * @throws Exception
     */
    public static function get_order($params)
    {
        return OrdersTable::getRow(array(
            "filter" => $params,
        ));
    }

    /**
     * Получение списка заявок по параметрам
     * @param $filter
     * @param int $limit
     * @param int $offset
     * @param string[] $order
     * @return array
     * @throws Exception
     */
    public static function get_orders($filter, $limit = 9999, $offset = 0, $order = ['date' => 'desc'])
    {
        $count = OrdersTable::getCount($filter);
        return [
            'count' => (int)$count,
            'data' => OrdersTable::getList(array(
                "filter" => $filter,
                "limit" => $limit,
                "offset" => $offset,
                "order" => $order
            ))
        ];
    }

    /**
     * @param $params
     * @return mixed
     * @throws Exception
     */
    public static function get_correct_filter_params($params)
    {
        $params = array_filter($params, function ($v, $k) {
            return !empty($v) || ($k == 'status');
        }, ARRAY_FILTER_USE_BOTH);

        if (!empty($params['fio'])) {
            $user = UsersTable::get_user(['fio' => $params['fio']]);
            $params['user_id'] = $user['id'] ? $user['id'] : 0;
        }

        if (!empty($params['period'])) {
            $period = explode(' - ', $params['period']);
            $start_date = new DateTime($period[0], "d/m/Y");
            $end_date = new DateTime($period[1], "d/m/Y");
            $params['>=date'] = $start_date;
            $params['<=date'] = $end_date->add('1 day');
        }

        $params = array_filter($params, function ($k) {
            return in_array($k, ['>=date', '<=date', 'user_id', 'type', 'phone_number', 'email', 'status']);
        }, ARRAY_FILTER_USE_KEY);

        return $params;
    }

    /**
     * Получение всего списка заявок
     * @param int $page
     * @param array $params
     * @return array
     * @throws Exception
     */
    public static function get_all_orders($page = 1, $params = [])
    {
        $limit = 20;
        $offset = $page > 1 ? --$page * $limit : 0;
        $result = self::get_orders($params, $limit, $offset);
        $result['pages'] = (int)ceil($result['count'] / $limit);
        return $result;
    }

    /**
     * Добавление пользователя
     * @param $abs_id
     * @return AddResult
     * @throws Exception
     */
    private static function add_user($inkass_id, $inkass_fio)
    {
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_add_user_$inkass_id.json', json_encode($inkass_id));
        return UsersTable::add(array(
            'inkass_id' => $inkass_id,
            'inkass_fio' => $inkass_fio,
        ));
    }

    /**
     * Получение наименования типа заявки
     * @param $type
     * @return string
     */
    public static function get_order_type_label($type)
    {
        $text = [
            'email' => 'Email-верификация',
            'phone' => 'СМС-верификация'
        ];

        return $text[$type];
    }

    /**
     * Проверка на наличае данных
     * @param $value
     * @return mixed|string
     */
    public static function check_deleted($value)
    {
        return $value ? $value : 'удален';
    }

    /**
     * Получение наименования статуса заявки
     * @param $status
     * @return string
     */
    public static function get_order_status_label($status)
    {
        $text = [
            0 => 'в ожидании',
            1 => 'выполнено',
            2 => 'истек срок действия',
            3 => 'отменена',
            4 => 'истекли попытки'
        ];

        return $text[$status];
    }

    /**
     * Форматирование номера телефона для вывода
     * @param $number
     * @return string
     */
    public static function get_print_phone($number)
    {
        if (strlen($number) != 10) {
            return !empty($number) ? ($number) : '';
        }
        $sArea = substr($number, 0, 3);
        $sPrefix = substr($number, 3, 3);
        $sNumber = substr($number, 6, 4);

        return "+7 ({$sArea}) {$sPrefix}-{$sNumber}";
    }
}