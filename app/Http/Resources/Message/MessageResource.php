<?php

namespace App\Http\Resources\Message;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->fname . ' '. $this->lname ,
            'email'=>$this->email ,
            'message'=>$this->message,
            'seen'=>$this->seen,
            'created_at'=>$this->created_at->diffForHumans()
        ];
    }
}
