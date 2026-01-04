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
        Schema::table('exemplaires', function (Blueprint $table) {
            // Rendre code_barre nullable pour pouvoir générer automatiquement
            $table->string('code_barre')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exemplaires', function (Blueprint $table) {
            $table->string('code_barre')->nullable(false)->change();
        });
    }
};
