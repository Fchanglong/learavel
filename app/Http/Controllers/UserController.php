<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;

class UserController extends Controller
{
    //
    use Helpers;

    public function getUserInfo(Request $request)
    {
        // 获取当前经过身份验证的用户
        $user = $this->auth->user();

        // 返回用户信息（包装成JSON响应）
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            // 更多字段（如果需要）
        ]);
    }
}
