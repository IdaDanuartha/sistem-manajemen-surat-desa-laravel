<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Admin;
use App\Models\SuperAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuperAdmin::create(['name' => 'Super Admin'])->user()->create([
            'username' => 'super_admin',
            'email' => 'super.admin@gmail.com',
            'password' => 'admin',
            'role' => Role::SUPER_ADMIN
        ]);

        Admin::create(['name' => 'Admin'])->user()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'role' => Role::ADMIN
        ]);
    }
}
