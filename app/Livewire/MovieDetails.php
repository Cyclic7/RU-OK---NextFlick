<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Like;
use App\Models\Rating;
use App\Models\Review;

class MovieDetails extends Component
{
    public $movie;
    public $showAllComments = false;
    public $userLikeType = null;
    public $userRating = null;
    public $comment = '';

    public function mount($id)
    {
        $this->movie = Movie::with(['genres', 'reviews.user', 'likes', 'ratings'])->findOrFail($id);

        if (Auth::check()) {
            $this->userLikeType = Like::where('user_id', Auth::id())
                ->where('movie_id', $this->movie->id)
                ->value('type');

            $this->userRating = Rating::where('user_id', Auth::id())
                ->where('movie_id', $this->movie->id)
                ->value('score');
        }
    }

    public function likeMovie($type)
    {
        if (!Auth::check()) {
            $this->dispatch('guest-warning'); // Livewire 3 syntax
            return;
        }

        $existing = Like::where('user_id', Auth::id())
            ->where('movie_id', $this->movie->id)
            ->first();

        if ($existing) {
            if ($existing->type === $type) {
                $existing->delete();
                $this->userLikeType = null;
            } else {
                $existing->update(['type' => $type]);
                $this->userLikeType = $type;
            }
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'movie_id' => $this->movie->id,
                'type' => $type,
            ]);
            $this->userLikeType = $type;
        }

        $this->movie->refresh();
    }

    public function submitRatingAndComment()
    {
        if (!Auth::check()) {
            $this->dispatch('guest-warning');
            return;
        }

        if (!$this->userRating) {
            session()->flash('error', 'Please select a rating before submitting.');
            return;
        }

        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'movie_id' => $this->movie->id,
            ],
            ['score' => $this->userRating]
        );

        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $this->movie->id,
            'comment' => $this->comment ?? '',
        ]);

        $this->comment = '';
        $this->movie->refresh();
        session()->flash('success', 'Your rating and comment have been submitted!');
    }

    public function render()
    {
        return view('livewire.movie-details');
    }
}
