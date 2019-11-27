<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class SongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $songs = [];
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $item = [
                'name' => $faker->name,
                'genres_id' => $faker->numberBetween($min = 11, $max = 20) ,
                'mp3_url' => 'client/mp3/' . $faker->numberBetween($min = 1, $max = 26) . '.mp3',
                'cover_image' => 'client/images/new-releases/new-releases-'. $faker->numberBetween($min = 1, $max = 44) .'.jpg',
                'description' => $faker->realText($maxNbChars = 40, $indexSize = 2),
                'lyric' => $faker->realText($maxNbChars = 600, $indexSize = 2),
                'view' => 0,
                'like' => 0,
                'release_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'album_id' => -1,
                'upload_by_user_id' => 1,
                'status' => 1,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ];
            $songs[] = $item;
        }
        DB::table('songs')->insert($songs);
    }
}
