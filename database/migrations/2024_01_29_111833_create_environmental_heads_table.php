<?php

use App\Models\Citizent;
use App\Models\Environmental;
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
        Schema::create('environmental_heads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Environmental::class)
                  ->nullable()
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->string("name");
            $table->string("phone", 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('environmental_heads');
    }
};
