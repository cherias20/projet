<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SetAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mettre à jour le rôle de l'admin
        DB::table('membres')->where('email', 'admin@exemple.com')->update([
            'role' => 'admin',
            'statut' => 'actif',
        ]);

        echo "Admin role updated!";
    }
}
