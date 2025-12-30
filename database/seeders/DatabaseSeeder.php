<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Exemplaire;
use App\Models\Membre;
use App\Models\Loan;
use App\Models\Reservation;
use App\Models\Penalty;
use App\Models\Parameter;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer les genres
        Genre::factory(10)->create();

        // Créer les auteurs
        $authors = Author::factory(20)->create();

        // Créer les livres
        $books = Book::factory(30)->create();

        // Attacher les auteurs et genres aux livres
        $books->each(function (Book $book) use ($authors) {
            $book->authors()->attach(
                $authors->random(rand(1, 3))->pluck('id_auteur')->toArray()
            );
            $book->genres()->attach(
                Genre::all()->random(rand(1, 3))->pluck('id_genre')->toArray()
            );
        });

        // Créer les exemplaires pour chaque livre
        $books->each(function (Book $book) {
            Exemplaire::factory(rand(2, 5))->create([
                'id_livre' => $book->id_livre,
            ]);
        });

        // Créer les membres
        $membres = Membre::factory(15)->create();

        // Créer un admin
        Membre::create([
            'nom' => 'Admin',
            'prenom' => 'Chery',
            'email' => 'admin@biblio.local',
            'adresse' => '123 Rue de la Biblio',
            'telephone' => '0123456789',
            'role' => 'admin',
            'numero_carte' => 'ADMIN-001',
            'date_inscription' => now()->toDateString(),
            'statut' => 'actif',
        ]);

        // Créer quelques emprunts
        Loan::factory(8)->create();

        // Créer quelques réservations
        $membres->each(function (Membre $membre) use ($books) {
            if (rand(0, 1)) {
                Reservation::create([
                    'date_reservation' => now()->toDateString(),
                    'statut' => 'en_attente',
                    'position' => 1,
                    'id_membre' => $membre->id_membre,
                    'id_livre' => $books->random()->id_livre,
                ]);
            }
        });

        // Créer les paramètres de configuration
        Parameter::create([
            'cle' => 'loan_duration_days',
            'valeur' => '14',
            'description' => 'Durée standard d\'un emprunt en jours',
        ]);

        Parameter::create([
            'cle' => 'max_renewals',
            'valeur' => '3',
            'description' => 'Nombre maximum de renouvellements par emprunt',
        ]);

        Parameter::create([
            'cle' => 'daily_penalty_rate',
            'valeur' => '1.50',
            'description' => 'Tarif journalier de pénalité en euros',
        ]);

        Parameter::create([
            'cle' => 'max_active_loans',
            'valeur' => '5',
            'description' => 'Nombre maximum d\'emprunts actifs par membre',
        ]);
    }
}
