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
            $table->string('username')->unique();
            $table->string('email')->unique();            
            $table->string('password');
            $table->smallInteger('role')
                  ->comment('[1: Admin, 2: VillageHead, 3: EnvironmentalHead, 4: SectionHead, 5: Inhabitant]');
            $table->boolean('status')->default(1);
            $table->morphs('authenticatable');
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
