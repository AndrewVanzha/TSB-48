<?

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
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
        if (
            !empty($request->getPost('buy-usd'))
            && !empty($request->getPost('sell-usd'))
            && !empty($request->getPost('buy-eur'))
            && !empty($request->getPost('sell-eur'))
        ) {
            session_start();
            $_SESSION['RR_BUY_USD'] = $request->getPost('buy-usd');
            $_SESSION['RR_SELL_USD'] = $request->getPost('sell-usd');
            $_SESSION['RR_BUY_EUR'] = $request->getPost('buy-eur');
            $_SESSION['RR_SELL_EUR'] = $request->getPost('sell-eur');
            $_SESSION['RR_TIME'] = time();
        }
    }
} catch (Exception $e) {
    Logger::write('error', $e->getMessage());
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php";
