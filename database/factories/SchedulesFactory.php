<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\schedules>
 */
class SchedulesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'route_id' => fake()->numberBetween(1,5),
            'week_num' => fake()->numberBetween(1,4),
            'from' => fake()->dateTime(),
            'to' => fake()->dateTime(),
            'active' => 1
        ];
    }
}
