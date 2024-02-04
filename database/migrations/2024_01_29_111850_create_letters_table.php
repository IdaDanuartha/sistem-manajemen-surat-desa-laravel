<?php

use App\Models\Citizent;
use App\Models\EnvironmentalHead;
use App\Models\SectionHead;
use App\Models\VillageHead;
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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Citizent::class)
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignIdFor(VillageHead::class)
                  ->nullable()
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->foreignIdFor(EnvironmentalHead::class)
                  ->nullable()
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->foreignIdFor(SectionHead::class)
                  ->nullable()
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->boolean('approved_by_environmental_head')->default(0);
            $table->boolean('approved_by_section_head')->default(0);
            $table->boolean('approved_by_village_head')->default(0);
            $table->string('code');
            $table->string('message');
            // $table->string('letter_file');
            // $table->string('signature_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
