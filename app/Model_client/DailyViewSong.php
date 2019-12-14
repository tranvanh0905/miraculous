<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class DailyViewSong extends Model
{
    protected $table = 'daily_views';

    protected $fillable = [
        'song_id', 'total_view', 'date'
    ];

    public $timestamps = false;

    public function song()
    {
        return $this->belongsTo('App\Model_client\Song');
    }
}
