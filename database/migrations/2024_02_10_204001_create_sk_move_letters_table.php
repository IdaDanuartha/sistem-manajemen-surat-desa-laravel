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
        Schema::create('sk_move_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sk::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Citizent::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // kepala keluarga
            $table->smallInteger("sk_move_type")->comment("[1: Pindah_Antar_Kecamatan, 2: Pindah_Antar_Lingkungan, 3: Pindah_Antar_Desa, 4: Pindah_Antar_Provinsi]");
            $table->text("reason");
            $table->text("moving_address");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_move_letters');
    }
};
