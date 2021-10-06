<?php

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 200; $i++) {
            Comment::create([
                'comment_body' => $faker->paragraph,
                'user_id' => rand(1, 50),
                'post_id' => rand(1, 100)
            ]);
        }
    }
}
