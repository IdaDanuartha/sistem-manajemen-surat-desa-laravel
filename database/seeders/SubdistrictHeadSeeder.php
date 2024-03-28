<?php

namespace Database\Seeders;

use App\Models\SubdistrictHead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubdistrictHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubdistrictHead::create([
            "employee_number" => "11111111 222222 3333",
            "name" => "Ida Nyoman Astawa, SSTP",
        ]);
    }
}
