<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();
        $bookCount = 50;

        // Buat buku
        for ($i = 0; $i < $bookCount; $i++) {
            // Pilih author secara acak
            $author = $authors->random();

            // Buat buku
            Book::create([
                'title' => 'Book Title ' . ($i + 1),
                'serial_number' => $this->generateUniqueSerialNumber(),
                'author_id' => $author->id,
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
