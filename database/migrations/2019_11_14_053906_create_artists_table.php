<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick_name');
            $table->string('full_name');
            $table->string('avatar')->default('client/images/single/single-2.jpg');
            $table->string('cover_image')->default('client/images/single/single-3.jpg');
            $table->text('about');
            $table->integer('follow')->default(0);
            $table->date('birthday');
            $table->date('date_of_death')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists');
    }
}
