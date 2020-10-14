<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryIndexController extends Controller
{
    //

    public function __invoke()
    {
        $categories = Categories::all();

        return CategoryIndexResource::collection($categories) ;
    }
}
