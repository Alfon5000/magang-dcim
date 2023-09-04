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
                'id' => 5,
                'name' => 'Dry Contact Input Module RS485 Modbus',
            ],
            [
                'id' => 6,
                'name' => 'SHT20-MD01',
            ],
            [
                'id' => 7,
                'name' => 'SHT20-MD01',
            ],
            [
                'id' => 8,
                'name' => 'SHT20-MD01',
            ],
            [
                'id' => 9,
                'name' => 'SHT20-MD01',
            ],
            [
                'id' => 10,
                'name' => 'SHT20-MD01',
            ],
            // [
            //     'id' => 11,
            //     'name' => 'SHT20-MD01',
            // ],
        ];

        foreach ($sensors as $sensor) {
            Sensor::create($sensor);
        }
    }
}
