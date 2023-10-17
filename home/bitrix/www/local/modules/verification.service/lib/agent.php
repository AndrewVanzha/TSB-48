<?php

namespace Verification\Service;

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
        $codes = Code::get_code_all(['status' => 0]);
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
        }

        return "\Verification\Service\Agent::check();";
    }
}