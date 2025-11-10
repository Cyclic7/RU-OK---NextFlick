<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Rating;

class MovieComments extends Component
{
    public $movie;
    public $filter = 'all'; // all, high, low

    public function mount($id)
    {
        $this->movie = Movie::with(['reviews.user', 'ratings'])->findOrFail($id);
    }

    public function updatedFilter()
    {
        // Refresh when filter changes
        $this->movie->load(['reviews.user', 'ratings']);
    }

    public function getFilteredReviewsProperty()
    {
        $reviews = $this->movie->reviews;

        if ($this->filter === 'high') {
            return $reviews->sortByDesc(function ($review) {
                $rating = $this->movie->ratings->where('user_id', $review->user_id)->first();
                return $rating ? $rating->score : 0;
            });
        }

        if ($this->filter === 'low') {
            return $reviews->sortBy(function ($review) {
                $rating = $this->movie->ratings->where('user_id', $review->user_id)->first();
                return $rating ? $rating->score : 0;
            });
        }

        return $reviews;
    }

    public function render()
    {
        return view('livewire.movie-comments', [
            'reviews' => $this->filteredReviews,
        ]);
    }
}
