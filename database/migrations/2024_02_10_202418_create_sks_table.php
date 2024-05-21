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
        Schema::create('sks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Citizent::class)
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreignIdFor(EnvironmentalHead::class)
                    ->nullable()
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->foreignIdFor(SectionHead::class)
                    ->nullable()
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->foreignIdFor(VillageHead::class)
                    ->nullable()
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->smallInteger('status_by_environmental_head')->comment('[1: BelumDikonfirmasi, 2: Disetujui, 3: Ditolak]')->default(0);
            $table->smallInteger('status_by_section_head')->comment('[1: BelumDikonfirmasi, 2: Disetujui, 3: Ditolak]')->default(0);
            $table->smallInteger('status_by_village_head')->comment('[1: BelumDikonfirmasi, 2: Disetujui, 3: Ditolak]')->default(0);
            $table->string('code');
            $table->string('reference_number');
            $table->integer('mode')->nullable();
            $table->string('cover_letter_number')->nullable();
            $table->boolean('is_published')->default(0);
            $table->text('reject_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sks');
    }
};
