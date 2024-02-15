<?php

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
        Schema::create('sk_land_price_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sk::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string("nop"); // nomor objek pajak
            $table->text("land_location");
            $table->bigInteger("price"); // price per are
            $table->string("purpose");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_land_price_letters');
    }
};
