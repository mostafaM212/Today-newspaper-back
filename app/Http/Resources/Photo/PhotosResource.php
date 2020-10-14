<?php

namespace App\Http\Resources\Photo;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotosResource extends JsonResource
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
            'uuid'=>$this->uuid,
            'url'=>asset($this->url),
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at->diffForHumans()
        ];
    }
}
