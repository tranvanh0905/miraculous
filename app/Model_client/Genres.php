<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{

    protected $table = "genres";

    protected $fillable = [
        'name', 'description', 'image', 'status'
    ];

    public function songs()
    {
        return $this->hasMany('App\Model_Client\Song');
    }

}
