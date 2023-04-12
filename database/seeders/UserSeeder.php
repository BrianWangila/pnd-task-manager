<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Unique;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        // $faker = \Faker\Factory::create();
        $password = Hash::make('password');

        User::create([
            "name" => "Brian Wangila",
            "email" => "admin@test.com",
            "password" => $password
        ]);

        // for ($i=0; $i < 5; $i++) { 
        //     User::create([
        //         "name" => $faker->name(),
        //         "email" => $faker->unique()->email(),
        //         "password" => $password
        //     ]);
        // }

    }
}
