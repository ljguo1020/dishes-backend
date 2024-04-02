<?php

namespace app\utils;

class Result {
    public static function success(?string $message = 'request success', array | string $data = null) {

        $code = 200;
        $return_data = [
            'code' => $code,
            'message' => $message, 
            'data' => $data
        ];

        return json($return_data, $code);
    }


    public static function fail(?string $message = 'fail success', object | string $data = null) {

        $code = 500;
        $return_data = [
            'code' => $code,
            'message' => $message, 
            'data' => $data
        ];

        return json($return_data, $code);
    }


    public static function send(int $code, string $message, object | string $data = null) {
        $return_data = [
            'code' => $code,
            'message' => $message, 
            'data' => $data
        ];

        return json($return_data, $code);
    }
}