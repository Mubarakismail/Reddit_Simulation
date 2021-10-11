<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('friends')->insert([
                'user_id' => rand(1, 25),
                'friend_id' => rand(26, 51),
                'sent' => 1,
                'accepted' => rand(0, 1),
            ]);
        }
        for ($i = 0; $i < 100; $i++) {
            DB::table('friends')->insert([
                'user_id' => rand(26, 51),
                'friend_id' => rand(1, 25),
                'sent' => 1,
                'accepted' => rand(0, 1),
            ]);
        }
    }
}
