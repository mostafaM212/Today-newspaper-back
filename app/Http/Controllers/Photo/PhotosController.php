<?php

namespace App\Http\Controllers\Photo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\PhotosRequest;
use App\Http\Resources\Photo\PhotosResource;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PhotosController extends Controller
{
    /**
     * PhotosController constructor.
     */
    public function __construct()
    {
        $this->middleware('myAuth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::all() ;

        return PhotosResource::collection($photos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotosRequest $request)
    {
        //

        if ($request->hasFile('photo')){

            $photo = $request->photo ;
            $photoname = $photo->getClientOriginalName();

            $photoname = time().'-'.$photoname ;
            $location = public_path('/images/posts/'.$photoname) ;
            Image::make($photo)->save($location);

            $new = Photo::create([
                'url'=> '/images/posts/'.$photoname ,
                'user_id'=>Auth::user()->id
            ]);
            return new PhotosResource($new);
        }

        return response()->json(['message'=>'there are an error during put image'],404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
        return new PhotosResource($photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
        File::delete(public_path($photo->url));
        $photo->delete();

        return  response()->json(null , 200);
    }
}
