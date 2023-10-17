<?

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Reservation\Rate\Entity\OrdersTable;
use Reservation\Rate\General;
use Reservation\Rate\Logger;

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);
define("DisableEventsCheck", true);
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

try {
    if (Loader::IncludeModule("reservation.rate")) {
        $request = Application::getInstance()->getContext()->getRequest();
        $orderId = $request->get('orderId');
        $orderNumber = $request->get('orderNumber');
        $mdOrder = $request->get('mdOrder');
        $operation = $request->get('operation');
        $status = $request->get('status');

        $type = [
            2 => 'Покупка',
            1 => 'Продажа'
        ];

        Logger::write('rbs', json_encode([
            'referer' => $_SERVER['HTTP_REFERER'],
            'orderId' => $orderId,
            'mdOrder' => $mdOrder,
            'orderNumber' => $orderNumber,
            'operation' => $operation,
            'status' => $status,
        ]));

        if (!empty($orderId)) {
            $payId = $orderId;
        } elseif ($operation === 'approved' && $status == 1 && !empty($mdOrder)) {
            $payId = $mdOrder;
        }

        if (!empty($payId)) {
            $status = General::get_payment_status($payId);
            if ($status == 1) {
                $order = OrdersTable::getRow(array(
                    "filter" => array(
                        'NUM_PAY' => $orderId,
                    ),
                ));

                if ($order['STATUS'] == 0) {

                    General::success_pay($order);

                    OrdersTable::updateOrder($order['ID'], $status);
                }

                if (!empty($orderId)) {
                    LocalRedirect(
                        '/bitrix/reservation.rate/success.php?order_id=' . $order['ID'] .
                        '&type=' . $type[$order['REQUEST_TYPE']] .
                        '&rate=' . $order['KURS'] .
                        '&currency=' . $order['CURVAL'] .
                        '&amount=' . $order['SUMMCALL'] .
                        '&amount-rub=' . $order['SUMMTOCLIENT'] .
                        '&amount-security=' . $order['SUMSECPAY'] .
                        '&expired=' . $order['TIMELIMIT']
                    );
                }
            }
        }

        if (!empty($orderId)) {
            LocalRedirect('/bitrix/reservation.rate/false.php');
        }
    }
} catch (LoaderException $e) {
} catch (Exception $e) {
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php";