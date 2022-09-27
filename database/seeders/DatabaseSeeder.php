<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

        \App\Models\Driver::factory(10)->create();
        \App\Models\Vehicle::factory(10)->create();
        \App\Models\Route::factory(5)->create();
        \App\Models\Schedules::factory(3)->create();
    }
}
