<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function register(Request $request, User $user)
    {
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
            // 'data'=>['token' => $user->createToken('auth')->plainTextToken],
         ];
    }



}
