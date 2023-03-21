<?php

namespace App\Http\Controllers;
use App\Models\Tops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TopsController extends Controller
{
    //
    /**
     * 通过中间件对用户登录验证
     * 构造函数验证身份，每次执行前都会运行
     */
    // public function __construct()
    // {
    //     // 排除获取帖子列表和获取帖子详情
    //     $this->middleware('auth:sanctum')->except(['index', 'show']);
    // }

    /**
     * 获取帖子列表
     */
    public function index()
    {
        return Tops::all();
    }

    /**
     * 创建帖子
     */
    public function store(Request $request, Tops $tops)
    {
        // 填写数据，规则在 StoreTopsRequest 定义，可填写字段在帖子模型中定义
        // $tops->fill($request->input());
        // 使用当前登录的用户id
        // $tops->user_id = Auth::id();
        // $tops = Auth::user();
        // $tops->save();
        $user =  Auth::guard('admin')->user();
// dd($user);

        // return $this->success('发表成功', $tops);
        return $user;
    }

    /**
     * 获取单条帖子
     */
    // public function show(Tops $tops)
    // {
    //     return $this->success('获取成功', new TopicResource($tops->load('user')));
    // }

    /**
     * 修改帖子
     */
    // public function update(Request $request, Tops $tops)
    // {
    //     $tops->fill($request->input())->save();
    //     return $this->success('修改成功', $tops);
    // }

    /**
     * 删除帖子
     */
    // public function destroy(Tops $tops)
    // {
    //     //
    // }
}
