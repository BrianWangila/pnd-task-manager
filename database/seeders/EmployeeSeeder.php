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

        for ($i=0; $i < 5; $i++) { 
            Employee::create([
                "department_id" => random_int(1, 5), 
                "user_id" =>random_int(1, 5),
                "job_title" =>$faker -> jobTitle(),
                "address" =>$faker->address(),
                "phone"=>$faker->phoneNumber()

            ]);
        }
    }
}
