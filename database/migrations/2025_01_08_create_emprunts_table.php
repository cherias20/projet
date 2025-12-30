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
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id('id_emprunt');
            $table->date('date_emprunt');
            $table->date('date_retour_prevue');
            $table->date('date_retour')->nullable();
            $table->enum('statut', ['en_cours', 'termine', 'retard', 'perdu'])->default('en_cours');
            $table->integer('nombre_renouvellement')->default(0);
            $table->integer('renouvellement_max')->default(3);
            $table->date('date_dernier_renouvellement')->nullable();
            $table->foreignId('id_membre')->constrained('membres', 'id_membre')->onDelete('cascade');
            $table->foreignId('id_exemple')->constrained('exemplaires', 'id_exemple')->onDelete('cascade');
            $table->timestamp('date_creation')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
