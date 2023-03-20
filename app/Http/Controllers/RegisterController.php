<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    // use RegistersUsers;
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    //
    public function register(Request $request, User $user)
    {
        // $input = $request->all();
        // $query = User;
        // $connection = $query->getConnection();
        // try {
        //     $connection->beginTransaction();
        //     $input['password'] = Hash::make($input['password']);
        //     $user = $query->create($input);
            // $return['token'] = $user->createToken('lpac')->accessToken;
        //     $connection->commit();
        //     return ['msg' => '注册成功', 'data' => $return, 'code' => 200];
        // } catch (\Exception $e) {
        //     $connection->rollBack();
        //     log::info('注册异常 >>>' . $e->getMessage());
        //     return ['msg' => '注册异常', 'data' => '', 'code' => 400];
        // }

        Validator::make(
            $request->input(),
            [
                'password' => [
                    'required',
                    'confirmed'
                ],
                'password_confirmation' => [
                    'required'
                ]
            ]
        )->validate();
        // 进行注册，填写模型
        $user->fill($request->input());
        $user->password = Hash::make($request->password);
        $user->save();
        // 返回 token
        //  return $this->success('注册成功', ['token' => $user->createToken('lpac')->accessToken]);/
         return [
            'msg' => '注册成功',
            // 'data'=>['token' => $user->createToken('auth')->accessToken],
         ];

        // // Here the request is validated. The validator method is located
        // // inside the RegisterController, and makes sure the name, email
        // // password and password_confirmation fields are required.
        // $this->validator($request->all(), 'users')->validate();

        // // A Registered event is created and will trigger any relevant
        // // observers, such as sending a confirmation email or any
        // // code that needs to be run as soon as the user is created.
        // // 这里请求被验证。验证器方法位于 RegisterController 内部，并确保名称、电子邮件密码和 password_confirmation 字段是必需的。
        // event(new Registered($user = $this->create($request->all())));

        // // After the user is created, he's logged in.
        // $this->guard()->login($user);

        // // And finally this is the hook that we want. If there is no
        // // registered() method or it returns null, redirect him to
        // // some other URL. In our case, we just need to implement
        // // that method to return the correct response.
        // // 最后这是我们想要的钩子。如果没有 registered() 方法或它返回 null，则将他重定向到其他某个 URL。在我们的例子中，我们只需要实现该方法来返回正确的响应。
        // return $this->registered($request, $user)
        //     ?: redirect($this->redirectPath());
    }
    // 登录
    public function login(Request $request)
    {
        // 参数 name password
        // $all = $request->all();
        // $data = [];
        // $user = Auth::user();
        // $data['token'] = $user->createToken('lpac')->accessToken();
        // return ['msg' => '登录成功', 'data' => $data, 'code' => 2000];
        // } else {
        // $data['error'] = '账号或密码错误';
        // return ['msg' => $data['error'], 'data' => $data, 'code' => 4000];
        // if (Auth::attempt(['name' => $all['name'], 'password' => $all['password']])) {
        //     $user = Auth::user();
        //     return $this->success('登录成功', ['token' => $user->createToken('lpac')->accessToken]);
        //     // return $user;
        // } else {
        //     return 2;
        // };


        $user = User::where('name', $request->name)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return  [
                'msg' => '登录成功',
                'data'=>['token' => $user->createToken('auth')->accessToken],
             ];;
        }
        // 抛出异常
        throw ValidationException::withMessages(['password' => '密码输入错误']);


    }


}
