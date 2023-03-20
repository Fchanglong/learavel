<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RegisterController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('articles', function() {
//     // If the Content-Type and Accept headers are set to 'application/json',
//     // this will return a JSON structure. This will be cleaned up later.
//     return Article::all();
// });

// Route::get('articles/{id}', function($id) {
//     return Article::find($id);
// });

// Route::post('articles', function(Request $request) {
//     return Article::create($request->all);
// });

// Route::put('articles/{id}', function(Request $request, $id) {
//     $article = Article::findOrFail($id);
//     $article->update($request->all());

//     return $article;
// });

// Route::delete('articles/{id}', function($id) {
//     Article::find($id)->delete();

//     return 204;
// });


// 构造器写法
// Route::resource('articles',ArticleController::class);
// Route::get('articles',[ArticleController::class,'index']);
// Route::get('articles/{id}',[ArticleController::class,'show']);
// Route::post('articles',[ArticleController::class,'store']);



// 注册
// Route::get('login',[RegisterController::class,'login']);



//api
$api = app('Dingo\Api\Routing\Router');
$api->version('v1',['middleware' =>['cors']],function($api){
    // 需要登录验证的api
    $api->group(['name'=>'App\Http\Controllers\Api','middlewaer'=>['auth:api','cors','throttle:300,1']],function($api){
        // $api->get('articles',[ArticleController::class,'index']);
    });

    // 不需要验证的api
    $api->group(['name'=>'App\Http\Controllers\Api','middlewaer'=>['auth:api','cors','throttle:1200,1'],'limit'=>300,'expires'=>5],function($api){
        $api->get('articles/{id}',[ArticleController::class,'show']);
        $api->get('articles',[ArticleController::class,'index']);
        $api->post('articles',[ArticleController::class,'store']);
        $api->post('register',[RegisterController::class,'register']);
        $api->post('login',[RegisterController::class,'login']);
    });
});
// $api->version('v1', function ($api) {
//     $api->get('login',[RegisterController::class,'login']);
// });
