<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Movie;
use App\Models\Genre;

class AdminMovies extends Component
{
    use WithPagination;

    public $title, $description, $release_year, $poster_url;
    public $selectedGenres = [];
    public $showForm = false;
    public $isEditing = false;
    public $movieId = null;
    public $search = '';
    public $sortField = 'title';
    public $sortDirection = 'asc';

    protected function rules()
    {
        $currentYear = date('Y');

        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'release_year' => 'required|integer|min:1880|max:' . ($currentYear + 5),
            'poster_url' => 'required|url',
            'selectedGenres' => 'required|array|min:1',
        ];
    }

    // ✅ Show create form - FIXED
    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->isEditing = false;
        $this->movieId = null;
    }

    // ✅ Save new movie - FIXED
    public function store()
    {
        $this->validate();

        $movie = Movie::create([
            'title' => $this->title,
            'description' => $this->description,
            'release_year' => $this->release_year,
            'poster_url' => $this->poster_url,
            'average_rating' => 0,
        ]);

        $movie->genres()->sync($this->selectedGenres);

        session()->flash('success', '🎬 Movie added successfully!');
        $this->resetForm();
        $this->showForm = false;
        $this->resetPage(); // Refresh the list
    }

    // ✅ Load movie to edit - FIXED
    public function loadMovie($movieId)
    {
        $movie = Movie::with('genres')->findOrFail($movieId);

        $this->movieId = $movie->id;
        $this->title = $movie->title;
        $this->description = $movie->description;
        $this->release_year = $movie->release_year;
        $this->poster_url = $movie->poster_url;
        $this->selectedGenres = $movie->genres->pluck('id')->toArray();

        $this->isEditing = true;
        $this->showForm = true;
    }

    // ✅ Update existing movie - FIXED
    public function update()
    {
        $this->validate();

        if (!$this->movieId) {
            session()->flash('error', 'No movie selected.');
            return;
        }

        $movie = Movie::findOrFail($this->movieId);
        $movie->update([
            'title' => $this->title,
            'description' => $this->description,
            'release_year' => $this->release_year,
            'poster_url' => $this->poster_url,
        ]);

        $movie->genres()->sync($this->selectedGenres);

        session()->flash('success', '✅ Movie updated successfully!');
        $this->resetForm();
        $this->showForm = false;
        $this->resetPage(); // Refresh the list
    }

    // ✅ Delete movie safely - FIXED
    public function deleteMovie($movieId)
    {
        $movie = Movie::find($movieId);

        if (!$movie) {
            session()->flash('error', 'Movie not found.');
            return;
        }

        $movie->genres()->detach();
        $movie->delete();

        session()->flash('success', '🗑️ Movie deleted successfully!');
        $this->resetPage(); // Refresh pagination
    }

    // ✅ Reset form data - FIXED
    public function resetForm()
    {
        $this->reset(['title', 'description', 'release_year', 'poster_url', 'selectedGenres', 'movieId']);
        $this->resetErrorBag();
    }

    // ✅ Cancel form - NEW
    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    public function render()
    {
        $movies = Movie::with('genres')
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.admin-movies', [
            'movies' => $movies,
            'genres' => Genre::all(),
        ]);
    }
}