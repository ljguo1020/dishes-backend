<?php
declare (strict_types = 1);

namespace app\middleware;


use app\utils\Result;
use app\utils\JWTUtils;
use think\facade\Db;

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
    public function handle($request, \Closure $next, $role, $permissions)
    {
        $jwt_token = $request->header('Authorization');

        // 判断是否存在 Authorization 字段
        if(!$jwt_token) {
            return Result::send(401, 'Unauthorized!');
        }

        // 检验 token 合法性
        try {
            $payload = JWTUtils::decode($jwt_token);


            // 校验权限

            $role_name = Db::query('select role_name from role where id = :id', ['id' => $payload->{'role_id'}])[0]['role_name'];

            // 拿到

            if(!in_array($role_name, $role)) {
                return Result::send(401, 'Role mismatch!');
            }
            
            

        } catch (\Exception $e) {
            return Result::send(401, 'Jwt: ' . $e->getMessage());
        }
        
        return $next($request);


    }
}
