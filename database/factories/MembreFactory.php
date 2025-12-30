<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membre>
 */
class MembreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->email(),
            'adresse' => $this->faker->address(),
            'telephone' => $this->faker->phoneNumber(),
            'role' => 'membre',
            'numero_carte' => $this->faker->unique()->numerify('MB-########'),
            'biographie' => $this->faker->optional()->paragraph(2),
            'date_inscription' => $this->faker->date(),
            'statut' => $this->faker->randomElement(['actif', 'suspendu', 'inactif']),
            'note' => $this->faker->optional()->randomFloat(2, 1, 5),
        ];
    }
}
