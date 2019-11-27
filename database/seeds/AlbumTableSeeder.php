<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $album = [];
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $item = [
                'title' => $faker->name,
                'description' => $faker->realText($maxNbChars = 40, $indexSize = 2),
                'cover_image' => 'client/images/new-releases/new-releases-' . $i . '.jpg',
                'release_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'artist_id' => 20,
                'like' => 0,
                'status' => 1,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ];
            $album[] = $item;
        }
        DB::table('albums')->insert($album);
    }
}
