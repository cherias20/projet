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
        Schema::create('penalites', function (Blueprint $table) {
            $table->id('id_penalite');
            $table->decimal('montant', 10, 2);
            $table->date('date_calcul');
            $table->date('date_paiement')->nullable();
            $table->string('raison');
            $table->enum('statut', ['non_payee', 'payee', 'remise'])->default('non_payee');
            $table->foreignId('id_membre')->constrained('membres', 'id_membre')->onDelete('cascade');
            $table->foreignId('id_emprunt')->constrained('emprunts', 'id_emprunt')->onDelete('cascade');
            $table->timestamp('date_creation')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalites');
    }
};
