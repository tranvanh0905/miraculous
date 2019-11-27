<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';

    public function artist()
    {
        return $this->belongsTo('App\Artist', 'artist_id');
    }

    public function userLikedAlbums(){
        return $this->belongsToMany('App\User', 'user_liked_albums');
    }

    protected $fillable = [
        'title', 'description', 'cover_image', 'release_date', 'status', 'artist_id'
    ];
}
