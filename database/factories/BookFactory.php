<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
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
        $authorId = Author::inRandomOrder()->first()->id;

        return [
            'title' => $this->faker->sentence,
            'author_id' => $authorId,
            'serial_number' => $this->faker->generateUniqueSerialNumber(),
        ];
    }

    private function generateUniqueSerialNumber(): string
    {
        do {
            $serialNumber = $this->faker->unique()->numberBetween(100, 99999); // Minimal 3 angka, maksimal 5 digit
        } while (Book::where('serial_number', $serialNumber)->exists());

        return $serialNumber;
    }
}
