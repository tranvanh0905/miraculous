<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    //
    protected $table = "artists";

    protected $fillable = [
        'nick_name', 'full_name', 'avatar', 'cover_image', 'about', 'follow', 'birthday', 'status'
    ];

    public function songs(){
        return $this->belongsToMany('App\Song', 'artists_song_details');
    }

    public function albums()
    {
        return $this->hasMany('App\Album');
    }

    public function userFollows(){
        return $this->belongsToMany('App\User', 'user_follow_details');
    }


}
