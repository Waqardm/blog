<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| -- Shouldn't have functions in routes file --

*/

// Authentication Routes...
Auth::routes();
Route::get('logout', [ 'uses' => 'Auth\LoginController@logout', 'as' => 'logout' ]);

// Categories
Route::resource('categories', 'CategoryController', ['except' => ['create']]);
Route::get('categories/{category}', ['uses' => 'CategoryController@getSingleCategory', 'as' => 'categories.show']);

// Tags
Route::resource('tags', 'TagController', ['except' => ['create']]);

//Contact Form
Route::post('contact', 'PagesController@postContact');

//Comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit',['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}',['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}',['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

//Pages
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
Route::get('contact', 'PagesController@getContact');
Route::get('about', 'PagesController@getAbout');
Route::get('/', 'PagesController@getIndex');
Route::resource('posts', 'PostController');

Route::get('/home', 'HomeController@index');
