<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Mail\ForgetUserPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    //

    public function __invoke(ForgetPasswordRequest $request)
    {
        $user = User::where('email',$request->email)->first();

        $newPass = Str::random(5);

        $user->password = Hash::make($newPass);

        Mail::to($user)->send(new ForgetUserPassword($user , $newPass));

        return response(null , 200);
    }
}
