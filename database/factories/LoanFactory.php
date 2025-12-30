<?php

namespace Database\Factories;

use App\Models\Membre;
use App\Models\Exemplaire;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateEmprunt = $this->faker->dateTimeBetween('-3 months', 'now');

        return [
            'date_emprunt' => $dateEmprunt,
            'date_retour_prevue' => Carbon::instance($dateEmprunt)->addDays(14),
            'date_retour' => $this->faker->optional(0.7)->dateTimeBetween($dateEmprunt, 'now'),
            'statut' => $this->faker->randomElement(['en_cours', 'termine', 'retard']),
            'nombre_renouvellement' => $this->faker->numberBetween(0, 2),
            'renouvellement_max' => 3,
            'date_dernier_renouvellement' => $this->faker->optional()->dateTimeBetween('-2 months', 'now'),
            'id_membre' => Membre::factory(),
            'id_exemple' => Exemplaire::factory(),
        ];
    }
}
