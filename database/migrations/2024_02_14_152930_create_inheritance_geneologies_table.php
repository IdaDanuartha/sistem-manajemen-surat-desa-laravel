<?php

use App\Models\Citizent;
use App\Models\Sk;
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
        Schema::create('inheritance_geneologies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sk::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Citizent::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // pewaris
            $table->string("inheritance_image");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inheritance_geneologies');
    }
};
