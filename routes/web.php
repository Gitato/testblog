<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/','PostController@info');
Route::get('/', 'HomeController@index');
Route::get('/home', 'PostController@index')->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('new-post', 'PostController@create')->name('create');
    Route::post('posts.store', 'PostController@store')->name('store');
    Route::get('edit/{id}','PostController@edit')->name('edit');
    Route::put('update/{id}','PostController@update')->name('update');
    Route::get('delete/{id}', 'PostController@destroy')->name('delete');
    Route::get('my-all-posts','UserController@user_posts_all');
    Route::post('/upload-avatar/{id}','UserController@UploadAvatar')->name('upload-avatar');
});
Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+')->name('profile');
Route::get('user/{id}/posts', 'UserController@user_posts')->where('id', '[0-9]+');
Route::get('show/{id}', ['as' => 'post', 'uses' => 'PostController@show']);
Route::post('comment/add','CommentController@store');
Route::post('answer/add','CommentController@answer');
Route::get('favorite.posts','PostController@favorite');
Route::get('no-comments.posts','PostController@nocomments');
Route::get('search_category','PostController@search_category');
Route::get('search_tag','PostController@search_tag');

Route::get('kalculated', 'CalculatorController@final');
//Route::get('kalculator','CalculatorController@index');
//Route::get('summation','CalculatorController@summation')->name('sum');
//Route::get('subtraction','CalculatorController@subtraction');
//Route::get('multiplication','CalculatorController@multiplication');
//Route::get('segmentation','CalculatorController@segmentation');




