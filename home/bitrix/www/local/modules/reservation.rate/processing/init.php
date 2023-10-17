<?

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
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
        $params = [];
        $params_require = [
            'type',
            'currency',
            'rate',
            'amount',
            'amount-rub',
            'amount-security',
            'fname',
            'sname',
            'mname',
            'phone',
            'email'
        ];
        $correct_type = [
            'buy' => 2,
            'sell' => 1
        ];
        $requestArray = [
            'type' => $request->getPost('type'),
            'rate' => $request->getPost('rate'),
            'amount' => $request->getPost('amount'),
            'fio' => $request->getPost('fio'),
            'phone' => $request->getPost('phone'),
            'email' => $request->getPost('email'),
            'currency' => $request->getPost('currency')
        ];

        if (!empty($request->getPost('type'))
            && in_array($request->getPost('type'), ['buy', 'sell'])) {
            $params['type'] = $correct_type[$request->getPost('type')];
        }

        if (!empty($request->getPost('currency'))
            && in_array($request->getPost('currency'), ['USD', 'EUR'])) {
            $params['currency'] = $request->getPost('currency');
        }

        if (!empty($request->getPost('rate'))
            && General::validate('number', $request->getPost('rate'))) {
            $params['rate'] = str_replace(',', '.', $request->getPost('rate'));
        }

        if (!empty($request->getPost('amount'))
            && General::validate('number', $request->getPost('amount'))) {
            $params['amount'] = str_replace(',', '.', $request->getPost('amount'));
        }

        if (!empty($request->getPost('fio'))
            && General::validate('fio', $request->getPost('fio'))) {
            $fio = explode(' ', trim($request->getPost('fio')));

            if (!empty($fio[1])) {
                $params['fname'] = $fio[1];
            } else {
                $params['fname'] = 'Не указано';
            }

            if (!empty($fio[0])) {
                $params['sname'] = $fio[0];
            } else {
                $params['sname'] = 'Не указано';
            }

            if (!empty($fio[2])) {
                $params['mname'] = $fio[2];
            } else {
                $params['mname'] = 'Не указано';
            }
        }

        if (!empty($request->getPost('phone'))) {
            $phone = General::correct_phone(trim($request->getPost('phone')));
            if (strlen($phone) === 10) {
                $params['phone'] = $phone;
            }
        }

        if (!empty($request->getPost('email'))) {
            $email = General::validate('email', trim($request->getPost('email')));
            if (!empty($email)) {
                $params['email'] = $email;
            }
        }

        if ($session_rate = $_SESSION['RR_' . strtoupper($request->getPost('type')) . '_' . strtoupper($request->getPost('currency'))]) {
            $session_rate = str_replace(',', '.', $session_rate);
            if ($session_rate == $params['rate']) {
                $params['amount-rub'] = round(($params['rate'] * $params['amount']) * 100) / 100;
                $params['amount-security'] = round((($params['amount-rub'] * 4) / 100) * 100) / 100;
            }
        }

        if (time() > (int)$_SESSION['RR_TIME'] + 300) {
            $requestArray['message'] = 'Время сессии истекло, повторите попытку';
            LocalRedirect('/chastnym-klientam/rezervirovanie-kursa/?' . http_build_query($requestArray) . '#form',
                true);
        }

        if (!General::check_correct_course($params['rate'], $params['currency'], $request->getPost('type'))) {
            $requestArray['message'] = 'Возникла ошибка с курсом валюты, повторите попытку';
            LocalRedirect('/chastnym-klientam/rezervirovanie-kursa/?' . http_build_query($requestArray) . '#form',
                true);
        }

        foreach ($params_require as $param) {
            if (empty($params[$param])) {
                LocalRedirect('/bitrix/reservation.rate/false.php', true);
            }
        }

        $orderId = General::add_order_to_db($params);

        if ($orderId) {
            $payment = General::get_payment_url($orderId, $params);

            if ($payment) {
                General::update_pay_num_to_db($orderId, $payment['orderId']);

                LocalRedirect($payment['formUrl'], true);
            }

            LocalRedirect('/bitrix/reservation.rate/false.php', true);
        }
    }
} catch (LoaderException $e) {
    Logger::write('error', $e->getMessage());
} catch (Exception $e) {
    Logger::write('error', $e->getMessage());
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php";
