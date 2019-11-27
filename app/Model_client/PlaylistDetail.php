<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class PlaylistDetail extends Model
{
    protected $table = "playlist_details";

    public $timestamps = false;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'playlist_id', 'song_id'
    ];


}
