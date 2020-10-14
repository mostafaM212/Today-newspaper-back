<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\News\NewsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexResource extends CategoryResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request),[
            'News'=> NewsResource::collection($this->news()->orderBy('created_at','desc')->paginate(25))
        ]);
    }
}
