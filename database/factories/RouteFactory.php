<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\route>
 */
class RouteFactory extends Factory
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
            'driver_id' => fake()->numberBetween(1,10),
            'vehicle_id' => fake()->numberBetween(1,10),
            'active' => 1
        ];
    }
}
