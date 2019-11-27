<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class UserLikedSong extends Model
{
    protected $table = "user_liked_songs";

    public $timestamps = false;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'user_id', 'song_id'
    ];
}
