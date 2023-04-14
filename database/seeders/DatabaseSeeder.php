<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            // ProjectSeeder::class,
            EmployeeSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,
            // TaskSeeder::class
        ]);
    }
}
