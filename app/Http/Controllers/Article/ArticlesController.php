<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\ArticlesRequest;
use App\Http\Resources\Articles\ArticlesIndexResource;
use App\Http\Resources\Articles\ArticlesResource;
use App\Http\Resources\Articles\ArticlesUserIndexsResource;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    //

    public function __construct(){
        $this->middleware(['myAuth'])->except(['index','userArticles']);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $articles = Article::all() ;

        return ArticlesIndexResource::collection($articles) ;
    }

    /**
     * @param ArticlesRequest $request
     * @return ArticlesIndexResource
     */
    public function store(ArticlesRequest $request)
    {
        $article = Article::create(array_merge($request->only(['title','body'],[

        ]))) ;
        $article->user_id =Auth::user()->id ;
        $article->save();
        return new ArticlesIndexResource($article);
    }

    /**
     * @param User $user
     * @return ArticlesUserIndexsResource
     */
    public function userArticles(User $user)
    {
        return new ArticlesUserIndexsResource($user);
    }

    /**
     * @param Article $article
     * @return ArticlesIndexResource
     */
    public function show(Article $article)
    {
        return new ArticlesIndexResource($article);
    }
    /**
     * @param Request $request
     * @param Article $article
     * @return ArticlesIndexResource
     */
    public function update(ArticlesRequest $request , Article $article)
    {
        $this->authorize('update',$article);
        $article->update($request->only(['title', 'body']));

        return new ArticlesIndexResource($article);
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Article $article)
    {

        $this->authorize('delete',$article);

        $article->delete();

        return response()->json(null , 200);
    }
}
