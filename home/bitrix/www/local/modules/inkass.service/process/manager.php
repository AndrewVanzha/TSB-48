<?
/**
 * @var $APPLICATION
 */

use Bitrix\Main\Application;
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

        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_post.json', json_encode($post));

        if (count($post) > 0) {
            switch ($post['action']) {
                case 'create_check':
                    global $USER;
                    $s_date = substr($post['check_date'], 0 , 10); // "21.09.2023 01:01:00"

                    $s_hours = substr($post['check_start_time'], 0 , 2);
                    $s_minutes = substr($post['check_start_time'], 3);
                    $start_time = $s_date . ' ' . $s_hours . ':' . $s_minutes . ':00';

                    $s_hours = substr($post['check_finish_time'], 0 , 2);
                    $s_minutes = substr($post['check_finish_time'], 3);
                    $finish_time = $s_date . ' ' . $s_hours . ':' . $s_minutes . ':00';
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_post_time.json', json_encode([$post['check_date'], $start_time, $finish_time]));
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_post_city_info.json', json_encode($post['city_info']));
                    $city_info = json_decode($post['city_info']);
                    //$city_info = (array)$city_info;
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_post_city_info2.json', json_encode($city_info));

                    $city_address = '';
                    //$ii = 0;
                    foreach ($city_info as $item) {
                        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_post_city_$item'.$ii++.'.json', json_encode($item));
                        //$property_name = 'name';
                        //$property_city = 'city';
                        //$property_address = 'address';
                        if ($item->{'name'} == $post['check_office']) {
                            $city_address = $item->{'city'} . ', ' . $item->{'address'};
                        }
                    }

                    $result = Order::create_order([
                        'inkass_id' => $USER->GetID(),
                        'inkass_fio' => \Bitrix\Main\Engine\CurrentUser::get()->getFullName(),
                        'check_date' => $post['check_date'],
                        'start_time' => $start_time,
                        'finish_time' => $finish_time,
                        'office' => $post['check_office'],
                        'address' => $city_address,
                        'fio' => $post['check_fio'],
                        'question_1' => $post['check_question_1'],
                        'question_1_comment' => $post['check_question_1_comment'],
                        'question_2' => $post['check_question_2'],
                        'question_2_comment' => $post['check_question_2_comment'],
                        'question_3' => $post['check_question_3'],
                        'question_3_comment' => $post['check_question_3_comment'],
                        'question_4' => $post['check_question_4'],
                        'question_4_comment' => $post['check_question_4_comment'],
                        'question_5' => $post['check_question_5'],
                        'question_5_comment' => $post['check_question_5_comment'],
                        'question_6' => $post['check_question_6'],
                        'question_6_comment' => $post['check_question_6_comment'],
                        'question_7' => $post['check_question_7'],
                        'question_7_comment' => $post['check_question_7_comment'],
                        'question_8' => $post['check_question_8'],
                        'question_8_comment' => $post['check_question_8_comment'],
                        'dop_comment' => $post['check_dop_comment'],
                        'action' => $post['action'],
                    ]);
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_manager_result.json', json_encode($result));

                    if ($result['success']) {
                        //LocalRedirect('/inkass.service/finish.php?check_id=' . $result['response']->getId());
                        //LocalRedirect('/inkass/finish.php?check_id=' . $result['response']->getId());
                        $resp = [
                            'success' => true,
                            'check_id' => $result['response']->getId(),
                        ];
                        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_manager_success_resp.json', json_encode($resp));
                        echo json_encode($resp);
                        //exit();
                    }

                    if ($result['error']) {
                        //LocalRedirect('/inkass.service/?error=' . $result['error']);
                        $resp = [
                            'error' => $result['error'],
                        ];
                        Logger::write('error', $result['error']);
                        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/a_inkass_manager_error_resp.json', json_encode($resp));
                        echo json_encode($resp);
                        //exit();
                    }

                    $result = urlencode(json_encode($result));
                    //LocalRedirect("/inkass.service/?page=create_order&result={$result}");
                    break;
                case 'cancel_order':
                    Order::cancel_order($post['order_id']);
                    LocalRedirect("/inkass.service/?page=order&id={$post['order_id']}");
                    break;
                case 'renew_code':
                    $order = Order::get_order(['id' => $post['order_id']]);
                    Code::renew_code($order);
                    LocalRedirect("/inkass.service/?page=order&id={$post['order_id']}");
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
                            LocalRedirect('/inkass.service/?page=order&id=' . $post['order_id']);
                        }

                        LocalRedirect("/inkass.service/?page=order&id={$post['order_id']}&error=" . urlencode(Order::ERROR_CODE));
                    }
                    LocalRedirect('/inkass.service/?page=order&id=' . $post['order_id']);
                    break;
            }
        }
    }
} catch (Exception $e) {
    Logger::write('error', $e->getMessage());
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php";
