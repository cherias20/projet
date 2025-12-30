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
        Schema::create('membres', function (Blueprint $table) {
            $table->id('id_membre');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('adresse');
            $table->string('telephone')->nullable();
            $table->enum('role', ['admin', 'membre'])->default('membre');
            $table->string('numero_carte')->unique();
            $table->text('biographie')->nullable();
            $table->timestamp('date_creation')->useCurrent();
            $table->date('date_inscription');
            $table->enum('statut', ['actif', 'suspendu', 'inactif'])->default('actif');
            $table->decimal('note', 3, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};
