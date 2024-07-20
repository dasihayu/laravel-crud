<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();
        $bookCount = 50;
        $faker = Faker::create(); // Buat instance Faker

        // Buat buku
        for ($i = 0; $i < $bookCount; $i++) {
            // Pilih author secara acak
            $author = $authors->random();

            // Generate a random date before today
            $randomDate = $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d');

            // Buat buku
            Book::create([
                'title' => 'Book Title ' . ($i + 1),
                'serial_number' => $this->generateUniqueSerialNumber(),
                'author_id' => $author->id,
                'published_at' => $randomDate,
            ]);
        }
    }

    private function generateUniqueSerialNumber(): string
    {
        do {
            $serialNumber = rand(100, 99999); // Minimal 3 angka, maksimal 5 digit
        } while (Book::where('serial_number', $serialNumber)->exists());

        return $serialNumber;
    }
}
