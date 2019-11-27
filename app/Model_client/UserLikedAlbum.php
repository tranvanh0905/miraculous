<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class UserLikedAlbum extends Model
{
    protected $table = "user_liked_albums";

    public $timestamps = false;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'album_id', 'user_id'
    ];
}
