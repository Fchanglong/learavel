<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function logout(Request $request){
        // $request->user()->currentAccessToken()->delete();
        $response = ['status' => 'success'];
        // return response($response, 201);

        $tokenId =$request->user()->currentAccessToken()->tokenable_id;
        $request->user()->tokens()->where('tokenable_id', $tokenId)->delete();
        return response($response, 201);

    }
}
