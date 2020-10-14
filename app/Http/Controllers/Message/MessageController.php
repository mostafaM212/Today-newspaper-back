<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware(['myAuth','isAdmin'])->except('store');
    }

    public function index()
    {
        $messages = Message::latest()->get();

        $messages->each(function ($message){
            $message->seen = true ;
            $message->save();
        });
        return  MessageResource::collection($messages) ;
    }
    /**
     * @param MessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MessageRequest $request)
    {
       $message = Message::create($request->only(['fname','lname','email','message']));

        return response()->json(null , 200);
    }

    /**
     * @param Message $message
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json(null , 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear()
    {
        Message::all()->each(function ($message){
            $message->delete();
        });
        return response()->json(null , 200);

    }
}
