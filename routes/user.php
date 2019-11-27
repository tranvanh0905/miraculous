<?php
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'ClientUserController@userIndex')->name('user-profile');

    Route::get('library', 'ClientUserController@library')->name('user-library');

    Route::get('library/song', 'ClientUserController@librarySong')->name('user-library-song');

    Route::get('library/album', 'ClientUserController@libraryAlbum')->name('user-library-album');

    Route::get('library/playlist', 'ClientUserController@libraryPlaylist')->name('user-library-playlist');

    Route::get('library/artist', 'ClientUserController@libraryArtist')->name('user-library-artist');

    Route::get('library/user-playlist', 'ClientUserController@libraryUserPlaylist')->name('user-library-personal-playlist');

    Route::get('library/user-playlist/single-playlist/{playlistId}', 'ClientUserController@libraryUserSinglePlaylist')->name('user-library-personal-playlist-detail');

    Route::get('library/user-playlist/single-playlist/{playlistId}/suggest-song', 'ClientUserController@libraySuggestSong')->name('suggestSongUserPlaylist');

    Route::post('library/user-playlist/single-playlist/{playlistId}/remove-song/{songId}', 'ClientUserController@librayRemoveSongOfPlaylist')->name
    ('removeSongOfPlaylist');

    Route::get('library/user-playlist/edit-playlist/{playlistId}', 'ClientUserController@libraryUserPlaylistEdit')->name('user-library-personal-playlist-edit');
    Route::post('library/user-playlist/edit-playlist/{playlistId}', 'ClientUserController@saveEditLibraryUserPlaylist')->name('user-library-personal-playlist-edit');

    Route::post('library/user-playlist/delete-playlist', 'ClientUserController@libraryUserPlaylistDelete')->name('user-library-personal-playlist-delete');

    Route::get('library/user-playlist/add-playlist', 'ClientUserController@libraryUserPlaylistAdd')->name('user.playlistAdd');
    Route::post('library/user-playlist/add-playlist', 'ClientUserController@saveLibraryUserPlaylist')->name('user.playlistAdd');

    Route::get('/edit-account', 'ClientUserController@editAccount')->name('user-edit-profile');
    Route::post('/edit-account', 'ClientUserController@saveEditAccount')->name('user-edit-profile');

    Route::get('/upgrade-account', 'ClientUserController@upgrade')->name('user-upgrade-profile');

    Route::get('/change-password', 'ClientUserController@changePassword')->name('user-change-password');
    Route::post('/change-password', 'ClientUserController@saveChangePassword')->name('user-change-password');

    Route::get('/invoice', 'ClientUserController@userInvoice')->name('user-invoice-profile');

    Route::post('comment/song', 'ClientController@commentSong')->name('comment.song');

    Route::post('comment/fetch-comment', 'ClientController@fetchComment')->name('comment.fetchComment');

});

