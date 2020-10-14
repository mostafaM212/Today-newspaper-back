<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UserProfileController extends Controller
{
    //
    /**
     * UserProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('myAuth');
    }

    /**
     * @return UserResource
     */
    public function index()
    {
        return new UserResource(Auth::user()) ;
    }

    /**
     * @param ProfileUpdateRequest $request
     * @return UserResource
     */
    public function store(ProfileUpdateRequest $request )
    {
        $request->user()->update($this->updateUser($request));
        return new UserResource($request->user());
    }

    /**
     * @param $request
     * @return array
     */
    public function updateUser($request)
    {

        return [
            'name' => $request->name,
            'phone' => $request->phone ,
            'address'=>$request->address,
        ];
    }
}
