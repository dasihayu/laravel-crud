<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\AuthorProfile;
use App\Models\Hobby;
use Database\Factories\AuthorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authorCount = 30;

        // Membuat authors
        Author::factory()->count($authorCount)->create()->each(function ($author) {
            // Membuat profile untuk setiap author
            $authorProfile = \App\Models\AuthorProfile::factory()->make();
            $author->profile()->save($authorProfile);

            // Mengambil hobi acak minimal 3 dengan ID 2-11
            $hobbies = Hobby::whereBetween('id', [1, 15])->inRandomOrder()->take(3)->pluck('id');
            $author->hobbies()->attach($hobbies);
        });

    }
}
