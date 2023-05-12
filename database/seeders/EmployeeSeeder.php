<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('en_US');

            Employee::create([
                "department_id" => 1,
                "user_id" => 1,
                "job_title" => "admin",
                "address" =>$faker->address(),
                "phone"=>$faker->phoneNumber(),
                "about"=>$faker->sentence($nbWords = 20, $variableNbWords = true),
                'role'=>"admin"

            ]);
    }
}
