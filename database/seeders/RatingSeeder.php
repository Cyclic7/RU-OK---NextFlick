<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Movie;
use App\Models\User;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        // Create some dummy users if none exist
        if (User::count() === 0) {
            \App\Models\User::factory(5)->create();
        }

        $users = User::all();
        $movies = Movie::all();

        foreach ($movies as $movie) {
            foreach ($users->random(rand(2, 5)) as $user) {
                Rating::create([
                    'user_id' => $user->id,
                    'movie_id' => $movie->id,
                    'score' => rand(6, 10),
                ]);
            }
        }
    }
}
