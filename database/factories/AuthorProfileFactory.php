<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthorProfile>
 */
class AuthorProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'age' => $this->faker->numberBetween(20, 60),
            'office' => "Office " . $this->faker->numberBetween(1, 10),
            'bio' => $this->faker->text(50),
        ];
    }
}
