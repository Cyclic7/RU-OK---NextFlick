<div class="bg-gray-900 min-h-screen text-white">
    <!-- Navbar -->
    <nav class="bg-gray-800 px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="text-2xl font-bold text-red-500">NextFlick</div>

        <div class="flex items-center space-x-4">
            <input
                wire:model.live="search"
                type="text"
                placeholder="Search movies..."
                class="px-3 py-2 rounded bg-gray-700 text-white focus:outline-none"
            >

            <select
                wire:model.live="selectedGenre"
                class="px-3 py-2 rounded bg-gray-700 text-white"
            >
                <option value="">All Genres</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>

            <a href="#" class="hover:text-red-400">Login</a>
            <a href="#" class="hover:text-red-400">Register</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-12 bg-gray-900">
        <h1 class="text-4xl font-bold mb-4">Top Rated Movies</h1>
        <p class="text-gray-400">Discover and review upcoming films</p>
    </section>

    <!-- Movie Grid -->
    <section class="px-8 py-6">
        @if ($movies->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($movies as $movie)
                    <div
                        class="bg-gray-800 rounded-lg shadow hover:shadow-lg transition transform hover:scale-105 cursor-pointer"
                        wire:click="$dispatch('openMovie', {{ $movie->id }})"
                    >
                        <img
                            src="{{ $movie->poster_url ?? 'https://via.placeholder.com/300x450' }}"
                            alt="{{ $movie->title }}"
                            class="w-full h-72 object-cover rounded-t-lg"
                        >

                        <div class="p-4">
                            <h2 class="text-lg font-semibold">{{ $movie->title }}</h2>
                            <p class="text-gray-400 text-sm mb-2">{{ $movie->release_year }}</p>

                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach ($movie->genres as $genre)
                                    <span class="bg-gray-700 px-2 py-1 text-xs rounded">{{ $genre->name }}</span>
                                @endforeach
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-yellow-400 font-bold text-sm">⭐ {{ $movie->average_rating }}</span>
                                <a href="{{ route('movies.details', $movie->id) }}" class="text-red-400 hover:text-red-500 text-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-400 mt-8">No movies found.</p>
        @endif
    </section>
</div>
