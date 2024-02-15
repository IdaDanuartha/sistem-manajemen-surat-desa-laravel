<?php

use App\Models\Citizent;
use App\Models\SkPowerAttorney;
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
        Schema::create('sk_power_attorney_families', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SkPowerAttorney::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Citizent::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // ahli waris
            $table->smallInteger("relationship_status")->comment("[1: SUAMI, 2: ISTRI, 3: ANAK]");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_power_attorney_families');
    }
};
