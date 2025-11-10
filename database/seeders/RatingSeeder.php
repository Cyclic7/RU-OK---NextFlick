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
            \App\Models\User::factory(10)->create();
        }

        $users = User::all();
        $movies = Movie::all();

        foreach ($movies as $movie) {
            // Create realistic tomatometer ratings: max 100 per movie
            $numRatings = rand(5, 100); // 5 to 100 ratings per movie for tomatometer
            $selectedUsers = $users->random(min($numRatings, $users->count()));

            foreach ($selectedUsers as $user) {
                // Mix of high and low ratings for varied tomatometer scores
                $score = rand(1, 10); // Include low ratings from 1-10
                Rating::create([
                    'user_id' => $user->id,
                    'movie_id' => $movie->id,
                    'score' => $score,
                ]);
            }
        }
    }
}
