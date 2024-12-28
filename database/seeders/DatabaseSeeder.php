<?php

namespace Database\Seeders;

use App\Models\Scientific_Paper;
use App\Models\User;
use App\Models\ScientificPaper;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Superadmin
        User::create([
            'nip' => 1000001,
            'position' => 'Super Administrator',
            'name' => 'Default Superadmin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        // Admin
        User::create([
            'nip' => 1000002,
            'position' => 'Administrator',
            'name' => 'Default Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Scientific Paper
        Scientific_Paper::create([
            'title' => 'Sample Scientific Paper',
            'year' => 2023,
            'nim' => 12345,
            'author' => 'John Doe',
            'mentor' => 'Dr. Jane Smith'
        ]);

        // User::factory(10)->create();
    }
}
