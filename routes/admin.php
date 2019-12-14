<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AdminController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('admin.home');
Route::get('/403', function () {
    return view('admin2.403');
})->name('admin.403');
Route::get('/login', 'AdminController@login')->name('admin.login');
Route::post('/login', 'AdminController@actionLogin')->name('admin.login');
Route::get('/logout', 'AdminController@actionLogOut')->name('admin.logout');

//Album route
Route::get('albums', 'AlbumsController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.home');
Route::get('albums/add', 'AlbumsController@add')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.add');
Route::any('albums/get-data', 'AlbumsController@getData')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.getData');

Route::post('albums/add', 'AlbumsController@actionAdd')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.add');
Route::get('albums/update/{id}', 'AlbumsController@update')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.update');
Route::post('albums/update/{id}', 'AlbumsController@actionUpdate')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.update');
Route::get('albums/delete/{id}', 'AlbumsController@actionDelete')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.delete');
//Artist route
Route::get('artists', 'ArtistsController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('artists.home');
Route::get('artists/add', 'ArtistsController@add')->middleware('staffCheck')->middleware('checkAdminLogin')->name('artists.add');
Route::any('artists/get-data', 'ArtistsController@getData')->middleware('staffCheck')->middleware('checkAdminLogin')->name('artists.getData');
Route::post('artists/add', 'ArtistsController@actionAdd')->middleware('staffCheck')->middleware('checkAdminLogin')->name('artists.add');
Route::get('artists/update/{id}', 'ArtistsController@update')->middleware('staffCheck')->middleware('checkAdminLogin')->name('artists.update');
Route::post('artists/update/{id}', 'ArtistsController@actionUpdate')->middleware('staffCheck')->middleware('checkAdminLogin')->name('artists.update');
Route::get('artist/delete/{id}', 'ArtistsController@actionDelete')->middleware('staffCheck')->middleware('checkAdminLogin')->name('artists.delete');

//Playlist route
Route::get('playlist', 'PlaylistController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('playlist.home');
Route::get('playlist/add', 'PlaylistController@add')->middleware('staffCheck')->middleware('checkAdminLogin')->name('playlist.add');
Route::any('playlist/get-data', 'PlaylistController@getData')->middleware('staffCheck')->middleware('checkAdminLogin')->name('playlist.getData');
Route::post('playlist/add', 'PlaylistController@actionAdd')->middleware('staffCheck')->middleware('checkAdminLogin')->name('playlist.add');
Route::get('playlist/update/{playlist_id}', 'PlaylistController@update')->middleware('staffCheck')->middleware('checkAdminLogin')->name('playlist.update');
Route::post('playlist/update/{playlist_id}', 'PlaylistController@actionUpdate')->middleware('staffCheck')->middleware('checkAdminLogin')->name('playlist.update');
Route::get('playlist/delete/{playlist_id}', 'PLaylistController@actionDelete')->middleware('staffCheck')->middleware('checkAdminLogin')->name('playlist.delete');
//Song route
Route::get('songs', 'SongsController@index')->middleware('checkAdminLogin')->name('songs.home');
Route::any('songs/get-data', 'SongsController@getData')->middleware('checkAdminLogin')->name('songs.getData');
Route::get('songs/add', 'SongsController@add')->middleware('checkAdminLogin')->name('songs.add');
Route::post('songs/add', 'SongsController@actionAdd');
Route::get('songs/update/{song_id}', 'SongsController@update')->middleware('checkAdminLogin')->name('songs.update');
Route::post('songs/update/{song_id}', 'SongsController@actionUpdate')->middleware('checkAdminLogin')->name('songs.update');
Route::get('songs/delete/{song_id}', 'SongsController@actionDelete')->middleware('checkAdminLogin')->name('songs.delete');
//Kind route
Route::get('kinds', 'GenresController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('kinds.home');
Route::any('kinds/get-data', 'GenresController@getData')->middleware('staffCheck')->middleware('checkAdminLogin')->name('kinds.getData');
Route::get('kinds/add', 'GenresController@add')->middleware('staffCheck')->middleware('checkAdminLogin')->name('kinds.add');
Route::get('kinds/update/{id}', 'GenresController@update')->middleware('staffCheck')->middleware('checkAdminLogin')->name('kinds.update');
Route::post('kinds/update/{id}', 'GenresController@actionUpdate')->middleware('staffCheck')->middleware('checkAdminLogin')->name('kinds.update');
Route::post('kinds/add', 'GenresController@actionAdd')->middleware('staffCheck');
Route::get('kind/delete/{id}', 'GenresController@actionDelete')->middleware('staffCheck')->middleware('checkAdminLogin')->name('kinds.delete');
//Advertises route
Route::get('advertises', 'AdvertisesController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('advertises.home');
//Comment route
Route::get('comment', 'CommentsController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('comments.home');
Route::get('comment/get-data','CommentsController@getData')->middleware('staffCheck')->middleware('checkAdminLogin')->name('comments.getData');
Route::get('comment/delete/{id}', 'CommentsController@actionDelete')->middleware('staffCheck')->middleware('checkAdminLogin')->name('comments.delete');
//Users route
Route::get('users', 'UsersController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('users.home');
Route::any('users/get-data', 'UsersController@getData')->middleware('staffCheck')->middleware('checkAdminLogin')->name('users.getData');
Route::post('users/add', 'UsersController@actionAdd')->middleware('staffCheck')->middleware('checkAdminLogin')->name('users.add');
Route::get('users/add', 'UsersController@add')->middleware('staffCheck')->middleware('checkAdminLogin')->name('users.add');
Route::get('users/update/{id}', 'UsersController@update')->middleware('staffCheck')->middleware('checkAdminLogin')->name('users.update');
Route::post('users/update/{id}', 'UsersController@actionUpdate')->middleware('staffCheck')->middleware('checkAdminLogin')->name('users.update');
Route::get('users/delete/{id}', 'UsersController@actionDelete')->middleware('staffCheck')->middleware('checkAdminLogin')->name('users.delete');
//Ajax route
Route::get('ajax/artist_song/{artist_id}/{album_id}', 'AjaxController@actionGetSongArtist')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.song_artist');
Route::get('ajax/artist_song2/{artist_id}', 'AjaxController@actionGetSongArtistAdd')->middleware('staffCheck')->middleware('checkAdminLogin')->name('albums.song_artist2');
//Websetting route
Route::get('web-setting', 'WebSettingController@actionIndex')->middleware('staffCheck')->middleware('checkAdminLogin')->name('websetting.home');
Route::post('web-setting', 'WebSettingController@actionUpdate')->middleware('staffCheck')->middleware('checkAdminLogin')->name('websetting.update');
//Slider route
Route::get('slider', 'SliderController@index')->middleware('staffCheck')->middleware('checkAdminLogin')->name('slider.home');
Route::post('slider', 'SliderController@actionUpdate')->middleware('staffCheck')->middleware('checkAdminLogin')->name('slider.update');
Route::get('slider/add', 'SliderController@add')->middleware('staffCheck')->middleware('checkAdminLogin')->name('slider.add');
Route::post('slider/add', 'SliderController@actionAdd')->middleware('staffCheck')->middleware('checkAdminLogin')->name('slider.add');
Route::get('slider/update/{id}', 'SliderController@update')->middleware('staffCheck')->middleware('checkAdminLogin')->name('slider.updateform');
Route::post('slider/update/{id}', 'SliderController@updateForm')->middleware('staffCheck')->middleware('checkAdminLogin')->name('slider.updateform');
Route::get('slider/delete/{id}', 'SliderController@delete')->middleware('staffCheck')->middleware('checkAdminLogin')->name('slider.delete');
