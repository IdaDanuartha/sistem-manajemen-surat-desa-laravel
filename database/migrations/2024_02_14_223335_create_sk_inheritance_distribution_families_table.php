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
            $table->bigInteger("sk_inheritance_distribution_id"); 
            $table->foreignIdFor(Citizent::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // yang mendapatkan warisan
            $table->integer("area");
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
