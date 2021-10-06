<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
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
            User::create([
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => Hash::make('123456789'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone_number' => $faker->phoneNumber,
                'gender' => (rand(1, 2) % 2 == 0 ? 'Male' : 'Female'),
                'birth_date' => $faker->date(),
                'bio' => $faker->realText(100, 2),
                'address' => $faker->address
            ]);
        }
        User::create([
            'username' => 'ahmed',
            'email' => 'ahmed@app.com',
            'password' => Hash::make('123456789')
        ]);
    }
}
