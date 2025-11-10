<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            MovieSeeder::class,
            RatingSeeder::class,
            LikeSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
