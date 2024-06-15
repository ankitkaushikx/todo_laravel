<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo; // Import Todo model
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create a single user for example
        // User::factory()->create([
        //     'name' => 'Ankit Kaushik',
        //     'email' => 'ankitkaushik@gmail.com',
        // ]);

        // Create 200 todos using TodoFactory
        Todo::factory()->count(2000)->create();
    }
}
