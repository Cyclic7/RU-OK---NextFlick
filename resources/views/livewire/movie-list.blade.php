<div class="bg-gray-900 text-white overflow-x-hidden min-h-screen">

    <!-- Navbar -->
    <livewire:partials.navbar />

    <!-- 🎥 Movie Carousel -->
    <section class="relative w-full h-[28rem] sm:h-[32rem] overflow-hidden">
        @php
            $featuredMovies = $movies->take(5);
        @endphp

        <div id="carousel" class="relative w-full h-full">
            @foreach ($featuredMovies as $index => $movie)
                <div class="absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                    <img
                        src="{{ $movie->poster_url ?? 'https://via.placeholder.com/1280x720?text=No+Poster' }}"
                        alt="{{ $movie->title }}"
                        class="w-full h-full object-cover opacity-70"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                    <div class="absolute bottom-10 left-8 sm:left-16">
                        <h2 class="text-3xl sm:text-5xl font-bold text-red-400">{{ $movie->title }}</h2>
                        <p class="text-gray-300 text-sm sm:text-base mt-3 max-w-lg">
                            {{ $movie->description ?? 'No description available.' }}
                        </p>
                        <a
                            href="{{ route('movie.details', $movie->id) }}"
                            class="inline-block mt-5 bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg text-sm sm:text-base transition"
                        >
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Prev / Next Buttons -->
        <button
            id="prevBtn"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/70 text-white p-3 sm:p-4 rounded-full z-20"
        >
            ‹
        </button>
        <button
            id="nextBtn"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/70 text-white p-3 sm:p-4 rounded-full z-20"
        >
            ›
        </button>

        <!-- Dots -->
        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
            @foreach ($featuredMovies as $index => $movie)
                <button class="dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-red-500' : 'bg-gray-400' }}"></button>
            @endforeach
        </div>
    </section>

    <!-- Hero Section -->
    <section class="text-center py-12 bg-gray-900 transition-all duration-500">
        @if ($genreName)
            <h1 class="text-4xl font-bold mb-4 text-red-400">{{ $genreName }} Movies</h1>
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
                    <div class="bg-gray-800 rounded-lg shadow hover:shadow-lg transition transform hover:scale-105 cursor-pointer">
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
                                <div class="flex items-center space-x-4">
                                    <span class="text-yellow-400 font-bold text-sm">
                                        ⭐ {{ $movie->average_rating }}
                                    </span>
                                    <div class="flex items-center space-x-2">
                                        <span class="font-bold text-sm {{ $movie->tomatometer_status === 'Fresh' ? 'text-green-400' : ($movie->tomatometer_status === 'Certified Fresh' ? 'text-yellow-400' : 'text-red-400') }}">
                                            {{ $movie->tomatometer_icon }} {{ $movie->tomatometer }}%
                                        </span>
                                        <span class="text-gray-400 text-xs">({{ $movie->ratings()->count() }} ratings)</span>
                                        @if($movie->tomatometer_status === 'Certified Fresh')
                                            <span class="bg-yellow-500 text-black text-xs px-1 py-0.5 rounded font-bold">CERTIFIED FRESH</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-gray-400">
                                    <span>👍 {{ $movie->likes_count }}</span>
                                    <span>👎 {{ $movie->dislikes_count }}</span>
                                </div>
                                <a href="{{ route('movie.details', $movie->id) }}" class="text-red-400 hover:text-red-500 text-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-400 mt-8">No movies found.</p>
        @endif
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const slides = document.querySelectorAll("#carousel > div");
            const dots = document.querySelectorAll(".dot");
            let current = 0;
            const total = slides.length;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle("opacity-100", i === index);
                    slide.classList.toggle("opacity-0", i !== index);
                    slide.classList.toggle("z-10", i === index);
                    slide.classList.toggle("z-0", i !== index);
                    dots[i].classList.toggle("bg-red-500", i === index);
                    dots[i].classList.toggle("bg-gray-400", i !== index);
                });
            }

            function nextSlide() {
                current = (current + 1) % total;
                showSlide(current);
            }

            function prevSlide() {
                current = (current - 1 + total) % total;
                showSlide(current);
            }

            document.getElementById("nextBtn").addEventListener("click", nextSlide);
            document.getElementById("prevBtn").addEventListener("click", prevSlide);

            setInterval(nextSlide, 4000);
        });
    </script>

</div>
