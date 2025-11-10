<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;
use App\Models\User;
use App\Models\Movie;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $movies = Movie::all();

        if ($users->isEmpty() || $movies->isEmpty()) {
            return;
        }

        foreach ($movies as $movie) {
            // Random likes and dislikes for each movie
            $numLikes = rand(0, 10);
            $numDislikes = rand(0, 5);

            $totalNeeded = $numLikes + $numDislikes;
            if ($totalNeeded > $users->count()) {
                $totalNeeded = $users->count();
            }

            $randomUsers = $users->random($totalNeeded);

            for ($i = 0; $i < $numLikes && $i < $randomUsers->count(); $i++) {
                Like::create([
                    'user_id' => $randomUsers[$i]->id,
                    'movie_id' => $movie->id,
                    'type' => 'like',
                ]);
            }

            for ($i = $numLikes; $i < $numLikes + $numDislikes && $i < $randomUsers->count(); $i++) {
                Like::create([
                    'user_id' => $randomUsers[$i]->id,
                    'movie_id' => $movie->id,
                    'type' => 'dislike',
                ]);
            }
        }
    }
}
