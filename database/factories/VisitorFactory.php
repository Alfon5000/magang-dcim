<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'category_id' => Arr::random([1, 2, 3]),
            'status_id' => Arr::random([1, 2, 3]),
            'start_date' => fake()->date(max: now()),
            'end_date' => fake()->date(max: now()),
            'application_letter' => fake()->word(),
            'description' => fake()->paragraph(),
        ];
    }
}
