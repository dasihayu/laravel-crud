<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID'); // Menggunakan lokal Indonesia

        // Daftar nama depan yang mirip
        $firstNames = ['Agus', 'Budi', 'Joko', 'Siti', 'Ani', 'Rina', 'Wawan', 'Dedi', 'Lila', 'Yudi'];
        $lastNames = ['Susanto', 'Sutoyo', 'Suryadi', 'Prabowo', 'Hadi', 'Setiawan', 'Jaya', 'Rahmat', 'Putra', 'Nugroho'];

        // Mengambil nama depan dan nama belakang secara acak
        $firstName = $faker->randomElement($firstNames);
        $lastName = $faker->randomElement($lastNames);

        return [
            'name' => "$firstName $lastName",
            'email' => $faker->unique()->safeEmail,
        ];
    }
}
