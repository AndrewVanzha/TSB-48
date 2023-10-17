<?php

namespace Reservation\Rate;

use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Web\HttpClient;

class Payment
{
    const SHOP_GATEWAY_LIVE = 'https://secure.openbank.ru/payment';
    const SHOP_GATEWAY_TEST = 'https://securetest.openbank.ru/testpayment';
    const SHOP_GATEWAY_API_REGISTER = '/rest/registerPreAuth.do';
    const SHOP_GATEWAY_API_STATUS = '/rest/getOrderStatus.do';
    const SHOP_GATEWAY_RETURN_URL = '/bitrix/reservation.rate/result.php';

    private $login;
    private $password;
    private $mode;
    private $apiUrl;

    /**
     * Payment constructor.
     * @throws ArgumentNullException
     */
    public function __construct()
    {
        $this->login = Option::get('reservation.rate', 'open_bank_login');
        $this->password = Option::get('reservation.rate', 'open_bank_pass');
        $this->mode = Option::get('reservation.rate', 'open_bank_mode');

        if ($this->mode === 'Y') {
            $this->apiUrl = self::SHOP_GATEWAY_TEST;
        } else {
            $this->apiUrl = self::SHOP_GATEWAY_LIVE;
        }
    }

    /**
     * Создание нового заказа на оплату
     *
     * @param $params
     *  [
     *      'order_number' - номер заказа в системе
     *      'amount' - сумма
     *  ]
     * @return array
     */
    public function registerOrder($params)
    {
        $params['userName'] = $this->login;
        $params['password'] = $this->password;
        $params['returnUrl'] = 'https://' . SITE_SERVER_NAME . self::SHOP_GATEWAY_RETURN_URL;
        $params['description'] = 'Оплата обеспечительного платежа для резервирования курса валюты на сайте банка Транстройбанк.';

        $url = $this->apiUrl . self::SHOP_GATEWAY_API_REGISTER;

        return $this->makeRequest($url, $params);
    }

    /**
     * Проверка статуса заказа
     *
     * @param $orderID
     * @return array
     */
    public function checkStatus($orderID)
    {
        $url = $this->apiUrl . self::SHOP_GATEWAY_API_STATUS;

        $params['userName'] = $this->login;
        $params['password'] = $this->password;
        $params['orderId'] = $orderID;

        return $this->makeRequest($url, $params);
    }

    /**
     * Выполнение запроса к API банка "Открытие"
     * @param $url
     * @param $params
     * @return array
     */
    private function makeRequest($url, $params)
    {
        $httpClient = new HttpClient();
        $httpClient->setHeader('Content-Type', 'application/x-www-form-urlencoded');
        $httpClient->post($url, $params);

        if ($httpClient->getStatus() !== 200) {
            return [
                'errorCode' => 500,
                'errorMessage' => 'Не удалось подключиться к API эквайринга'
            ];
        }

        return json_decode($httpClient->getResult(), true);
    }
}