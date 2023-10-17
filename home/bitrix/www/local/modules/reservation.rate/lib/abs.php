<?php

namespace Reservation\Rate;

class ABS
{
    const ABS_API_URL = 'http://10.222.222.5856:8080/';

    const METHODS = [
        'add_order' => 'add/order'
    ];

    public static function send($method, $json)
    {
        $url = self::ABS_API_URL . self::METHODS[$method];
        $response = General::request($url, ['json' => $json]);
    }
}