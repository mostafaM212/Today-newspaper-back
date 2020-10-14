<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsRequest;
use App\Http\Requests\News\NewsUpdateRequest;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

class NewsController extends Controller
{
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
        $news = News::latest()->paginate(18);

        return NewsResource::collection($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        //
        $news = News::create($this->storeNews($request));

        return new NewsResource($news);
    }

    /**
     * @param $request
     * @return array
     */
    public function storeNews($request)
    {
        if ($request->hasFile('photo')){

            $photo = $request->photo ;
            $photoname = time().'-'. $request->photo->getClientOriginalName();
            $location = public_path('images/news/'.$photoname);
            \Intervention\Image\Facades\Image::make($photo)->save($location);
        }
        return [
            'title'=>$request->title ,
            'body'=>$request->body ,
            'category_id'=>$request->category_id,
            'photo'=>isset($photoname) ? 'images/news/'.$photoname : null,
            'user_id'=>Auth::user()->id,
            'see_first'=>$request->see_first
        ];
    }

    /**
     * @param News $news
     * @return NewsResource
     */
    public function show(News $news)
    {
        return new NewsResource($news);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request,News $news)
    {
        //
        $this->authorize('update',$news);

        $news->update($request->only(['title','body']));

        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
        $this->authorize('update',$news);
        if ($news->photo !==null){
            File::delete(public_path($news->photo));
        }
        $news->delete() ;
        return  response()->json(null , 200);
    }
}
