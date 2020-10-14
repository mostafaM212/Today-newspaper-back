<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Articles\ArticleUserResource;
use App\Http\Resources\User\UserIndexResource;
use App\Models\User;
use Illuminate\Http\Request;

class ArticlesIndexController extends Controller
{
    //
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(){

        $users = User::usersHasArticle()->get() ;

        return UserIndexResource::collection($users);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function article(){

        $users = User::usersHasArticle()->get() ;

        return ArticleUserResource::collection($users);
    }
}
