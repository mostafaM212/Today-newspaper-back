<?php

namespace App\Http\Resources\Articles;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesUsersResource extends JsonResource
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
            'id'=>$this->id ,
            'name'=>$this->name ,
            'articles_count'=>$this->articles->count(),
            'photo'=> asset($this->photo) ,

        ];
    }
}
