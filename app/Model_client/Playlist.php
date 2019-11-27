<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlists';

    protected $fillable = [
        'name', 'description', 'upload_by_user_id', 'status'
    ];

    public function songs(){
        return $this->belongsToMany('App\Song', 'playlist_details');
    }

    public function userLikedPlaylists(){
        return $this->belongsToMany('App\User', 'user_liked_playlists');
    }

    public function getThreeSongs()
    {
        return $this->songs()->take(3);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'upload_by_user_id', 'id');
    }

}
