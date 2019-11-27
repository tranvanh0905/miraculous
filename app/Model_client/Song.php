<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = "songs";

    protected $fillable = [
        'name', 'mp3_url', 'cover_image', 'description', 'lyric', 'genres_id', 'album_id', 'release_date', 'upload_by_user_id'
    ];

    public function artists()
    {
        return $this->belongsToMany('App\Artist', 'artists_song_details');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Playlist', 'playlist_details');
    }

    public function userLikedSongs()
    {
        return $this->belongsToMany('App\User', 'user_liked_songs');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'upload_by_user_id', 'id');
    }

    public function genres()
    {
        return $this->belongsTo('App\Genres', 'genres_id', 'id');
    }

    public function album(){

        return $this->belongsTo('App\Album', 'album_id', 'id');
    }


}
