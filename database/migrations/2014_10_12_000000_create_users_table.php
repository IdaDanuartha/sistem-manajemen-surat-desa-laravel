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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();            
            $table->string('password');
            $table->smallInteger('role')
                  ->comment('[0: SuperAdmin, 1: Admin, 2: VillageHead, 3: EnvironmentalHead, 4: SectionHead, 5: Inhabitant]');
            $table->boolean('status')->default(1);
            $table->morphs('authenticatable');
            $table->string('signature_image')->nullable();
            $table->string('profile_image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
