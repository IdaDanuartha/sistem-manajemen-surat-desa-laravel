<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\BloodGroup;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;
use App\Enums\Role;
use App\Models\Admin;
use App\Models\Citizent;
use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        // Citizent::create([
        //     "name" => "Danuartha",
        //     "national_identify_number" => "51013834734434",
        //     "phone_number" => "081234567890",
        //     "family_card_number" => "520483734434",
        //     "gender" => Gender::MAN,
        //     "birth_place" => "Bandung",
        //     "birth_date" => "2004-12-14",
        //     "blood_group" => BloodGroup::O,
        //     "religion" => Religion::HINDU,
        //     "marital_status" => MaritalStatus::SINGLE,
        //     "work" => "Pegawai Negeri Sipil",
        //     "address" => "Jln Gunung Agung"
        // ])->villageHead()->create()->user()->create([
        //     'username' => '51013834734434',
        //     'email' => 'danuart21@gmail.com', // pake akun sendiri kalau mau coba fitur kirim emailnya
        //     'password' => '123456',
        //     'role' => Role::VILLAGE_HEAD,
        // ]);

        // Citizent::create([
        //     "name" => "Putu",
        //     "national_identify_number" => "51034734734434",
        //     "phone_number" => "081234567890",
        //     "family_card_number" => "510438434634434",
        //     "gender" => Gender::WOMAN,
        //     "birth_place" => "Surabaya",
        //     "birth_date" => "2004-12-14",
        //     "blood_group" => BloodGroup::O,
        //     "religion" => Religion::HINDU,
        //     "marital_status" => MaritalStatus::SINGLE,
        //     "work" => "Pegawai Negeri Swasta",
        //     "address" => "Monang Maning"
        // ])->environmentalHead()->create()->user()->create([
        //     'username' => '51034734734434',
        //     'email' => 'sucitadanuarthabali12@gmail.com', // pake akun sendiri kalau mau coba fitur kirim emailnya
        //     'password' => '123456',
        //     'role' => Role::ENVIRONMENTAL_HEAD,
        // ]);

        // Citizent::create([
        //     "name" => "Ivan Verdyansyah",
        //     "national_identify_number" => "51053857343434",
        //     "phone_number" => "081234567890",
        //     "family_card_number" => "5948347343434",
        //     "gender" => Gender::MAN,
        //     "birth_place" => "Bali",
        //     "birth_date" => "2004-12-14",
        //     "blood_group" => BloodGroup::O,
        //     "religion" => Religion::ISLAM,
        //     "marital_status" => MaritalStatus::SINGLE,
        //     "work" => "Guru",
        //     "address" => "Dalung Permai"
        // ])->sectionHead()->create()->user()->create([
        //     'username' => '51053857343434',
        //     'email' => 'sampleakun19@gmail.com', // pake akun sendiri kalau mau coba fitur kirim emailnya
        //     'password' => '123456',
        //     'role' => Role::SECTION_HEAD,
        // ]);

        Citizent::create([
            "name" => "Widyasa",
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
            'email' => 'dandevofficial@gmail.com', // pake akun sendiri kalau mau coba fitur kirim emailnya
            'password' => '123456',
            'role' => Role::CITIZENT,
        ]);
        Citizent::create([
            "name" => "Aditya Prayatna",
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
            'email' => 'widyarusmananda15@gmail.com', // pake akun sendiri kalau mau coba fitur kirim emailnya
            'password' => '123456',
            'role' => Role::CITIZENT,
        ]);
    }
}
