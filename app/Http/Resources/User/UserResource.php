<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends UserIndexResource
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
            'address' => $this->address ,
            'phone'=>$this->phone ,
            'number_news'=>$this->news->count() ,
            'created_at' =>$this->created_at ,
        ]);
    }
}
