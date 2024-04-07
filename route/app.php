<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;


Route::group('user', function () {
    Route::get('get/:id', 'user/get');
    Route::get('get', 'user/getAll');
})->middleware('auth', 'admin');


Route::group(function() {
    Route::post('login', 'user/login');
    Route::post('register', 'user/register');
    Route::get('getcode', 'user/getcode');
});




