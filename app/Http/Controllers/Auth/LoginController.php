<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserIndexResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function __invoke(LoginRequest $request)
    {
        if (!$token = Auth::attempt($request->only(['email','password']))){
            return response()->json(null ,401);
        }
        return (new UserIndexResource(Auth::user()))->additional([
            'meta'=>[
                'token'=>$token
            ]
        ]);
    }
}
