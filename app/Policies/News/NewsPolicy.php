<?php

namespace App\Policies\News;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
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

    /**
     * @param User $user
     * @param News $news
     * @return bool
     */
    public function update(User $user , News $news)
    {
        return $user->id === $news->user->id || $user->is_admin ;
    }
}
