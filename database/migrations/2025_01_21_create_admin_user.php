<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ajouter le compte admin
        DB::table('membres')->updateOrInsert(
            ['email' => 'admin@exemple.com'],
            [
                'nom' => 'Admin',
                'prenom' => 'Système',
                'email' => 'admin@exemple.com',
                'mot_de_passe' => Hash::make('admin@2025'),
                'telephone' => '0123456789',
                'role' => 'admin',
                'numero_carte' => 'ADMIN-' . time(),
                'adresse' => '123 Rue des Livres',
                'date_inscription' => now(),
                'statut' => 'actif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('membres')->where('email', 'admin@exemple.com')->delete();
    }
};
