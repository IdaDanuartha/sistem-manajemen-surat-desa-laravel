<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\VillageHead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillageHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VillageHead::create([
            'employee_number' => "19671031 201212 1001",
            'name' => 'I Ketut Oka Putra Werdiyasa, SE'
        ])->user()->create([
            'username' => '196710312012121001',
            'email' => 'lurah@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::VILLAGE_HEAD,
        ]);
    }
}
