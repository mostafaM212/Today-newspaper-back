<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\News\NewsResource;
use App\Http\Resources\User\UserIndexResource;
use App\Models\Article;
use App\Models\Categories;
use App\Models\Message;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['myAuth','isAdmin']);
    }

    public function index(Request $request)
    {
        $newusers = User::orderBy('created_at','desc')->paginate(10);
        $usercount = User::all()->count();
        $categoirescount = Categories::all()->count();
        $messagecount = Message::all()->where('seen','=',false)->count();
        $newscount = News::all()->count();
        $articlescount = Article::all()->count() ;


        return (UserIndexResource::collection($newusers))
            ->additional([
                'users_count'=>$usercount,
                'categories_count'=>$categoirescount,
                'message_count'=>$messagecount,
                'news_count'=>$newscount,
                'articles_count'=>$articlescount

            ]);
    }
}
