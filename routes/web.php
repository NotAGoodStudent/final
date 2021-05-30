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

Route::get('/test', function (){
   event(new \App\Events\SendMessage());
   return 'yup';
});
Auth::routes();
Route::get('/m', function (){
   return view('users.messages');
});

Route::middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/updateProfile', 'UserController@returnUpdateProfile')->name('updateProfile');
    Route::get("/user/likeUser/{id}",'LikeController@likeUser')->name('likeUser');
    Route::get('/user/removeLike/{id}', 'LikeController@removeLike')->name('removeLike');
    Route::get('/user/getHomeData', 'UserController@getHomeData')->name('getHomeData');
    Route::get('/user/likes', 'LikeController@returnLikesView')->name('likes');
    Route::get('/likes/getLikesData', 'LikeController@getLikesData')->name('getLikesData');
    Route::get('/user/matches', 'MatchController@returnMatchesView')->name('matches');
    Route::get('/matches/getMatchesData', 'MatchController@getMatchesData')->name('getMatchesData');
    Route::get('/user/removeMatch/{id}', 'MatchController@removeMatch')->name('removeMatch');
    Route::patch('/user/updateProfileData', 'UserController@updateUserData')->name('updateUserData');
});

