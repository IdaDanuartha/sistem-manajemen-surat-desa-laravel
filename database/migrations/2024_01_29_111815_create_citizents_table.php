<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citizents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('national_identify_number')->unique()->comment('nik');
            $table->string('phone_number', 15);
            $table->string('family_card_number')->comment('no kartu keluarga');
            $table->smallInteger('gender')->comment('[1: Laki-Laki, 2: Perempuan]');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->smallInteger('blood_group')->comment('[1: O, 2: A, 3: B, 4: AB]');
            $table->smallInteger('religion')
                  ->comment('[1: Islam, 2: Kristen Protestan, 3: Kristen Katolik, 4: Hindu, 5: Buddha, 6: Konghucu]');
            $table->smallInteger('marital_status')
                  ->comment('[1: Belum Kawin, 2: Kawin, 3: Cerai Hidup, 4: Cerai Mati]');
            $table->string('profile_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizents');
    }
};
