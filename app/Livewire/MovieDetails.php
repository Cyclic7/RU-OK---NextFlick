<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;

class MovieDetails extends Component
{
    public $movie;
    public $showAllComments = false;

    protected $layout = 'layouts.app';

    public function mount($id)
    {
        $this->movie = Movie::with('genres', 'reviews.user', 'likes')->findOrFail($id);
    }

    public function toggleComments()
    {
        $this->showAllComments = !$this->showAllComments;
    }

    public function getFeaturedCommentsProperty()
    {
        return $this->movie->reviews()->with('user')->take(3)->get();
    }

    public function render()
    {
        return view('livewire.movie-details');
    }
}
