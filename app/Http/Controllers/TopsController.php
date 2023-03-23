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
    //     // 排除获取帖子列表和获取帖子详情 默认就有了，只要在api路由上添加就好了
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
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        // php artisan make:request StorePostRequest 自定义验证 吧Request改成StorePostRequest
        // 填写数据，规则在 StorePostRequest 定义，可填写字段在帖子模型中定义
        $tops->fill($request->input());
        // 使用当前登录的用户id
        $tops->user_id = Auth::id();
        $tops->save();

        return ['msg' => '发表成功', $tops];
        // return $user;
    }

    /**
     * 获取该用户的帖子
     */
    public function show(Tops $tops)
    {
        $content = $tops->where('user_id', '=', Auth::id())->get(['title', 'content', 'id']);
        return $content;
    }

    /**
     * 修改帖子
     */
    public function update(Request $request, Tops $tops, $id)
    {
        // 查找帖子
        $update_id = $tops::findOrFail($id);
        // return $update_id;
        // $this->authorize( $update_id,'update'); 这个写法需要在声明规则
        // <?php
        // namespace App\Http\Requests;
        // use Illuminate\Foundation\Http\FormRequest;
        // class SellRequest extends FormRequest
        // {
        //     /**
        //      * Determine if the user is authorized to make this request.
        //      *
        //      * @return bool
        //      */
        //         public function authorize()
        //     {
        //         return true;
        //     }

        //     /**
        //      * Get the validation rules that apply to the request.
        //      *
        //      * @return array
        //      */
        //     public function rules()
        //     {
        //         return [
        //         ];
        //     }
        // }
        if ($update_id->user_id == Auth::id()) {

            // 更新帖子
            $update_id->update($request->all());

            return ['data' => $update_id, 'msg' => 'success'];
        }

        return ['data' => '该用户没用权限更改该帖子', 'msg' => 'error'];
    }

    /**
     * 删除帖子
     */
    public function destroy(Tops $tops,$id)
    {
        //
        $update_id = $tops::findOrFail($id);
        if ($update_id->user_id == Auth::id()) {

            // 删除帖子
            $update_id->delete();

            return ['data' => '删除成功', 'msg' => 'success'];
        }

        return ['data' => '该用户没用权限删除该帖子', 'msg' => 'error'];
    }
}
