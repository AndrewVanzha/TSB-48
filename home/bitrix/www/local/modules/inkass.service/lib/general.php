<?php

namespace Inkass\Service;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Mail\Event;
use CUser;
use Exception;
use Inkass\Service\Entity\UsersTable;

class General
{
    private static $module_id = 'inkass.service';
    private static $questions_list = [  //  максимум = 10, иначе расширять БД
        0 => '1. Присутствие кассира в установленное время в кассе',
        1 => '2. Правильность обслуживание клиентов:<br>- паспорт при 40 000 руб.<br>- выдача справки',
        2 => '3. Сохранность ДС в установленном порядке:<br>- денежный ящик<br>- сейф',
        3 => '4. Порядок снятия / постановки на ОПС',
        4 => '5. Хранение личных вещей и ДС в отдельном шкафу',
        5 => '6. Закрытие кассы на все установленные замки',
        6 => '7. Исправность системы внутреннего видеонаблюдения и ее использование кассиром',
        7 => '8. Соблюдение порядка запуска инкассаторов в помещение кассового узла.',
    ];

    /**
     * Запрос по API
     * @param $url
     * @param $params
     * @return mixed
     */
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
     * Проверка доступа к сервису
     * @param $hash
     * @return int
     * @throws Exception
     */
    public static function check_access($hash)
    {
        global $USER;
        $user_id = $USER->GetParam('USER_ID');

        if ($user_id) {
            $user_groups = CUser::GetUserGroup($user_id);
            $group_validate_id = Option::get(self::$module_id, "group_id");

            if (in_array($group_validate_id, $user_groups)) {
                return 1;
            }
        }

        return self::valid_code('email', $hash) ? 2 : 0;
    }

    /**
     * Выдыча вопросов для сервиса
     *
     * @return array
     */
    public static function get_questions_list()
    {
        return self::$questions_list;
    }

    /**
     * Проверка email/смс кода на валидность
     * @param $type
     * @param $code
     * @return bool
     * @throws Exception
     */
    public static function valid_code($type, $code)
    {
        if (!$code) {
            return false;
        }

        if (Code::get_code(['code' => $code, 'type' => $type])) {
            return true;
        }

        return false;
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
            $data['code']
        );

        return $result_sms['errorCode'] === 0;
    }

    /**
     * Отправка email-уведомления
     * @param $params
     */
    public static function send_email($params)
    {
        return self::send_email_event($params['params'], 'S_INKASS_ORDER');
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

        return Event::send($args);
    }

    /**
     * Генерация отчета в xlsx
     * @param $data
     * @throws Exception
     */
    public static function generate_xlsx($data)
    {
        $header_styles = array(
            'freeze_rows' => true,
            'font' => 'Arial',
            'font-size' => 10,
            'font-style' => 'bold',
            'fill' => '#ffff00',
            'halign' => 'center',
            'border' => 'left,right,top,bottom',
            'border-style' => 'thin',
            'widths' => [7, 20, 20, 9, 20, 20, 20]
        );

        $row_styles = array(
            'font' => 'Arial',
            'font-size' => 10,
            'halign' => 'center',
            'border' => 'left,right,bottom',
            'border-style' => 'thin'
        );

        $sheet1header = array(
            '№' => 'integer',
            'Дата заявки' => 'DD/MM/YYYY HH:MM:SS',
            'Тип заявки' => 'string',
            'АБС код' => 'integer',
            'Номер телефона' => 'string',
            'Email-адрес' => 'string',
            'Статус заявки' => 'string',
        );

        $writer = new XLSXWriter();
        $writer->writeSheetHeader('BasicFormats', $sheet1header, $header_styles);

        foreach ($data as $item) {
            $user = UsersTable::get_user(['id' => $item['user_id']]);
            $output = [];
            $output[0] = (int)$item['id'];
            $output[1] = $item['date']->format('Y-m-d H:i:s');
            $output[2] = Order::get_order_type_label($item['type']);
            $output[3] = (int)$user['abs_id'];
            $output[4] = Order::get_print_phone($item['phone_number']);
            $output[5] = $item['email'];
            $output[6] = Order::get_order_status_label($item['status']);
            $writer->writeSheetRow('BasicFormats', $output, $row_styles
            );
        }

        $file_name = 'export_' . date('dmYHis') . '.xlsx';
        $writer->download($file_name);
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
}