<?
/**
 * @var $APPLICATION
 */

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Verification\Service\Code;
use Verification\Service\Event;
use Verification\Service\Logger;
use Verification\Service\Order;

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);
define("DisableEventsCheck", true);
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

try {
    if (Loader::IncludeModule("verification.service")) {
        $request = Application::getInstance()->getContext()->getRequest();
        $post = $request->getPostList();

        if (count($post) > 0) {
            switch ($post['action']) {
                case 'create_order':
                    $result = Order::create_order([
                        'type' => $post['type'],
                        'abs_id' => $post['abs_id'],
                        'phone' => $post['phone'],
                        'email' => $post['email']
                    ]);

                    if ($result['success']) {
                        LocalRedirect('/verification.service/?page=order&id=' . $result['response']->getId());
                    }

                    $result = urlencode(json_encode($result));
                    LocalRedirect("/verification.service/?page=create_order&result={$result}");
                    break;
                case 'cancel_order':
                    Order::cancel_order($post['order_id']);
                    LocalRedirect("/verification.service/?page=order&id={$post['order_id']}");
                    break;
                case 'renew_code':
                    $order = Order::get_order(['id' => $post['order_id']]);
                    Code::renew_code($order);
                    LocalRedirect("/verification.service/?page=order&id={$post['order_id']}");
                    break;
                case 'check_code':
                    if (!empty($post['code'])) {
                        $code = Code::get_code(['order_id' => $post['order_id'], 'status' => 0, 'type' => 'phone']);
                        //if ($code['code'] == $post['code'] || $post['code'] == '0000') {
                        if ($code['code'] == $post['code']) {
                            Code::update_code($code['id'], ['status' => 1]);
                            Order::update_order($post['order_id'], ['status' => 1, 'status_phone' => 1]);
                            Event::add_event(['name' => 'success_sms_code', 'order_id' => $post['order_id']]);
                            Event::add_event(['name' => 'success_order', 'order_id' => $post['order_id']]);
                            LocalRedirect('/verification.service/?page=order&id=' . $post['order_id']);
                        }

                        LocalRedirect("/verification.service/?page=order&id={$post['order_id']}&error=" . urlencode(Order::ERROR_CODE));
                    }
                    LocalRedirect('/verification.service/?page=order&id=' . $post['order_id']);
                    break;
            }
        }
    }
} catch (Exception $e) {
    Logger::write('error', $e->getMessage());
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php";
