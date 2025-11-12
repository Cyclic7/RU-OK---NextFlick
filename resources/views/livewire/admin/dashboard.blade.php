<!-- resources/views/livewire/admin/dashboard.blade.php -->
<div class="p-8 bg-gray-900 text-white min-h-screen">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold flex items-center gap-3">📊 Movie Admin Dashboard</h1>
        <p class="text-gray-400 mt-2">Comprehensive overview of your movie platform</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Movies -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-blue-500 transition group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Movies</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalMovies }}</p>
                </div>
                <div class="text-3xl group-hover:scale-110 transition">🎬</div>
            </div>
            <div class="mt-4 text-sm text-green-400 flex items-center gap-1">
                ↑ +{{ $moviesThisMonth }} this month
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-green-500 transition group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Users</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
                </div>
                <div class="text-3xl group-hover:scale-110 transition">👤</div>
            </div>
        </div>

        <!-- Total Reviews -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-yellow-500 transition group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Reviews</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalReviews }}</p>
                </div>
                <div class="text-3xl group-hover:scale-110 transition">⭐</div>
            </div>
            <div class="mt-4 text-sm text-blue-400">
                +{{ $stats['reviews_this_week'] }} this week
            </div>
        </div>

        <!-- Fresh Movies -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-purple-500 transition group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Fresh Movies</p>
                    <p class="text-3xl font-bold mt-2">{{ $stats['fresh_movies'] }}</p>
                </div>
                <div class="text-3xl group-hover:scale-110 transition">🍅</div>
            </div>
            <div class="mt-4 text-sm text-green-400">
                {{ number_format(($stats['fresh_movies'] / max(1, $totalMovies)) * 100, 1) }}% of collection
            </div>
        </div>
    </div>

    <!-- Additional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
            <p class="text-gray-400 text-sm">Average Rating</p>
            <p class="text-2xl font-bold mt-2 flex items-center gap-2">
                ⭐ {{ $stats['avg_rating'] }}/10
            </p>
        </div>
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
            <p class="text-gray-400 text-sm">Genres Available</p>
            <p class="text-2xl font-bold mt-2">{{ $totalGenres }}</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
            <p class="text-gray-400 text-sm">New This Week</p>
            <p class="text-2xl font-bold mt-2">{{ $stats['movies_this_week'] }} movies</p>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Movies -->
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">🆕 Recent Movies</h2>
            <div class="space-y-3">
                @forelse($recentMovies as $movie)
                    <div class="flex items-center gap-4 p-3 bg-gray-750 rounded-lg hover:bg-gray-700 transition group">
                        <img src="{{ $movie->poster_url }}"
                             alt="{{ $movie->title }}"
                             class="w-12 h-16 object-cover rounded"
                             onerror="this.src='https://via.placeholder.com/48x64/374151/6b7280?text=No+Image'">
                        <div class="flex-1">
                            <h3 class="font-semibold group-hover:text-blue-400 transition">{{ $movie->title }}</h3>
                            <p class="text-sm text-gray-400">{{ $movie->release_year }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-400">{{ $movie->created_at->diffForHumans() }}</p>
                            <div class="flex gap-1 mt-1 justify-end">
                                @foreach($movie->genres->take(2) as $genre)
                                    <span class="text-xs bg-gray-700 px-2 py-1 rounded">{{ $genre->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No movies added yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Top Rated Movies -->
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">🏆 Top Rated Movies</h2>
            <div class="space-y-3">
                @forelse($topRatedMovies as $movie)
                    <div class="flex items-center gap-4 p-3 bg-gray-750 rounded-lg hover:bg-gray-700 transition group">
                        <img src="{{ $movie->poster_url }}"
                             alt="{{ $movie->title }}"
                             class="w-12 h-16 object-cover rounded"
                             onerror="this.src='https://via.placeholder.com/48x64/374151/6b7280?text=No+Image'">
                        <div class="flex-1">
                            <h3 class="font-semibold group-hover:text-yellow-400 transition">{{ $movie->title }}</h3>
                            <div class="flex items-center gap-2 text-sm">
                                <span class="text-yellow-400">⭐ {{ number_format($movie->average_rating, 1) }}</span>
                                <span class="text-gray-400">{{ $movie->tomatometer }}%</span>
                            </div>
                        </div>
                        <div class="text-2xl">
                            {{ $movie->tomatometer_icon }}
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No ratings yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-gray-800 rounded-xl p-6 border border-gray-700">
        <h2 class="text-xl font-bold mb-4 flex items-center gap-2">⚡ Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.movies') }}"
               class="flex items-center gap-4 p-4 bg-blue-600 hover:bg-blue-500 rounded-lg transition group">
                <span class="text-2xl group-hover:scale-110 transition">🎬</span>
                <div>
                    <p class="font-semibold">Manage Movies</p>
                    <p class="text-sm text-blue-200">Add, edit, or delete movies</p>
                </div>
            </a>

            <button class="flex items-center gap-4 p-4 bg-green-600 hover:bg-green-500 rounded-lg transition group">
                <span class="text-2xl group-hover:scale-110 transition">🏷️</span>
                <div>
                    <p class="font-semibold">Manage Genres</p>
                    <p class="text-sm text-green-200">Organize movie categories</p>
                </div>
            </button>

            <button class="flex items-center gap-4 p-4 bg-purple-600 hover:bg-purple-500 rounded-lg transition group">
                <span class="text-2xl group-hover:scale-110 transition">📊</span>
                <div>
                    <p class="font-semibold">View Analytics</p>
                    <p class="text-sm text-purple-200">Detailed platform insights</p>
                </div>
            </button>
        </div>
    </div>
</div>
