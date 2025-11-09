<div class="relative bg-gray-900 min-h-screen text-white overflow-hidden">
    <!-- Background Blur -->
    <div
        class="absolute inset-0 bg-cover bg-center blur-2xl opacity-30"
        style="background-image: url('{{ $movie->poster_url }}');"
    ></div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900/90 via-gray-900/95 to-black"></div>

    <!-- Content -->
    <div class="relative z-10">
        <!-- Navbar -->
        <livewire:partials.navbar />

        <!-- Movie Details -->
        <div class="max-w-6xl mx-auto px-6 py-12">
            <a href="{{ route('home') }}" class="text-red-400 hover:text-red-500">&larr; Back to Movies</a>

            <div class="mt-8 bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8 flex flex-col md:flex-row gap-8">
                <!-- Poster -->
                <div class="w-full md:w-1/3">
                    <img
                        src="{{ $movie->poster_url }}"
                        alt="{{ $movie->title }}"
                        class="w-full h-auto rounded-xl shadow-lg object-cover"
                    >
                </div>

                <!-- Movie Info -->
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-red-400 mb-4">{{ $movie->title }}</h1>
                        <p class="text-gray-300 leading-relaxed mb-6">{{ $movie->description }}</p>

                        <div class="space-y-3 text-sm">
                            <div>
                                <span class="font-semibold text-gray-400">Release Year:</span>
                                <span>{{ $movie->release_year }}</span>
                            </div>

                            <div>
                                <span class="font-semibold text-gray-400">Rating:</span>
                                <span class="text-yellow-400 font-semibold">⭐ {{ $movie->average_rating }}</span>
                            </div>

                            <div>
                                <span class="font-semibold text-gray-400">Genres:</span>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach ($movie->genres as $genre)
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs">
                                            {{ $genre->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
