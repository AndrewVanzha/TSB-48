<?php

namespace Reservation\Rate;

use Bitrix\Main\ArgumentException;
use DateTime;
use Exception;
use Reservation\Rate\Entity\OrdersTable;

class Agent
{
    /**
     * Проверка оплат
     * @throws ArgumentException
     * @throws Exception
     */
    public static function check()
    {
        $orders = OrdersTable::getList(array(
            "filter" => array(
                'STATUS' => 0,
            ),
        ));

        while ($order = $orders->fetch()) {
            $status = General::get_payment_status($order['NUM_PAY']);
            $db_status = 0;

            if ($status == 1):
                General::success_pay($order);
                $db_status = 1;
            else:
                $expire_date = new DateTime($order['TIMEIN']);
                $expire_date = $expire_date->getTimestamp() + 3600;
                $current_date = new DateTime();

                if ($current_date->getTimestamp() > $expire_date) {
                    $db_status = 3;
                }
            endif;

            if ($db_status !== 0) {
                OrdersTable::updateOrder($order['ID'], $db_status);

                Logger::write('rbs', json_encode([
                    'type' => 'cron',
                    'orderId' => $order['NUM_PAY'],
                    'status' => $status,
                ]));
            }
        }

        return "\Reservation\Rate\Agent::check();";
    }
}