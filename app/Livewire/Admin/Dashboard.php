<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Movie;
use App\Models\User;
use App\Models\Review;
use App\Models\Genre;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $upcomingMovies;
    public $recentMovies;
    public $stats;

    public function mount()
    {
        $currentYear = date('Y');
        
        // UPCOMING: Movies from current year onwards
        $this->upcomingMovies = Movie::where('release_year', '>=', $currentYear)
                                    ->with('genres')
                                    ->orderBy('release_year')
                                    ->orderBy('created_at')
                                    ->take(8)
                                    ->get();

        // RECENT: Last 5 movies added
        $this->recentMovies = Movie::with('genres')->latest()->take(5)->get();
        
        // STATS: Focus on upcoming content
        $this->stats = [
            'total_movies' => Movie::count(),
            'total_users' => User::count(),
            'total_reviews' => Review::count(),
            'total_genres' => Genre::count(),
            'upcoming_count' => $this->upcomingMovies->count(),
            'missing_posters' => Movie::whereNull('poster_url')->orWhere('poster_url', '')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}