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
        Schema::table('membres', function (Blueprint $table) {
            $table->string('mot_de_passe')->nullable()->after('email');
            $table->rememberToken()->nullable()->after('mot_de_passe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membres', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
        });
    }
};
