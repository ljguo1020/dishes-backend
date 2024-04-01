<?php
declare (strict_types = 1);

namespace app\middleware;


use app\utils\Result;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;




/**
 * 登录权限校验
 */
class Auth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $jwt_token = $request->header('Authorization');

        // 判断是否存在 Authorization 字段
        if(!$jwt_token) {
            return Result::send(401, 'Unauthorized!');
        }

        // 检验 token 合法性



        $request->token = $jwt_token;
            
        return $next($request);


    }
}
