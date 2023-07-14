<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TemperatureHumidity>
 */
class TemperatureHumidityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sensor_id' => rand(6, 11),
            'temperature' => rand(20, 28),
            'humidity' => rand(40, 55),
            'created_at' => fake()->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
