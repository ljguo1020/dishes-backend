<?php

namespace app\utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use app\utils\Result;

class JWTUtils {

    private static $key = 'HS256';
    private static $sign = 'ljguo1020';

    public static function decode($token) {
        $decoded = JWT::decode($token, new Key(static::$sign, static::$key));
        return $decoded;
    }


    public static function encode($payload) {
        $payload['exp'] = time() + (10 * 60);
        $jwt_token = JWT::encode($payload, static::$sign, static::$key);
        return $jwt_token;
    }






}