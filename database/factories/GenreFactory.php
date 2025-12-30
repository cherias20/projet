<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = [
            'Roman',
            'Science-fiction',
            'Fantaisie',
            'Thriller',
            'Mystère',
            'Biographie',
            'Histoire',
            'Essai',
            'Poésie',
            'Jeunesse',
        ];

        return [
            'nom' => $this->faker->unique()->randomElement($genres),
            'description' => $this->faker->optional()->paragraph(2),
        ];
    }
}
