<?php

namespace Database\Seeders;

use App\Models\Environmental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnvironmentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Environmental::create([
            "code" => "LJK",
            "name" => "Jasri Kelod"
        ]);
        Environmental::create([
            "code" => "JSK",
            "name" => "Jasri Kaler"
        ]);
        Environmental::create([
            "code" => "GLR",
            "name" => "Galiran"
        ]);
        Environmental::create([
            "code" => "GT",
            "name" => "Genteng"
        ]);
        Environmental::create([
            "code" => "LT",
            "name" => "Tengah"
        ]);
        Environmental::create([
            "code" => "LD",
            "name" => "Desa"
        ]);
        Environmental::create([
            "code" => "LG",
            "name" => "Gede"
        ]);
        Environmental::create([
            "code" => "TLGMS",
            "name" => "Telagamas"
        ]);
        Environmental::create([
            "code" => "KRS",
            "name" => "Karangsokong"
        ]);
        Environmental::create([
            "code" => "GLK",
            "name" => "Galiran Kaler"
        ]);
    }
}
