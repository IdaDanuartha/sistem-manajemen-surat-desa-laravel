<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role;
use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EnvironmentalSeeder::class);
        $this->call(EnvironmentalHeadSeeder::class);
        $this->call(SectionHeadSeeder::class);
        $this->call(VillageHeadSeeder::class);
        $this->call(CitizentSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
