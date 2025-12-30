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
        Schema::create('books', function (Blueprint $table) {
            $table->id('id_livre');
            $table->string('titre');
            $table->string('sous_titre')->nullable();
            $table->string('editeur');
            $table->year('annee_publication');
            $table->text('resume')->nullable();
            $table->string('langue')->default('Français');
            $table->integer('pages')->nullable();
            $table->timestamp('date_creation')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
