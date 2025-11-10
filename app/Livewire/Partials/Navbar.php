<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Genre;

class Navbar extends Component
{
    public $selectedGenre = '';
    public $search = '';
    public $genres;

    public function mount()
    {
        $this->genres = Genre::all();
    }

    public function updatedSelectedGenre($value)
    {
        $this->dispatch('genreSelected', $value);
    }

    public function updatedSearch($value)
    {
        $this->dispatch('searchUpdated', $value);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.partials.navbar', [
            'user' => Auth::user(),
        ]);
    }
}
