<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Articles\ArticlesIndexResource;
use App\Models\Article;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function __invoke()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(12) ;

        return ArticlesIndexResource::collection($articles);
    }
}
