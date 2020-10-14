<?php

namespace App\Http\Controllers\UserNews;

use App\Http\Controllers\Controller;
use App\Http\Resources\News\NewsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNewsController extends Controller
{
    //
    public function index()
    {
        $news = Auth::user()->news ;

        return NewsResource::collection($news);
    }
}
