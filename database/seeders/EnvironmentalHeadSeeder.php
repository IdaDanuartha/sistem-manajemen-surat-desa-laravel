<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\EnvironmentalHead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnvironmentalHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EnvironmentalHead::create([
            'environmental_id' => 1,
            'name' => 'I Wayan Ungsi'
        ])->user()->create([
            'username' => 'ljk',
            'email' => 'lingkungan1@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 2,
            'name' => 'I Wayan Sidra'
        ])->user()->create([
            'username' => 'jsk',
            'email' => 'lingkungan2@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 3,
            'name' => 'I Made Putra Ardana'
        ])->user()->create([
            'username' => 'glr',
            'email' => 'lingkungan3@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 4,
            'name' => 'I Gusti Gede Murya '
        ])->user()->create([
            'username' => 'gt',
            'email' => 'lingkungan4@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 5,
            'name' => 'I Gusti Bagus Wiryantara'
        ])->user()->create([
            'username' => 'lt',
            'email' => 'lingkungan5@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 6,
            'name' => 'I Gede Suasta Ardika '
        ])->user()->create([
            'username' => 'ld',
            'email' => 'lingkungan6@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 7,
            'name' => 'I Gusti Nyoman Ngurah'
        ])->user()->create([
            'username' => 'lg',
            'email' => 'lingkungan7@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 8,
            'name' => 'Muslim Nawawi'
        ])->user()->create([
            'username' => 'tlgms',
            'email' => 'lingkungan8@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 9,
            'name' => 'Budi Sastrawan'
        ])->user()->create([
            'username' => 'krs',
            'email' => 'lingkungan9@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);

        EnvironmentalHead::create([
            'environmental_id' => 10,
            'name' => 'I Komang Gede Arsana Putra'
        ])->user()->create([
            'username' => 'glk',
            'email' => 'lingkungan10@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::ENVIRONMENTAL_HEAD,
        ]);
    }
}
