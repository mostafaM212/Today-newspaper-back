<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Article ;
$factory->define(Article::class, function (Faker $faker) {
    return [
        //
        'title'=>$faker->title ,
        'body'=>$faker->text(4000) ,
        'user_id'=> 12
    ];
});
