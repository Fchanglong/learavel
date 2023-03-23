<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;


use App\Http\Controllers\UserController;
use App\Http\Controllers\TopsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
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
// Route::post('login',[LoginController::class,'login']);



// 注册
// Route::get('login',[RegisterController::class,'login']);



//api
$api = app('Dingo\Api\Routing\Router');
// $api->version('v1', ['middleware' => 'api.auth'], function ($api) {
//     // 在这个版本群组下的所有路由将进行身份验证。
//     $api->get('articles/{id}',[ArticleController::class,'show']);
// });
$api->version('v1', function ($api) {
    // tops
    $api->group(['middleware' =>  'auth:sanctum', 'prefix' => 'tops'], function ($api) {
        $api->post('tops', [TopsController::class, 'store']);
        $api->get('show', [TopsController::class, 'show']);
        $api->post('update/{id}', [TopsController::class, 'update']);
        $api->delete('delete/{id}', [TopsController::class, 'destroy']);
    });
    $api->group(['middleware' => 'api', 'prefix' => 'tops'], function ($api) {
        $api->get('tops', [TopsController::class, 'index']);
    });

    // articles
    $api->group(['middleware' =>  'auth:sanctum', 'prefix' => 'articles'], function ($api) {
        $api->get('articles/{id}', [ArticleController::class, 'show']);
    });
    $api->group(['middleware' => 'api','prefix' => 'articles'], function ($api) {
        $api->get('articles', [ArticleController::class, 'index']);
        $api->post('articles', [ArticleController::class, 'store']);
        $api->post('update/{id}', [ArticleController::class, 'update']);
    });


    // auth
    $api->group(['middleware' =>  'auth:sanctum', 'prefix' => 'auth'], function ($api) {
        $api->post('logout', [LogoutController::class, 'logout']);
    });
    $api->group(['middleware' =>  'api', 'prefix' => 'auth'], function ($api) {
        $api->post('register', [RegisterController::class, 'register']);
        $api->post('login', [LoginController::class, 'login']);
    });
});





// $api->group([
//     'version' => 'v1',
//     'middleware' => 'auth:api',
// ], function (\Dingo\Api\Routing\Router $api) {
//     $api->get('articles/{id}',[ArticleController::class,'show']);
// });

























// $api->version('v1', ['middleware' => 'AuthMiddleware'], function ($api) {

//     //需要Token认证的路由组
//     $api->group(['prefix' => 'auth'], function ($api) {
//         $api->get('articles/{id}',[ArticleController::class,'show']);
//     });

// });

// $api->version('v1', function ($api) {

//     //不需要Token认证的路​​由组
//     $api->group(['prefix' => 'guest'], function ($api) {
//         // $api->get('articles/{id}',[ArticleController::class,'show']);
//         $api->post('login',[LoginController::class,'login']);
//     });

// });


// $api->version('v1', function ($api){
//     $api->get('articles/{id}',[ArticleController::class,'show']);
// });

// $api = app('Dingo\Api\Routing\Router');
// $api->version('v1', ['middleware' => 'api:auth'], function ($api) {
//     $api->get('articles/{id}',[ArticleController::class,'show']);
//     $api->get('articles',[ArticleController::class,'index']);
// });
