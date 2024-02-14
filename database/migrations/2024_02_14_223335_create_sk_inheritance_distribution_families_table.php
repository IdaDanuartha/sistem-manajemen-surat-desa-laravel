<?php

use App\Models\Citizent;
use App\Models\SkInheritanceDistribution;
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
        Schema::create('sk_inheritance_distribution_families', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SkInheritanceDistribution::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Citizent::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // yang mendapatkan warisan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_inheritance_distribution_families');
    }
};
