<?php

namespace Database\Seeders;

use App\Models\Sensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sensors = [
            [
                'id' => 6,
                'Sensor 1',
            ],
            [
                'id' => 7,
                'Sensor 2',
            ],
            [
                'id' => 8,
                'Sensor 3',
            ],
            [
                'id' => 9,
                'Sensor 4',
            ],
            [
                'id' => 10,
                'Sensor 5',
            ],
            [
                'id' => 11,
                'Sensor 6',
            ],
            [
                'id' => 12,
                'Sensor 7',
            ],
            [
                'id' => 13,
                'Sensor 8',
            ],
        ];

        foreach ($sensors as $sensor) {
            Sensor::created($sensor);
        }
    }
}
