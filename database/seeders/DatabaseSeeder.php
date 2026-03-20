<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }

    public function run(): void
    {
        \App\Models\Department::insert([
            ['name' => 'Sales',      'created_at' => now()],
            ['name' => 'HR',         'created_at' => now()],
            ['name' => 'IT',         'created_at' => now()],
            ['name' => 'Marketing',  'created_at' => now()],
            ['name' => 'Finance',    'created_at' => now()],
            ['name' => 'Operations', 'created_at' => now()],
        ]);
    }
}
