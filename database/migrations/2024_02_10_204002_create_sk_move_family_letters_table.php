<?php

use App\Models\Citizent;
use App\Models\SkMoveLetter;
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
        Schema::create('sk_move_family_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SkMoveLetter::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Citizent::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->smallInteger("relationship_status")->comment("[1: ORANG_TUA, 2: WALI, 3: SUAMI, 4: ISTRI, 5: ANAK]");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_move_family_letters');
    }
};
