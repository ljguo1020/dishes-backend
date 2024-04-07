<?php

namespace app\utils;

class Code {
    public static function getCode() {
        return rand(100000, 999999);
    }
}