<?php
// app/Livewire/Admin/Dashboard.php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Genre;
use App\Models\Rating;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $totalMovies;
    public $totalUsers;
    public $totalReviews;
    public $totalGenres;
    public $recentMovies;
    public $moviesThisMonth;
    public $topRatedMovies;
    public $popularMovies;

    public function mount()
    {
        $this->totalMovies = Movie::count();
        $this->totalUsers = User::count();
        $this->totalReviews = Review::count();
        $this->totalGenres = Genre::count();
        $this->recentMovies = Movie::with('genres')->latest()->take(5)->get();
        $this->moviesThisMonth = Movie::whereYear('created_at', Carbon::now()->year)
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->count();
        $this->topRatedMovies = Movie::with('genres')
                                    ->where('average_rating', '>', 0)
                                    ->orderBy('average_rating', 'desc')
                                    ->take(5)
                                    ->get();
        $this->popularMovies = Movie::withCount('reviews')
                                   ->orderBy('reviews_count', 'desc')
                                   ->take(5)
                                   ->get();
    }

    public function getStatsDataProperty()
    {
        return [
            'movies_this_week' => Movie::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            'reviews_this_week' => Review::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            'avg_rating' => number_format(Rating::avg('score') ?? 0, 1),
            'fresh_movies' => Movie::all()->filter(fn($movie) => $movie->tomatometer >= 60)->count(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'stats' => $this->stats_data
        ]);
    }
}
