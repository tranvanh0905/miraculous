<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\ArtistSongDetail;
use App\PersonSong;
use App\Song;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function actionGetSongArtist($artist_id, $album_id)
    {
        $song = Song::whereHas('artists', function ($q) use ($artist_id) {
            $q->where('artist_id', '=', $artist_id);
        })->get();
        $album = Album::where('id', $album_id)->first();
        return view('admin2.albums.song_artist', compact(['song', 'album']));
    }

    public function actionGetSongArtistAdd($artist_id)
    {
        $song = Song::whereHas('artists', function ($q) use ($artist_id) {
            $q->where('artist_id', '=', $artist_id);
        })->get();
        return view('admin2.albums.song_artist2', compact(['song']));
    }
}
