<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;
use App\Models\Genre;

class MovieList extends Component
{
    public $movies;
    public $genreName = '';
    public $selectedGenre = '';
    public $search = '';

    protected $listeners = [
        'genreSelected',
        'searchUpdated',
        'movieUpdated' => 'loadMovies', // 👈 listen for admin updates
    ];

    public function mount()
    {
        $this->loadMovies();
    }

    public function genreSelected($id)
    {
        $this->selectedGenre = $id;
        $this->loadMovies();
    }

    public function searchUpdated($query)
    {
        $this->search = $query;
        $this->loadMovies();
    }

    public function loadMovies()
    {
        $query = Movie::with('genres', 'likes', 'reviews');

        if ($this->selectedGenre) {
            $query->whereHas('genres', function ($q) {
                $q->where('genres.id', $this->selectedGenre);
            });
        }

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        $this->movies = $query->get();

        $this->genreName = $this->selectedGenre
            ? optional(Genre::find($this->selectedGenre))->name
            : '';
    }

    public function render()
    {
        return view('livewire.movie-list');
    }
}
