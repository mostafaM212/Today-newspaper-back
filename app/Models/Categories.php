<?php

namespace App\Models;

use App\traits\keyName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categories extends Model
{
    use keyName ;
    //
    /**
     * @var string[]
     */
    protected $fillable = [
        'name','uuid'
    ];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($category){
            $category->uuid = Str::uuid();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany(News::class , 'category_id');
    }
}
