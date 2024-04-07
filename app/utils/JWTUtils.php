<?php

namespace app\utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTUtils {

    private static $key = 'HS256';
    private static $sign = 'ljguo1020';

    public static function decode($token) {
        $decoded = JWT::decode($token, new Key(static::$sign, static::$key));
        return $decoded;
    }


    public static function encode($payload) {
        $payload['exp'] = time() + (7 * 24 * 60 * 60); // 7 天过期时间
        $payload['iat'] = time();
        $jwt_token = JWT::encode($payload, static::$sign, static::$key);
        return $jwt_token;
    }

}