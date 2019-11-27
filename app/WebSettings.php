<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebSettings extends Model
{
    //
    protected $table = "web_settings";

    protected $fillable = [
        'logo', 'phone_website', 'email_website', 'name_website', 'url_facebook',
        'url_instagram', 'url_google', 'url_skype', 'about_website'
    ];
}
