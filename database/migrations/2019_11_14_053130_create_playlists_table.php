<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('cover_image')->default('client/images/playlist-default-cover.png');
            $table->unsignedInteger('upload_by_user_id');
            $table->integer('like')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }
}
