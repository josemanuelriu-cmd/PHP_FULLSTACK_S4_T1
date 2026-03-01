<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num_partner' => fake()->unique()->numberBetween(1, 40),
            'nickname' => fake()->unique()->userName(),
            'name' => fake()->name(),
            'password' => static::$password ??= Hash::make('password'),
            'type' => fake()->randomElement(['admin', 'partner', 'guest']),
            'registration_date' => fake()->date(),
            'withdrawal_date' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'telephone' => fake()->unique()->phoneNumber(),
            'age' => fake()->numberBetween(18, 100),
            'email_verified_at' => now(),            
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
