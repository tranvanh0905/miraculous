<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [];
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $item = [
                'email' => $faker->email,
                'password' => bcrypt('123456'),
                'full_name' => $faker->name,
                'gender' => $faker->numberBetween($min = 0, $max = 1),
                'avatar' => 'client/images/playlists/playlist-9.jpg',
                'role' => 100,
                'status' => 1,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ];
            $user[] = $item;
        }
        DB::table('users')->insert($user);
    }
}
