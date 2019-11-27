<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [];

        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $item = [
                'name' => $faker->name,
                'description' => $faker->realText($maxNbChars = 40, $indexSize = 2),
                'image' => 'client/images/radios/genres-'. $i .'.jpg',
                'status' => 1,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ];
            $genres[] = $item;
        }
        DB::table('genres')->insert($genres);
    }
}
