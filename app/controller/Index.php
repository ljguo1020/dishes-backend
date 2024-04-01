<?php

namespace app\controller;

use app\BaseController;
use app\model\User;
use app\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;


class Index extends BaseController
{
    public function index(Request $request)
    {


        // return User::select();

        halt(User::select());exit;
        return $request->token;
        // $key = 'example_key';
        // $payload = [
        //     'username' => 'ljguo',
        //     'password' => 'sss',
        //     'exp' => time() + (1 * 60)
        // ];
        
        // // $jwt = JWT::encode($payload, $key, 'HS256');
        
        // // echo $jwt;exit;
        // ExpiredException

        // $decoded = JWT::decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImxqZ3VvIiwicGFzc3dvcmQiOiJzc3MiLCJleHAiOjE3MTEwOTQzMjV9.5WvPMq_1eulel2JRIpYa2c2iMNy5zTDt6kG1566mDGo', new Key($key, 'HS256'));
        // dump($decoded);
    }

    public function hello($name = 'ThinkPHP8')
    {
        return 'hello,' . $name;
    }

    public function login() {
        
    }
}




