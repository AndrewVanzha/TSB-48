<?php

namespace Reservation\Rate;

use Bitrix\Main\Mail\Event;
use Bitrix\Main\Type\DateTime;
use CEvent;
use Exception;
use Reservation\Rate\Entity\OrdersTable;

class General
{
    public static function request($url, $params)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64)");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }

    /**
     * Добавление заказа в базу данных
     *
     * @param $params
     * @return int
     * @throws Exception
     */
    public static function add_order_to_db($params)
    {
        $result = OrdersTable::add(array(
            'SUMMCALL' => $params['amount'],
            'KURS' => $params['rate'],
            'SUMMTOCLIENT' => $params['amount-rub'],
            'SUMSECPAY' => $params['amount-security'],
            'TIMEIN' => new DateTime(date("d.m.Y H:i:s", time())),
            'TIMELIMIT' => new DateTime(self::get_date_expire()),
            'FNAME' => $params['fname'],
            'SNAME' => $params['sname'],
            'MNAME' => $params['mname'],
            'TEL' => $params['phone'],
            'EMAIL' => $params['email'],
            'STATUS' => OrdersTable::STATUS_ACTIVE,
            'REQUEST_TYPE' => $params['type'],
            'CURVAL' => $params['currency'],
            'IDCASH' => 10013
        ));

        return $result->getId();
    }

    /**
     * @param $id
     * @param $payId
     * @return bool
     * @throws Exception
     */
    public static function update_pay_num_to_db($id, $payId)
    {
        OrdersTable::Update($id, array(
            'NUM_PAY' => $payId,
        ));

        return true;
    }

    /**
     * Получение платежной ссылки
     *
     * @param $order_id
     * @param $params
     * @return array|bool
     */
    public static function get_payment_url($order_id, $params)
    {
        $payment = new Payment();

        $result = $payment->registerOrder(
            [
                'orderNumber' => $order_id,
                'amount' => $params['amount-security'] * 100
            ]
        );

        if (!empty($result['orderId']) && !empty($result['formUrl'])) {
            return $result;
        }

        return false;
    }

    /**
     * Проверка статуса оплаты
     *
     * @param $payId
     * @return int
     */
    public static function get_payment_status($payId)
    {
        $payment = new Payment();
        $status_payment = $payment->checkStatus($payId);

        if (!empty($status_payment['OrderStatus'])) {
            return $status_payment['OrderStatus'];
        }

        return 0;
    }

    /**
     * Отправка СМС клиенту
     * @param $data
     * @return bool
     * @throws Exception
     */
    public static function send_sms_message($data)
    {
        $sms = new Sms();
        $result_sms = $sms->send(
            $data['phone'],
            array(
                'id' => $data['id'],
                'expired' => $data['expired'],
                'amount' => $data['amount']
            )
        );

        return $result_sms['errorCode'] === 0;
    }

    /**
     * Отправка email-уведомления
     * @param $params
     */
    public static function send_email($params)
    {
        self::send_email_event($params, 'RESERVATION_RATE_ORDER');
        self::send_email_event($params, 'RESERVATION_RATE_ORDER_CLIENT');
    }

    /**
     * Отправка уведомления по типу события
     *
     * @param $params
     * @param $event
     */
    private static function send_email_event($params, $event)
    {
        $args = array(
            "EVENT_NAME" => $event,
            "LID" => "s1",
            "C_FIELDS" => $params
        );

        Event::send($args);
    }

    /**
     * Экспорт заявок для АБС
     * @param $order
     */
    public static function export_from_abs($order)
    {
        $output = json_encode($order, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $full_date = explode(' ', $order['date']);
        $date_parse = explode('.', $full_date[0]);
        $date = $date_parse[2] . $date_parse[1] . $date_parse[0];
        $time = str_replace(':', '', $full_date[1]);
        $filename = "ex_{$date}_{$time}_{$order['idref']}";

        file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/bitrix/export-abs/reservation.rate/{$filename}.json", $output);
    }

    /**
     * Действия при успешной оплате
     * @param $order
     * @throws Exception
     */
    public static function success_pay($order)
    {
        $type = [
            2 => 'Покупка',
            1 => 'Продажа'
        ];

        self::send_sms_message([
            'id' => $order['ID'],
            'expired' => $order['TIMELIMIT'],
            'amount' => number_format($order['SUMMTOCLIENT'], 2, '.', ' '),
            'phone' => $order['TEL']
        ]);

        $name = '';
        if ($order['SNAME'] !== 'Не указано') {
            $name .= $order['SNAME'] . ' ';
        }
        if ($order['FNAME'] !== 'Не указано') {
            $name .= $order['FNAME'] . ' ';
        }
        if ($order['MNAME'] !== 'Не указано') {
            $name .= $order['MNAME'];
        }

        self::send_email([
            'DATE_CREATE' => $order['TIMEIN'],
            'DATE_EXPIRED' => $order['TIMELIMIT'],
            'NAME' => $name,
            'PHONE' => $order['TEL'],
            'EMAIL' => $order['EMAIL'],
            'ID' => $order['ID'],
            'TYPE' => $type[$order['REQUEST_TYPE']],
            'CURRENCY' => $order['CURVAL'],
            'RATE' => $order['KURS'],
            'AMOUNT' => $order['SUMMCALL'],
            'AMOUNT_RUB' => $order['SUMMTOCLIENT'],
            'AMOUNT_SECURE' => $order['SUMSECPAY']
        ]);

        self::export_from_abs([
            "sum" => (string)$order['SUMMCALL'],
            "rate" => (string)$order['KURS'],
            "date" => (string)$order['TIMEIN'],
            "fname" => (string)$order['FNAME'],
            "sname" => (string)$order['SNAME'],
            "mname" => (string)$order['MNAME'],
            "phone" => '+7' . (string)$order['TEL'],
            "type" => (int)$order['REQUEST_TYPE'],
            "iso" => (string)$order['CURVAL'],
            "idcash" => 10013,
            "idref" => (int)$order['ID'],
            "secpay" => (string)$order['SUMSECPAY']
        ]);
    }


    /**
     * Получение корректной даты истечения резерва
     *
     * @return false|string
     */
    private static function get_date_expire()
    {
        $time = time();

        switch (date('w', $time)) {
            case 5:
                $day = 3;
                break;
            case 6:
                $day = 2;
                break;
            default:
                $day = 1;
        }

        $timestamp = mktime(
            23,
            59,
            59,
            date('m', $time),
            date('d', $time) + $day,
            date('Y', $time)
        );

        return date("d.m.Y H:i:s", $timestamp);
    }

    /**
     * Валидация данных
     *
     * @param $type
     * @param $value
     * @return bool|false|int
     */
    public static function validate($type, $value)
    {
        switch ($type) {
            case 'number':
                return self::validate_number($value);
            case 'fio':
                return self::validate_fio($value);
            case 'email':
                return self::validate_email($value);
            default:
                return false;
        }
    }

    /**
     * Валидация на число
     * @param $value
     * @return false|int
     */
    private static function validate_number($value)
    {
        return preg_match('/^[0-9]*[.,]?[0-9]+$/', $value);
    }

    /**
     * Валидация на ФИО
     * @param $value
     * @return false|int
     */
    private static function validate_fio($value)
    {
        return preg_match('/^([а-яёa-z ]+)$/iu', $value);
    }

    /**
     * Удаление лишнего из номера телефона
     *
     * @param $phone
     * @return false|string
     */
    public static function correct_phone($phone)
    {
        $only_integer = preg_replace('~\D+~', '', $phone);

        return substr($only_integer, -10);
    }

    /**
     * Валидация email
     *
     * @param $value
     * @return bool
     */
    private static function validate_email($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $value;
        }

        return false;
    }

    /**
     * Проверка корректности курса валюты
     * @param $rate
     * @param $cur
     * @param $type
     * @return bool
     */
    public static function check_correct_course($rate, $cur, $type)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/currency/history/';
        $filename = date('dmY') . '_rate.json';

        if (!file_exists($path . $filename)) {
            return false;
        }

        $rates = json_decode(file_get_contents($path . $filename), true);
        $rates_cur = $rates['10013'][$cur];
        $last_course_one = end($rates_cur);
        $last_course_two = prev($rates_cur);
        $correct_type = $type == 'buy' ? 'sell' : 'buy';

        return $rate == $last_course_one[$correct_type] || $rate == $last_course_two[$correct_type];
    }
}