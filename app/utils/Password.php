<?php

namespace app\utils;

class Password {
    public static function encode($password, $salt) {
        return md5($password . $salt);
    }
}