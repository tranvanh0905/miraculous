<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistSongDetail extends Model
{
    protected $table = "artists_song_details";

    public $timestamps = false;

    protected $hidden = ['pivot'];

    public function artist()
    {
        return $this->belongsTo('App\Artist', 'artist_id', 'id');
    }

    public function song()
    {
        return $this->belongsTo('App\Song', 'song_id', 'id');
    }

    protected $fillable = [
        'song_id', 'artist_id'
    ];

}
