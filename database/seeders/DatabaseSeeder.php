<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create(['name' => 'Admin'])->user()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
            'role' => Role::ADMIN
        ]);
    }
}
