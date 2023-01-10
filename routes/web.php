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
    return redirect('/article');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('article' , 'App\Http\Controllers\ArticleController')->middleware('auth');
//    Route::resource('user' , 'App\Http\Controllers\UserController')->middleware('auth');


Route::get('user/{id}', 'App\Http\Controllers\UserController@show')->name('users')->middleware('auth');
Route::get('contact', 'App\Http\Controllers\ContactController@index')->name('contact')->middleware('auth');
