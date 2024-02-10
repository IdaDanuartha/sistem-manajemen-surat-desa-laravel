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
        Schema::create('sk_grant_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sk::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Citizent::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // penerima hibah
            $table->string("police_number");
            $table->string("owner_name");
            $table->text("address");
            $table->string("brand");
            $table->string("type");
            $table->string("model");
            $table->year("production_year");
            $table->string("cylinder_filling"); // isi selinder
            $table->string("frame_number"); // no. rangka
            $table->string("machine_number"); // no. mesin
            $table->string("bpkb_number"); // no. bpkb
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_grant_letters');
    }
};
