<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $hidden = ['pivot'];
    protected $fillable = [
        'user_id', 'song_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function song()
    {
        return $this->belongsTo('App\Song', 'song_id', 'id');
    }
}
