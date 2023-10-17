<?php

namespace Inkass\Service;

use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\ORM\Query\Result;
use Bitrix\Main\Type\DateTime;
use Exception;
use Inkass\Service\Entity\EventTable;

class Event
{
    const check_inkass_create = "Создан чек-лист";
    const check_email_sent = "Отправлено email-уведомление";
    const email_inkass_create = "Создана заявка на верификацию email";
    const phone_inkass_create = "Создана заявка на верификацию номера телефона";
    const send_sms_code = "Отправлен смс-код для верификации";
    const success_sms_code = "Смс-код подтвержден";
    const error_sms_code = "Введен некоррктный код смс-подтверждения";
    const send_email_code = "Отправлена ссылка для верификации на email-адрес";
    //const success_order = "Заявка выполнена";
    const success_order = "Чек-лист заполнен";
    //const expired_order = "Истекло время действия заявки, заявка закрыта";
    const expired_order = "Истекло время чек-листа, чек-лист закрыт";
    //const cancel_order = "Заявка отменена";
    const cancel_order = "Чек-лист отменен";
    const attempts_expired_order = "Истекли попытки на ввод кода, заявка закрыта";
    const email_open = "Произведен переход по ссылке из email";
    const captcha_success = "Капча успешно пройдена";

    /**
     * Получение списка событий по параметрам
     * @param $params
     * @return Result
     * @throws Exception
     */
    public static function get_events($params)
    {
        return EventTable::getList(array(
            "filter" => $params,
            "order" => ['date' => 'asc']
        ));
    }

    /**
     * @param $params
     * @return AddResult
     * @throws Exception
     */
    public static function add_event($params)
    {
        $params += [
            'date' => new DateTime(),
            'message' => constant('Inkass\Service\Event::'.$params['name'])
        ];

        return EventTable::add($params);
    }
}