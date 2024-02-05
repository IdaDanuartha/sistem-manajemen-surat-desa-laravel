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
            $table->string('reference_number')->comment('Nomor Surat');
            $table->string('attachment')->comment('Lampiran');
            $table->string('regarding')->comment('Perihal');
            $table->string('dear')->comment('Yth');
            $table->longText('message')->comment('Isi Surat');
            $table->text('copy_submitted')->comment('Tembusan Disampaikan');
            $table->text('invitation_attachment')->comment('Lampiran Surat Undangan');
            $table->boolean('is_published')->default(0);
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
