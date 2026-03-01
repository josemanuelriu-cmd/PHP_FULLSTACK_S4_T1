<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardGames>
 */
class BoardGamesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'min_players' => fake()->numberBetween(3, 4),
            'max_players' => fake()->numberBetween(4, 10),
            'min_age' => fake()->numberBetween(8, 18),
            'duration' => fake()->numberBetween(30, 180),
            'description' => fake()->text(),
        ];
    }
}
