<?php

namespace app\service;

use app\Request;
use app\utils\JWTUtils;
use app\utils\Result;
use app\model\User as UserModel;

class UserService {

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function login() {
        // 验证用户名密码，通过则返回 jwttoken
        // 1. 验证用户是否存在

        $username = $this->request->param('username');
        $password = $this->request->param('password');

        $user = UserModel::where('username', $username)->find();
        if(!$user) {
            return Result::fail('not found account!');
        }
        // 2. 验证密码

        $user = UserModel::where([
            'username' => ['eq', $username],
            'password' => ['eq', $password]
        ])->find();

        
        if(!$user) {
            return Result::fail('password error!');
        }

        // 3. 验证用户状态

        if(!$user->status) {
            return Result::fail('account is disable!');
        }

        // 4. 组装 jwt token

        $data = [
            'username' => $user->username,
            'password' => $user->password
        ];

        $jwt_token = JWTUtils::encode($data);


        return Result::success(data:$jwt_token);
    }

    public function register() {
        
    }
    
    public function get($id) {
        return UserModel::selectById($id);
    }

    public function getAll() {
        return UserModel::selectAll();
    }
}