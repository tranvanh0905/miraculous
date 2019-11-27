<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class UserFollowDetail extends Model
{
    protected $table = "user_follows_details";

    public $timestamps = false;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'artist_id', 'user_id'
    ];
}
