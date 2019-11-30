<?php
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

use Illuminate\Support\Facades\Route;

//Trang chủ

Route::get('/', 'ClientController@index')->name('client.home');

//Đăng nhập và đăng ký, đăng xuất

Route::get('login', 'Auth\LoginController@loginForm')->name('login');

Route::post('login', 'Auth\LoginController@postLogin');

Route::get('registration', 'Auth\RegisterController@regForm')->name('reg');

Route::post('registration', 'Auth\RegisterController@postReg');

Route::get('logout', 'Auth\LoginController@logOut')->name('logout');

//Các trang tất cả

Route::get('all/{type}', 'ClientController@all')->name('all');


//Các trang chi tiết

Route::get('single-album/{albumId}', 'ClientController@singleAlbum')->name('singleAlbum');

Route::get('single-artist/{artistId}', 'ClientController@singleArtist')->name('singleArtist');

Route::get('single-playlist/{playlistId}', 'ClientController@singlePlaylist')->name('singlePlaylist');

Route::get('single-genre/{genresId}', 'ClientController@singleGenres')->name('singleGenres');

Route::get('single-song/{songId}', 'ClientController@singleSong')->name('singleSong');

//Bảng xếp hạng

Route::get('chart', 'ClientController@chart')->name('client.chart');

//Bảng xếp hạng bài hát

Route::get('chart/song', 'ClientController@chartSong')->name('client.chart-song');

//Bảng xếp hạng album

Route::get('chart/album', 'ClientController@chartAlbum')->name('client.chart-album');

//Khám phá

Route::get('brower', 'ClientController@brower')->name('client.brower');

//Tìm kiếm
Route::get('/search', 'ClientController@search')->name('search');


//-------- Player route --------------//

//Phát bài hát
Route::get('/song/{songId}', 'ClientPlayerController@getSong');

//Phát album
Route::get('/album/{albumId}', 'ClientPlayerController@getSongOfAlbum');

//Phát danh sách phát
Route::get('/playlist/{playlistId}', 'ClientPlayerController@getSongOfPlaylist');

//Check, like
Route::group(['middleware' => 'request.check'], function () {

    //+ 1 view song
    Route::post('/update-view', 'ClientPlayerController@updateView');

    //user like song
    Route::post('like/song/{id}', 'ClientPlayerController@likeSong');

    //user like album
    Route::post('like/album/{id}', 'ClientPlayerController@likeAlbum');

    //user like playlist
    Route::post('like/playlist/{id}', 'ClientPlayerController@likePlaylist');

    Route::post('/follow-artist/', 'ClientUserController@followArtist')->name('follow-artist');

    Route::post('add-song-user-playlist/{songid}/{playlistid}', 'ClientPlayerController@addSongToPlaylist');

});

Route::get('song/check_like/{songId}', 'ClientPlayerController@checkLikeSong');

Route::get('get-user-playlist', 'ClientPlayerController@getUserPlaylist');






