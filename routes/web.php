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

Route::get('/', 'ClientController@index')->name('client.home');

//All page

Route::get('all/{type}', 'ClientController@all')->name('all');


//Single page

Route::get('single-album/{albumId}', 'ClientController@singleAlbum')->name('singleAlbum');

Route::get('single-artist/{artistId}', 'ClientController@singleArtist')->name('singleArtist');

Route::get('single-playlist/{playlistId}', 'ClientController@singlePlaylist')->name('singlePlaylist');

Route::get('single-genre/{genresId}', 'ClientController@singleGenres')->name('singleGenres');

Route::get('single-song/{songId}', 'ClientController@singleSong')->name('singleSong');


//Login and reg

Route::get('login', 'Auth\LoginController@loginForm')->name('login');

Route::post('login', 'Auth\LoginController@postLogin');

Route::get('registration', 'Auth\RegisterController@regForm')->name('reg');

Route::post('registration', 'Auth\RegisterController@postReg');

//Logout
Route::get('logout', 'Auth\LoginController@logOut')->name('logout');

//Genres page

Route::get('genres','ClientController@genres')->name('client.genres');

//Chart page

Route::get('top-albums', function () {
    return view('client.top-albums');
})->name('topAlbums');

Route::get('top-artists', function () {
    return view('client.top-artists');
})->name('topArtists');

Route::get('weekly-top-ten', function () {
    return view('client.weekly-top-ten');
})->name('weeklyTopTen');

//Brower page

Route::get('brower', 'ClientController@brower')->name('client.brower');

//Chart  page
Route::get('chart', 'ClientController@chart')->name('client.chart');

//Chart song page
Route::get('chart/song', 'ClientController@chartSong')->name('client.chart-song');

//Chart album page
Route::get('chart/album', 'ClientController@chartAlbum')->name('client.chart-album');

//Search
Route::get('/search', 'ClientController@search')->name('search');


//-------- Player route --------------//

//Play song
Route::get('/song/{songId}', 'ClientPlayerController@getSong');

//Play album
Route::get('/album/{albumId}', 'ClientPlayerController@getSongOfAlbum');

//Play playlist
Route::get('/playlist/{playlistId}', 'ClientPlayerController@getSongOfPlaylist');

Route::group(['middleware' => 'request.check'], function () {
    Route::get('/update-view/{songId}', 'ClientPlayerController@updateView');

    //+ 1 view song
    Route::post('/update-view/{songId}', 'ClientPlayerController@updateView');

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






