<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;

class Dashboard extends Component
{
    public $totalMovies;
    public $totalUsers;
    public $totalReviews;

    public function mount()
    {
        $this->totalMovies = Movie::count();
        $this->totalUsers = User::count();
        $this->totalReviews = Review::count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard'); // ✅ this should point to resources/views/layouts/admin.blade.php
    }
}
