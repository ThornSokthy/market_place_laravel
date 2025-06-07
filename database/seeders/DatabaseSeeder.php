<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 random users
        User::factory(10)->create();

        // Create specific test user
//        User::factory()->create([
//            'first_name' => 'Test',
//            'last_name' => 'User',
//            'email' => 'test@example.com',
//            'phone' => '1234567890', // Required unique field
//            'password' => bcrypt('password'), // Explicit password
//        ]);
    }
}
