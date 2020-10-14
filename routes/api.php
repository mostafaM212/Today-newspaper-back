<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('me/news','UserNews\UserNewsController@index');
Route::group(['prefix'=>'auth','namespace'=>'Auth'],function (){
    Route::post('login','LoginController');
    Route::get('user','UserController');
    Route::post('logout','LogoutController');
    Route::post('forget','ForgetPasswordController');
    Route::post('register','RegisterController');
});
Route::resource('categories' ,'Category\CategoriesController');

Route::resource('news' ,'News\NewsController');

Route::get('/categories/show/{category}','Category\CategoryNewsController');

Route::get('/category/news','Category\CategoryIndexController');

Route::resource('messages','Message\MessageController');

Route::resource('profile','User\UserProfileController');

Route::get('/admin','Admin\AdminIndexController@index');

Route::get('/admin/articles','Article\AdminArticleController');

Route::group(['prefix'=>'admin'],function (){
    Route::delete('/messages','Message\MessageController@clear') ;
    Route::resource('/users' ,'Admin\UsersController');
});

Route::resource('photos','Photo\PhotosController');

Route::get('/users/articles', 'Article\ArticlesIndexController@index') ;

Route::get('/users/article', 'Article\ArticlesIndexController@article') ;

Route::resource('articles','Article\ArticlesController');

Route::get('/articles/{user}/user','Article\ArticlesController@userArticles');
