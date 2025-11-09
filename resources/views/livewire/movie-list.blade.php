<div class="bg-gray-900 min-h-screen text-white">
    <!-- Navbar -->
    <livewire:partials.navbar />

    <!-- Hero Section -->
    <section class="text-center py-12 bg-gray-900 transition-all duration-500">
        @if ($genreName)
            <h1 class="text-4xl font-bold mb-4 text-red-400">
                {{ $genreName }} Movies
            </h1>
            <p class="text-gray-400">Browse the best {{ strtolower($genreName) }} films</p>
        @else
            <h1 class="text-4xl font-bold mb-4 text-red-400">Top Rated Movies</h1>
            <p class="text-gray-400">Discover and review upcoming films</p>
        @endif
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
