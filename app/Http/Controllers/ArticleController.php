<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class ArticleController extends Controller
{
    //
    public function index()
    {
        //  查询所有
        return Article::all();
    }

    public function show($id)
    {
        $result = [
            'request' => 'false',
            'data'    => [],
            'code'    => '404',
            'msg'     => '傳入參數驗證失敗',
            'type'     => 'error',
        ];
        // 按id查找数据库
        // exists(存在)判断数据是否存在 doesntExist(不存在)
        // if(Article::find($id)->exists()){
            //     return 123;
        // }else{
            // return 123;
        // }
        if(Article::find($id)==null){

            return response($result,404);
        }else{
            return Article::find($id);
        }
    }

    public function store(Request $request)
    {

        $result = [
            'request' => 'false',
            'data'    => [],
            'code'    => '404',
            'msg'     => 'titlt,body必须填写',
            'type'     => 'error',
        ];

        if ($request->missing('title','body')) {
            //
            return response($result,404);
        }
        // 添加数据
        return Article::create($request->all());
        // return $request;
    }

    public function update(Request $request, $id)
    {

        // 按id 更新数据
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        // 按id 删除数据
        $article = Article::findOrFail($id);
        $article->delete();

        return 204;
    }
}
