<?
/**
 * @var $APPLICATION
 */

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Inkass\Service\Code;
use Inkass\Service\Event;
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
        $post = $request->getPostList();
        $check_captcha_var = true;
        $check_sms_var = true;

        if (count($post) > 0) {
            // проверка капчи
            if ($post["captcha_code"] && $post["captcha_id"] && $post["order_id"]) {
                if ($APPLICATION->CaptchaCheckCode($post["captcha_code"], $post["captcha_id"])) {
                    Order::update_order($post["order_id"], ['status_captcha' => 1]);
                    Event::add_event(['name' => 'captcha_success', 'order_id' => $post["order_id"]]);
                    $check_captcha_var = true;
                    //LocalRedirect("/inkass.service/?h={$post["order_hash"]}");
                } else {
                    $check_captcha_var = false;
                    //LocalRedirect("/inkass.service/?h={$post["order_hash"]}&error=" . urlencode(Order::ERROR_CAPTCHA));
                }
            }
            //проверка кода из смс
            if ($post['action'] && $post['action'] === 'check_code' && $post['code']) {
                $code = Code::get_code(['order_id' => $post["order_id"], 'status' => 0, 'type' => 'phone']);
                //if ($code && $code['code'] == $post['code'] || $post['code'] == '0000') {
                if ($code && $code['code'] == $post['code']) {
                    Code::update_code($code['id'], ['status' => 1]);
                    Order::update_order($post["order_id"], ['status_phone' => 1]);
                    Event::add_event(['name' => 'success_sms_code', 'order_id' => $post["order_id"]]);
                    $check_sms_var = true;
                    //LocalRedirect("/inkass.service/?h={$post["order_hash"]}");
                } else {
                    $attempts = (int)$code['attempts'];
                    Code::update_code($code['id'], ['attempts' => ++$attempts]);
                    Event::add_event(['name' => 'error_sms_code', 'order_id' => $post["order_id"]]);

                    if ($attempts === (int)Option::get('inkass.service', 'other_count_key')) {
                        Order::cancel_order($code['order_id'], 4);
                    }

                    $check_sms_var = false;
                    //LocalRedirect("/inkass.service/?h={$post["order_hash"]}&error=" . urlencode(Order::ERROR_CODE));
                }
            }
            // итоги
            if ($check_captcha_var && $check_sms_var) {
                LocalRedirect("/inkass.service/?h={$post["order_hash"]}");
            }
            if (!$check_captcha_var) {
                LocalRedirect("/inkass.service/?h={$post["order_hash"]}&error=" . urlencode(Order::ERROR_CAPTCHA));
            }
            if (!$check_sms_var) {
                LocalRedirect("/inkass.service/?h={$post["order_hash"]}&error=" . urlencode(Order::ERROR_CODE));
            }
        }
    }
} catch (Exception $e) {
    Logger::write('error', $e->getMessage());
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php";
