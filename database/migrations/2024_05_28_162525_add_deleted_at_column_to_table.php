<?php

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
        Schema::table('sks', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_birth_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_marry_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_marital_status_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sktu_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sktm_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_name_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_subsidized_housing_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_move_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_traveling_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_residence_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_land_price_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_parent_income_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_die_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('parental_permission_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_grant_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('diesel_purchase_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_domicile_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('registration_form_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tree_felling_letters', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_power_attorneys', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('inheritance_geneologies', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_heirs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sk_inheritance_distributions', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sks', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_birth_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_marry_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_marital_status_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sktu_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sktm_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_name_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_subsidized_housing_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_move_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_traveling_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_residence_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_land_price_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_parent_income_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_die_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('parental_permission_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_grant_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('diesel_purchase_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_domicile_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('registration_form_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('tree_felling_letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_power_attorneys', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('inheritance_geneologies', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_heirs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sk_inheritance_distributions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });    
    }
};
