<?php
namespace App\Providers;

use Dingo\Api\Routing\Route;
use Illuminate\Http\Request;
use Dingo\Api\Auth\Provider\Authorization;

class PassportDingoProvider extends Authorization
{
    public function authenticate(Request $request, Route $route)
    {
        return $request->user();
        // return  12;
    }

    public function getAuthorizationMethod()
    {
        return 'bearer';
    }
}
