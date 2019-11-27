<?php
use Faker\Factory;
use Illuminate\Database\Seeder;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artist = [];
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $item = [
                'nick_name' => $faker->name,
                'full_name' => $faker->name,
                'avatar' => 'client/images/new-releases/new-releases-'. $faker->numberBetween($min = 1, $max = 44) .'.jpg',
                'cover_image' => 'client/images/single/single-3.jpg',
                'about' => $faker->realText($maxNbChars = 500, $indexSize = 2),
                'follow' => 0,
                'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'status' => 1,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ];
            $artist[] = $item;
        }
        DB::table('artists')->insert($artist);
    }
}
