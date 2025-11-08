<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Action', 'Adventure', 'Comedy', 'Drama',
            'Fantasy', 'Horror', 'Romance', 'Sci-Fi',
            'Thriller', 'Animation',
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
