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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/alltag', function(){
    return view('tags.index');
});
Route::resource('resume', 'ResumeController');
Route::resource('tag', 'TagController');

// Route::get('/resume', 'ResumeController@index');
// Route::get('/resume/create', 'ResumeController@create');
// Route::get('/resume/{id}', 'ResumeController@show');
// Route::get('/resume/{id}/edit', 'ResumeController@edit');

// Route::get('/tag/create', 'TagController@create');
// Route::get('/tag/{id}', 'TagController@show');
Route::post('/comment', 'CommentController@store');
Route::get('/profile', 'UserController@profile');
Route::post('/update_profile', 'UserController@update');
