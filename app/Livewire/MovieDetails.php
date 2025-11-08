<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;

class MovieDetails extends Component
{
    public $movie;

    protected $layout = 'layouts.app';

    public function mount($id)
    {
        $this->movie = Movie::with('genres')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.movie-details');
    }
}
