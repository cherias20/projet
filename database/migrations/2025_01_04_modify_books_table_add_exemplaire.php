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
        // Vérifier si la colonne existe et ajouter une valeur par défaut
        if (Schema::hasTable('books') && !Schema::hasColumn('books', 'exemplaire')) {
            Schema::table('books', function (Blueprint $table) {
                $table->integer('exemplaire')->default(1)->after('pages');
            });
        } elseif (Schema::hasTable('books') && Schema::hasColumn('books', 'exemplaire')) {
            // Si la colonne existe déjà, on change juste la contrainte
            Schema::table('books', function (Blueprint $table) {
                $table->integer('exemplaire')->default(1)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('exemplaire');
        });
    }
};
