<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $fillable = [
        'song_id', 'content', 'user_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
