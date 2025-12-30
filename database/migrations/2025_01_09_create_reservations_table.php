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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('id_reservation');
            $table->date('date_reservation');
            $table->enum('statut', ['en_attente', 'confirmee', 'disponible', 'annulee'])->default('en_attente');
            $table->boolean('notifier')->default(false);
            $table->integer('position')->default(0);
            $table->foreignId('id_membre')->constrained('membres', 'id_membre')->onDelete('cascade');
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
        Schema::dropIfExists('reservations');
    }
};
