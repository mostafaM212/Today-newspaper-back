<?php

namespace App\Http\Resources\User;

use App\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ( Auth::check() && $request->user()->is_admin){
            $messagecount = Message::all()->where('seen','=',false)->count();
        }
        return [
            'id'=>$this->id ,
            'name'=>$this->name ,
            'email'=>$this->email,
            'messages'=> isset($messagecount) ? $messagecount : 0 ,
            'is_admin'=>isset($this->is_admin) ? $this->is_admin : false ,
            'photo'=>asset($this->photo)
        ];
    }
}
