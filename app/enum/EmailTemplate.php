<?php

namespace app\enum;

enum EmailTemplate :string{
    // 验证码
    case CODE = 'code';

    // 菜品详情
    case ORDER_DETAIL = 'order_detail';
}