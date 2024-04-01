<?php
namespace app\controller;

use app\BaseController;
use app\model\User as UserModel;
use app\Request;

use app\utils\JWTUtils;
use app\utils\Result;

class User extends BaseController {

    public function login(Request $request) {
        // 验证用户名密码，通过则返回 jwttoken
        // 1. 验证用户是否存在

        $username = $request->param('username');
        $password = $request->param('password');




        $user = UserModel::where('username', $username)->select();
        if(!$user) {
            return Result::fail('not found user!');
        }

        // 2. 验证密码

        $user = UserModel::where([
            'username' => ['eq', $username],
            'password' => ['eq', $password]
        ])->select();

        if(!$user) {
            return Result::fail('password error!');
        }

        // 3. 验证用户状态


        // 4. 组装 jwt token

        
        return 

    }

    public function get($id) {
        if($id) {
            return UserModel::select();
        } else {
            return UserModel::where('id', $id)->select();
        }
    }
}
