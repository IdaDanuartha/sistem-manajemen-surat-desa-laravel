<?php

namespace Database\Seeders;

use App\Enums\BloodGroup;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;
use App\Enums\Role;
use App\Models\Citizent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitizentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Citizent::create([
            "environmental_id" => 1,
            "name" => "Citizen 1",
            "national_identify_number" => "5205394853435",
            "phone_number" => "081234567890",
            "family_card_number" => "5350259385334",
            "gender" => Gender::WOMAN,
            "birth_place" => "Denpasar",
            "birth_date" => "2004-12-14",
            "blood_group" => BloodGroup::A,
            "religion" => Religion::BUDHA,
            "marital_status" => MaritalStatus::MARRY,
            "work" => "Mahasiswa",
            "address" => "Ubung Kaja"
        ])->user()->create([
            'username' => '5205394853435',
            'email' => 'citizen1@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::CITIZENT,
        ]);
        
        Citizent::create([
            "environmental_id" => 2,
            "name" => "Citizen 2",
            "national_identify_number" => "5007456564456",
            "phone_number" => "081234567890",
            "family_card_number" => "5350259385334",
            "gender" => Gender::MAN,
            "birth_place" => "Denpasar",
            "birth_date" => "2004-12-14",
            "blood_group" => BloodGroup::O,
            "religion" => Religion::HINDU,
            "marital_status" => MaritalStatus::MARRY,
            "work" => "Mahasiswa",
            "address" => "Ubung Kaja"
        ])->user()->create([
            'username' => '5007456564456',
            'email' => 'citizen2@gmail.com',
            'password' => 'pengguna123',
            'role' => Role::CITIZENT,
        ]);
    }
}
