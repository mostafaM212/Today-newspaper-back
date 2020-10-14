<?php

namespace App\Http\Resources\Articles;

use App\Http\Resources\User\UserIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesIndexResource extends JsonResource
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
            'title'=>$this->title,
            'body'=>$this->body ,
            'uuid'=>$this->uuid,
            'created_at'=>$this->created_at->diffForHumans(),
            'owner'=>new ArticlesUsersResource($this->user),
        ];
    }
}
