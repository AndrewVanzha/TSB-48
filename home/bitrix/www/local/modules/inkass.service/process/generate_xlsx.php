<?
/**
 * @var $APPLICATION
 */

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Inkass\Service\Code;
use Inkass\Service\Entity\UsersTable;
use Inkass\Service\Event;
use Inkass\Service\General;
use Inkass\Service\Logger;
use Inkass\Service\Order;

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);
define("DisableEventsCheck", true);
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

try {
    if (Loader::IncludeModule("inkass.service")) {
        $request = Application::getInstance()->getContext()->getRequest();
        $get = $request->getQueryList();

        $get_params = [];
        if (count($get) > 0) {
            foreach ($get as $k => $v) {
                if ($v) {
                    $get_params[$k] = $v;
                }
            }
        } else {
            $get_params['period'] = date("d/m/Y", time() - 30 * 24 * 3600);
            $get_params['period'] = $get_params['period'] . ' - ';
            $get_params['period'] = $get_params['period'] . date("d/m/Y");
        }

        $params = Order::get_correct_filter_params($get_params);
        $orders = Order::get_orders($params)['data']->fetchAll();
        General::generate_xlsx($orders);
    }
} catch (Exception $e) {
    Logger::write('error', $e->getMessage());
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php";
