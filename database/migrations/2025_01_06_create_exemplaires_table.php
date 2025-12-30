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
        Schema::create('exemplaires', function (Blueprint $table) {
            $table->id('id_exemple');
            $table->string('code_barre')->unique();
            $table->string('format')->nullable();
            $table->enum('statut', ['disponible', 'emprunté', 'perdu', 'maintenance'])->default('disponible');
            $table->date('date_acquisition');
            $table->decimal('prix_achat', 10, 2);
            $table->foreignId('id_livre')->constrained('books', 'id_livre')->onDelete('cascade');
            $table->timestamp('date_creation')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemplaires');
    }
};
