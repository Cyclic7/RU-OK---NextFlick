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
    public $showProfileMenu = false;

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

    public function toggleProfileMenu()
    {
        $this->showProfileMenu = !$this->showProfileMenu;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('partials.navbar', [
            'user' => Auth::user(),
        ]);
    }
}
