<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('en_US');

        

        for ($i=0; $i < 5; $i++) { 
            Department::create([
                "department_name" => $faker->word()

            ]);
        }
    }
}
