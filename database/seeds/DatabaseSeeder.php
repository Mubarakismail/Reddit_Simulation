<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class, CommunitiesSeeder::class,
            PostsSeeder::class, CommentssSeeder::class,
            FriendsSeeder::class, notificationsSeeder::class,
            voteSeeder::class,
        ]);
    }
}
