<?php

use App\Models\Citizent;
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
        Schema::create('subdistrict_heads', function (Blueprint $table) {
            $table->id();
            $table->string("employee_number");
            $table->string("name");
            $table->string("signature_image")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdistrict_heads');
    }
};
