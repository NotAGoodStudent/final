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

})->name('index');

Route::get('/aboutus', function(){
    return view('aboutus');

})->name('aboutus');

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/updateProfile', 'UserController@returnUpdateProfile')->name('updateProfile');
    Route::get("/user/likeUser/{id}",'UserController@likeUser')->name('likeUser');
    Route::get('/user/getHomeData', 'UserController@getHomeData')->name('getHomeData');
    Route::get('/user/likes', 'LikeController@returnLikesView')->name('likes');
    Route::get('/likes/getLikesData', 'LikeController@getLikesData')->name('getLikesData');
    Route::patch('/user/updateProfileData', 'UserController@updateUserData')->name('updateUserData');
});

