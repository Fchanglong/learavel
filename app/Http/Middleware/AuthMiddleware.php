<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $token = $request->header('Authorization');

        // if (!$token) {
        //     return response('Unauthorized', 401);
        // }

        // // 在这里检查 Token 是否有效

        // return $next($request);

        $authorization = $request->header('Authorization');

        // if (!$authorization || !preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
        //     // Authorization 字段不存在或格式不正确
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // 获取 Access Token
        // $accessToken = $matches[1];
        $token =DB::table('oauth_access_tokens')
                    ->join('users', 'users.id', '=', 'oauth_access_tokens.user_id')
                    ->select('oauth_access_tokens.id')
                    ->get();
        // $tokens = createToken();

        if (Auth::check()) {
           return "用户已登录...";
        }
        return '12';
        // 从用户模型中获取数据库中储存的 Access Token
        // $user = Auth::user();
        // $accessTokenInDatabase = $user->access_token;

        // 对比 Access Token
        // if (!hash_equals($accessToken, $tokens)) {
        //     // 验证失败
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // 验证成功，可以进行后续操作
        // return $tokens;
    }
}
