<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonSong extends Model
{
    //
    protected $table = "person_song";

    protected $fillable = [
        'song_id', 'artist_id', 'created_at', 'updated_at', 'person_song'
    ];
}
