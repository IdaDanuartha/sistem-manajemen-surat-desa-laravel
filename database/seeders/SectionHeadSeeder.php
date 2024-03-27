<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\SectionHead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SectionHead::create([
            'employee_id' => "19730223 200701 1025",
            'name' => 'I Gede Tantra Eka Putra, SE',
            'position' => 'Sekretaris'
        ])->user()->create([
            'username' => '197302232007011025',
            'email' => 'sekretaris@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::SECTION_HEAD,
        ]);

        SectionHead::create([
            'employee_id' => "19700815 200604 1005",
            'name' => 'I Made Widastra, SE',
            'position' => 'Kasi Pembangungan'
        ])->user()->create([
            'username' => '197008152006041005',
            'email' => 'kasi1@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::SECTION_HEAD,
        ]);

        SectionHead::create([
            'employee_id' => "19700601 200604 1009",
            'name' => 'I MADE KAJENG NGURAH SUPARTA, SH',
            'position' => 'Kasi Pemerintahan dan Kesejahteraan Sosial'
        ])->user()->create([
            'username' => '197006012006041009',
            'email' => 'kasi2@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::SECTION_HEAD,
        ]);
    }
}
