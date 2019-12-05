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

//Đăng nhập và đăng ký, đăng xuất, quên mật khẩu

Route::get('login', 'Auth\LoginController@loginForm')->name('login');

Route::post('login', 'Auth\LoginController@postLogin');

Route::get('registration', 'Auth\RegisterController@regForm')->name('reg');

Route::post('registration', 'Auth\RegisterController@postReg');

Route::get('logout', 'Auth\LoginController@logOut')->name('logout');

//quên mật khẩu
Route::get('forgot-password', 'ForgetPasswordController@showForgetPasswordForm')->name('forgotPassword');

Route::post('forgot-password', 'ForgetPasswordController@postForgetPassword')->name('forgotPassword');

Route::get('forgot-password/change-password', 'ForgetPasswordController@changePassword')->name('changePassword');

Route::post('forgot-password/change-password/saveChangePassword', 'ForgetPasswordController@saveChangePassword')->name('saveChangePassword');



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

//Bảng xếp hạng ca sĩ

Route::get('chart/artist', 'ClientController@chartArtist')->name('client.chart-artist');

//Khám phá

Route::get('brower', 'ClientController@brower')->name('client.brower');

//Tìm kiếm
Route::get('/search', 'ClientController@search')->name('search');

//Kiểm tra like bài hát
Route::post('song/check_like', 'ClientPlayerController@checkLikeSong');

//Lấy danh sách phát cá nhân
Route::get('get-user-playlist', 'ClientPlayerController@getUserPlaylist');

Route::group(['middleware' => 'request.check'], function () {

    //+ 1 view song
    Route::post('/update-view', 'ClientPlayerController@updateView');

    //+ 1 view song daily
    Route::post('/update-view-daily', 'ClientPlayerController@updateViewDaily');

    //Quan tâm ca sĩ
    Route::post('/follow-artist/', 'ClientUserController@followArtist')->name('follow-artist');
    //Thêm bài hát vào danh sách phát cá nhân
    Route::post('add-song-user-playlist/{songid}/{playlistid}', 'ClientPlayerController@addSongToPlaylist');
});






