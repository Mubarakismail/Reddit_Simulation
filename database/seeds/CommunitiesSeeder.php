<?php

use App\Models\Community;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommunitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            Community::create([
                'community_name' => $faker->word,
                'community_privacy' => (rand(1, 2) % 2 == 1 ? 'Public' : 'Private'),
                'description' => $faker->realText(200, 2),
                'numberOfMembers' => rand(50, 20000),
            ]);
        }
    }
}
