<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'phone' => '380' . fake()->unique()->numerify('#########'),
            'photo' => null,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    public function withPositions(iterable $positions): static
    {
        return $this->state(fn(array $attributes) => [
            'position_id' => $positions->random()->id,
        ]);
    }
}
