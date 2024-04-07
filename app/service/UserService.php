<?php

namespace app\service;

use app\enum\EmailTemplate;
use app\Request;
use app\utils\JWTUtils;
use app\utils\Result;
use app\model\User as UserModel;
use app\utils\Code;
use app\utils\Password;
use app\utils\SendEmail;
use think\facade\Cache;

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

        $salt = $user->salt;
        $password = Password::encode($password, $salt);
        if($password != $user->password) {
            return Result::fail('password error!');
        }

        // 3. 验证用户状态

        if(!$user->status) {
            return Result::fail('account is disable!');
        }

        // 4. 组装 jwt token



        $data = [
            'username' => $user->username,
            'role_id' => $user->role_id
            // 'password' => $user->password
        ];

        $jwt_token = JWTUtils::encode($data);


        return Result::success(data:$jwt_token);
    }

    public function register() {

        $username = $this->request->param('username');
        $password = $this->request->param('password');
        $email = $this->request->param('email');
        $code = $this->request->param('code');


        // 验证账户是否存在
        $user = UserModel::where('username', $username)->find();

        if($user) {
            return Result::fail('account already register!');
        }

        // 校验验证码

        if(!($code && $code == Cache::get('code:' . $email))) {
            return Result::fail('cade is invalid!');
        }

        // 密码加密

        // 生成随机 slat
        $salt = uniqid();
        $password = Password::encode($password, $salt);
        // 注册账号
        // username, password, status, role_id, salt
        $status = 1;
        $role_id = 2;
        $r = UserModel::create(compact('username', 'password', 'status', 'role_id', 'salt'));

        return Result::success();
    }

    /**
     * 获取验证码
     */
    public function getCode() {
        $email = $this->request->param('email');

        // 获取验证码，存入缓存, 设置 30 min 有效期
 
        $_code = Code::getCode();

        Cache::set('code:' . $email, $_code, 30 * 60);

        // 发送邮件
        $sendEmail =  new SendEmail();
        $sendEmail->send($email, EmailTemplate::CODE, function() use ($_code) {
            return $_code;
        });
    }
    
    public function get($id) {
        return UserModel::selectById($id);
    }

    public function getAll() {
        return UserModel::selectAll();
    }
}