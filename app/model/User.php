<?php

namespace app\model;

use think\Model;

class User extends Model {

    public static function selectById($id) {
        return self::where('id', $id)->find();
    }

    public static function selectAll() {
        return self::find();
    }
}