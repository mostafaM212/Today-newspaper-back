<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\News\NewsResource;
use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;

class CategoryNewsController extends Controller
{
    //
    public function __invoke(Categories $category)
    {
        $news = $category->news()->orderBy('created_at','desc')->get();

        return NewsResource::collection($news);
    }
}
