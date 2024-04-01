<?php

namespace app\utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use app\utils\Result;

class JWTUtils {

    private static $key = 'ljguo1020';
    private static $sign = 'HS256';

    public static function decode($token) {
        try {
            $decoded = JWT::decode($token, new Key(static::$key, static::$sign));
        } catch(ExpiredException $e) {
            return Result::send(401, 'Expired token!');
        } 

    }






}