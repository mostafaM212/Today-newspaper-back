<?php

namespace App\Policies\Articles;

use App\Models\Article;
use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user , Article $article)
    {

        return $user->id === $article->user->id || $user->is_admin ;
    }

    public function delete(User $user , Article $article)
    {

        return $user->id === $article->user->id || $user->is_admin ;
    }
}
