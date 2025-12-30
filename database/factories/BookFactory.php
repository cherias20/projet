<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(3),
            'sous_titre' => $this->faker->optional()->sentence(2),
            'editeur' => $this->faker->company(),
            'annee_publication' => $this->faker->year(),
            'resume' => $this->faker->paragraph(5),
            'langue' => 'Français',
            'pages' => $this->faker->numberBetween(100, 600),
        ];
    }
}
