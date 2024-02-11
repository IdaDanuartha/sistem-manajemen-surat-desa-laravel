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
        Schema::create('sk_die_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sk::class)
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreignIdFor(Citizent::class)
                    ->nullable()
                    ->cascadeOnUpdate()
                    ->nullOnDelete(); // orang yang meninggal
            $table->year("year");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_die_letters');
    }
};
