<?php

namespace app\controller;

use app\BaseController;
use app\service\UserService;

class User extends BaseController
{

    public $userService;

    public function __construct()
    {
        $this->userService = invoke(UserService::class);
    }

    public function login()
    {
        return $this->userService->login();
    }

    public function register() {
        
    }

    public function get($id)
    {
        return $this->userService->get($id);
    }

    public function getAll()
    {
        return $this->userService->getAll();
    }
}
