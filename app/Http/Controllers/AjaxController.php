<?php

namespace App\Http\Controllers;

use App\Artist;
use App\ArtistSongDetail;
use App\PersonSong;
use App\Song;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function actionGetSongArtist($artist_id)
    {
        $song = Song::whereHas('artists', function ($q) use ($artist_id) {
            $q->where('artist_id', '=', $artist_id);
        })->where('album_id', '=',0)->get();
        return view('admin.albums.song_artist', compact(['song']));
    }

}
