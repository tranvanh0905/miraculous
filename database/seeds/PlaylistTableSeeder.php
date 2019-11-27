<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class PlaylistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $playlist = [];
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $item = [
                'name' => $faker->name,
                'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'cover_image' => 'client/images/radios/radios-'. $faker->numberBetween($min = 1, $max = 8) .'.jpg',
                'upload_by_user_id' => 1,
                'status' => 1,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ];
            $playlist[] = $item;
        }
        DB::table('playlists')->insert($playlist);
    }
}
