<div class="p-6 bg-gray-900 text-white min-h-screen">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold flex items-center gap-2">🚀 Upcoming Movies Dashboard</h1>
        <p class="text-gray-400 mt-1">Focus on future releases - this is what users see!</p>
        
        <!-- Quick Links -->
        <div class="flex gap-3 mt-4">
            <a href="{{ route('home') }}" 
               class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-sm transition">
                👀 View Website
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" 
                        class="bg-gray-600 hover:bg-gray-500 px-4 py-2 rounded-lg text-sm transition">
                    👤 Switch to Regular User
                </button>
            </form>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-green-600 p-4 rounded-lg text-center">
            <div class="text-2xl font-bold">{{ $stats['upcoming_count'] }}</div>
            <div class="text-green-200 text-sm">Upcoming</div>
        </div>
        
        <div class="bg-blue-600 p-4 rounded-lg text-center">
            <div class="text-2xl font-bold">{{ $stats['total_movies'] }}</div>
            <div class="text-blue-200 text-sm">In Database</div>
        </div>
        
        <div class="bg-purple-600 p-4 rounded-lg text-center">
            <div class="text-2xl font-bold">{{ $stats['total_users'] }}</div>
            <div class="text-purple-200 text-sm">Users</div>
        </div>
        
        <div class="bg-orange-600 p-4 rounded-lg text-center">
            <div class="text-2xl font-bold">{{ $stats['missing_posters'] }}</div>
            <div class="text-orange-200 text-sm">Need Posters</div>
        </div>
    </div>

    <!-- Quick Action -->
    <div class="mb-8">
        <a href="{{ route('admin.movies') }}" 
           class="bg-red-600 hover:bg-red-500 px-6 py-3 rounded-lg font-semibold inline-flex items-center gap-2 transition">
            🎬 Add New Movie
        </a>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Upcoming Movies -->
        <div class="bg-gray-800 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                📅 Upcoming Releases
                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-sm">
                    {{ $stats['upcoming_count'] }}
                </span>
            </h2>
            
            <div class="space-y-4">
                @foreach($upcomingMovies as $movie)
                <div class="flex items-center gap-4 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition">
                    <img src="{{ $movie->poster_url }}" 
                         alt="{{ $movie->title }}"
                         class="w-12 h-16 object-cover rounded"
                         onerror="this.src='https://via.placeholder.com/48x64/374151/6b7280?text=No+Poster'">
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $movie->title }}</h3>
                        <p class="text-gray-400 text-sm">Releases: {{ $movie->release_year }}</p>
                        <div class="flex gap-1 mt-1">
                            @foreach($movie->genres->take(2) as $genre)
                                <span class="bg-gray-600 px-2 py-0.5 rounded text-xs">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('admin.movies') }}" 
                       class="bg-blue-600 hover:bg-blue-500 px-3 py-1 rounded text-sm transition">
                        Edit
                    </a>
                </div>
                @endforeach
                
                @if($upcomingMovies->isEmpty())
                <p class="text-gray-400 text-center py-4">No upcoming movies. Add your first release!</p>
                @endif
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Recently Added -->
            <div class="bg-gray-800 rounded-xl p-6">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    🆕 Recently Added
                </h2>
                
                <div class="space-y-3">
                    @foreach($recentMovies as $movie)
                    <div class="flex justify-between items-center p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition">
                        <div>
                            <h3 class="font-medium">{{ $movie->title }}</h3>
                            <p class="text-gray-400 text-sm">{{ $movie->release_year }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-400 text-sm">{{ $movie->created_at->diffForHumans() }}</p>
                            <p class="text-yellow-400 text-sm">⭐ {{ $movie->average_rating ?? 'No ratings' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-gray-800 rounded-xl p-6">
                <h2 class="text-xl font-bold mb-4">📊 Platform Stats</h2>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="bg-gray-700 p-3 rounded">
                        <div class="text-lg font-bold">{{ $stats['total_reviews'] }}</div>
                        <div class="text-gray-400 text-sm">Reviews</div>
                    </div>
                    <div class="bg-gray-700 p-3 rounded">
                        <div class="text-lg font-bold">{{ $stats['total_genres'] }}</div>
                        <div class="text-gray-400 text-sm">Genres</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>