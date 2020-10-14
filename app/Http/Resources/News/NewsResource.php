<?php

namespace App\Http\Resources\News;

use App\Http\Resources\User\UserIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'category'=>$this->category->name,
            'photo'=> asset($this->photo)? : null ,
            'created_at'=>$this->created_at->diffForHumans(),
            'see_first'=>$this->see_first ,
            'owner'=>new UserIndexResource($this->user),

        ];
    }
}
