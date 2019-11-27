<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "users";

    protected $fillable = [
       'email', 'password', 'username', 'full_name','gender', 'birthday', 'role', 'status'
    ];

    public function songs()
    {
        return $this->hasMany('App\Song', 'upload_by_user_id');
    }


}
