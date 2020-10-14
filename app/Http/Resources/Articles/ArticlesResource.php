<?php

namespace App\Http\Resources\Articles;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid'=>$this->uuid ,
            'title'=>$this->title ,
            'body'=>$this->body ,
            'created_at'=>$this->created_at->diffForHumans()

        ];
    }
}