<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('access-token')->accessToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid login credentials'], 401);
    }
}
