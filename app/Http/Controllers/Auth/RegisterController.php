<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserIndexResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{
    //
    /**
     * @param RegisterRequest $request
     * @return UserIndexResource|\Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($this->storeUser($request));

        if(!$token = Auth::attempt($request->only(['email','password']))){
            return response()->json(null ,401);
        }
        return (new UserIndexResource($user))->additional([
            'meta'=>[
                'token'=>$token
            ]
        ]);
    }

    /**
     * @param $request
     * @return array
     */
    public function storeUser($request)
    {
        if ($request->hasFile('photo')) {

            $photo = $request->photo;
            $photoname = time() . '-' . $request->photo->getClientOriginalName();
            $location = public_path('images/users/' . $photoname);
            Image::make($photo)->save($location);
        }

        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'photo' => isset($photoname) ? 'images/users/' . $photoname : '/default/unnamed.png',
            'phone' => $request->phone ,
            'address'=>$request->address,
            'is_admin'=>false
        ];
    }
}
