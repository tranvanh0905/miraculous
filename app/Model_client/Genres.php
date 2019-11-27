<?php

namespace App\Model_client;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{

    protected $table = "genres";

    protected $fillable = [
        'name', 'description', 'image', 'status'
    ];

}
