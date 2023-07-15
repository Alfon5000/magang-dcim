<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\MagneticDoor;
use App\Models\SmokeDetector;
use App\Models\TemperatureHumidity;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Seeder;

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
            CategorySeeder::class,
            StatusSeeder::class,
            SensorSeeder::class,
        ]);

        // User::factory(20)->create();
        // Visitor::factory(20)->create();
        // TemperatureHumidity::factory(2000)->create();
        // MagneticDoor::factory(500)->create();
        // SmokeDetector::factory(500)->create();
    }
}
