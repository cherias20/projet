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
        Schema::create('book_author', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_livre')->constrained('books', 'id_livre')->onDelete('cascade');
            $table->foreignId('id_auteur')->constrained('authors', 'id_auteur')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['id_livre', 'id_auteur']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_author');
    }
};
