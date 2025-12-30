<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exemplaire>
 */
class ExemplaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_barre' => $this->faker->unique()->ean13(),
            'format' => $this->faker->randomElement(['Broché', 'Relié', 'Poche', 'Ebook']),
            'statut' => $this->faker->randomElement(['disponible', 'emprunté', 'maintenance']),
            'date_acquisition' => $this->faker->date(),
            'prix_achat' => $this->faker->randomFloat(2, 10, 50),
        ];
    }
}
