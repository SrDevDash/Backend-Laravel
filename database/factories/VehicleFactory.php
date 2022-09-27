<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vehicles>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => fake()->text(100),
            'year' => fake()->numberBetween(1970,2022),
            'make' => fake()->numberBetween(4,10),
            'capacity' => fake()->numberBetween(4,20),
            'active' => 1
        ];
    }
}
