<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class ArtistSongDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artistSongDetail = [];
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $item = [
                'artist_id' => 2,
                'song_id' => $faker->numberBetween($min = 1, $max = 30),
            ];
            $artistSongDetail[] = $item;
        }
        DB::table('artists_song_details')->insert($artistSongDetail);
    }
}
