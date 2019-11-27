<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class PlaylistDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $playlistdetail = [];
                $faker = Factory::create();
                for ($i = 0; $i < 10; $i++) {
                    $item = [
                        'playlist_id' => 2,
                        'song_id' => $faker->numberBetween($min = 1, $max = 30)
                    ];
                    $playlistdetail[] = $item;
                }
                DB::table('playlist_details')->insert($playlistdetail);
    }
}
