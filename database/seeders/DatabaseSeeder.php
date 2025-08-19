<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ModuleSeeder::class,
            QuizSeeder::class,
            LiveSessionSeeder::class,
        ]);

        // Create default admin
        \App\Models\User::firstOrCreate([
            'email' => 'admin@platform.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('admin123'),
            'user_type' => 'admin',
            'role' => 'admin',
            'current_month' => 1,
        ]);

        // Create default manager
        \App\Models\User::firstOrCreate([
            'email' => 'manager@platform.com',
        ], [
            'name' => 'Manager',
            'password' => bcrypt('manager123'),
            'user_type' => 'manager',
            'role' => 'manager',
            'current_month' => 1,
        ]);
    }
}