<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDataWebSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('web_settings')->insert([
            ['logo' => 'default', 'phone_website' => "default", "email_website" => "default", "name_website" => "default",
                "url_facebook" => "default", "url_instagram" => "default", "url_google" => "default", "url_skype" => "default", "about_website" => "default",
            ],
        ]);
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
