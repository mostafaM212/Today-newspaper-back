<?php

namespace App\Http\Resources\Articles;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Articles\ArticlesResource ;
class ArticlesUserIndexsResource extends ArticlesUsersResource
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
            'articles'=> ArticlesResource::collection($this->articles)
        ]);
    }
}
