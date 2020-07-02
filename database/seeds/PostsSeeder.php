<?php

use Illuminate\Database\Seeder;
use App\Posts;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Posts::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Posts::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'user_id' => 1,
            ]);
        }
    }
}
