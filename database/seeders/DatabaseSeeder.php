<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Seeder;
use Database\Seeders\SensorSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            VisitorCategorySeeder::class,
            SensorSeeder::class,
        ]);

        User::factory(20)->create();
        Visitor::factory(20)->create();
    }
}
