<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;
use App\Models\Genre;

class MovieList extends Component
{
    public $search = '';
    public $selectedGenre = '';

    protected $layout = 'layouts.app';

    public function render()
    {
        $query = Movie::query()->with('genres');

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->selectedGenre) {
            $query->whereHas('genres', function ($q) {
                $q->where('genres.id', $this->selectedGenre);
            });
        }

        return view('livewire.movie-list', [
            'movies' => $query->get(),
            'genres' => Genre::all(),
        ]);
    }
}
