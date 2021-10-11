<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class voteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 52; $i++) {
            for ($j = 1; $j < rand(20, 50); $j++) {
                DB::table('user_post_vote')->insert([
                    'user_id' => $i,
                    'post_id' => $j + 10
                ]);
            }
        }
    }
}
