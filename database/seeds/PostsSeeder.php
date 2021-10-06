<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=0; $i < 100; $i++) {
            Post::create([
                'post_title'=>$faker->realText(50,2),
                'post_body'=>$faker->paragraph,
                'post_privacy'=>rand(1,3),
                'rating'=>rand(10,2000),
                'user_id'=>rand(1,40),
                'community_id'=>rand(1,40),
            ]);
        }
    }
}
