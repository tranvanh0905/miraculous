<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlists';

    protected $fillable = [
        'name', 'description', 'cover_image', 'upload_by_user_id', 'status'
    ];

    public function songs()
    {
        return $this->belongsToMany('App\Song', 'playlist_details');
    }

    public function song()
    {
        return $this->belongsTo('App\Song', 'song_id', 'id');
    }

    public function userLikedPlaylists()
    {
        return $this->belongsToMany('App\User', 'user_liked_playlists');
    }

    public function getThreeSongs()
    {
        return $this->songs()->take(3);
    }

}
