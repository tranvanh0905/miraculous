<?php
/*
|--------------------------------------------------------------------------
| Player Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'request.check'], function () {
    //Phát bài hát
    Route::post('/song', 'ClientPlayerController@getSong');

    //Phát album
    Route::post('/album', 'ClientPlayerController@getSongOfAlbum');

    //Phát danh sách phát
    Route::post('/playlist', 'ClientPlayerController@getSongOfPlaylist');

    //+ 1 view song
    Route::post('/update-view', 'ClientPlayerController@updateView');

    //+ 1 view song daily
    Route::post('/update-view-daily', 'ClientPlayerController@updateViewDaily');

    //user like song
    Route::post('like/song', 'ClientPlayerController@likeSong');

    //user like album
    Route::post('like/album', 'ClientPlayerController@likeAlbum');

    //user like playlist
    Route::post('like/playlist', 'ClientPlayerController@likePlaylist');

});


