<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'fname','lname','message','email','seen'
    ];

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderByDesc('created_at') ;
    }

}
