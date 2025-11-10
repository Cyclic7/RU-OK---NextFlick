<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Movie;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $movies = Movie::all();

        if ($users->isEmpty() || $movies->isEmpty()) {
            return;
        }

        $comments = [
            "This movie was absolutely fantastic! Highly recommend.",
            "Not my cup of tea, but the acting was good.",
            "A masterpiece of cinema. Loved every minute.",
            "Too slow-paced for my liking.",
            "Great story and amazing visuals.",
            "The plot had some holes, but overall enjoyable.",
            "One of the best films I've seen this year.",
            "Disappointing. Expected more from this director.",
            "Incredible performances by the cast.",
            "Boring and predictable. Wouldn't watch again.",
            "A true gem. Hidden treasure of a movie.",
            "Overrated. Not as good as the hype.",
            "Beautiful cinematography and emotional depth.",
            "Lacked originality, but still entertaining.",
            "Mind-blowing! Changed my perspective on the genre.",
        ];

        foreach ($movies as $movie) {
            // Random number of reviews per movie (0-400) for star-related reviews
            $numReviews = rand(0, 400);

            $randomUsers = $users->random(min($numReviews, $users->count()));

            foreach ($randomUsers as $user) {
                Review::create([
                    'user_id' => $user->id,
                    'movie_id' => $movie->id,
                    'comment' => $comments[array_rand($comments)],
                ]);
            }
        }
    }
}
