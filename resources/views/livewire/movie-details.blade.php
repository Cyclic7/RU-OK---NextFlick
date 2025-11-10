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

            <!-- Movie Info Card -->
            <div class="mt-8 bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Poster -->
                    <div class="w-full md:w-1/3">
                        <img
                            src="{{ $movie->poster_url }}"
                            alt="{{ $movie->title }}"
                            class="w-full h-auto rounded-xl shadow-lg object-cover"
                        >
                    </div>

                    <!-- Movie Info -->
                    <div class="flex-1">
                        <h1 class="text-5xl font-bold text-red-400 mb-6">{{ $movie->title }}</h1>
                        <p class="text-gray-300 leading-relaxed mb-8 text-lg">{{ $movie->description }}</p>

                        <div class="space-y-4 text-base">
                            <div class="flex items-center">
                                <span class="font-semibold text-gray-400 mr-4">Release Year:</span>
                                <span class="text-xl">{{ $movie->release_year }}</span>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold text-gray-400 mr-4">Rating:</span>
                                <span class="text-yellow-400 font-bold text-2xl">⭐ {{ $movie->average_rating }}/5</span>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold text-gray-400 mr-4">Tomatometer:</span>
                                <span class="font-bold text-xl {{ $movie->tomatometer_status === 'Fresh' ? 'text-green-400' : ($movie->tomatometer_status === 'Certified Fresh' ? 'text-yellow-400' : 'text-red-400') }}">
                                    {{ $movie->tomatometer_icon }} {{ $movie->tomatometer }}% - {{ $movie->tomatometer_status }}
                                </span>
                                @if($movie->tomatometer_status === 'Certified Fresh')
                                    <span class="bg-yellow-500 text-black text-sm px-3 py-2 rounded-full font-bold ml-4">CERTIFIED FRESH</span>
                                @endif
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold text-gray-400 mr-4">Likes/Dislikes:</span>
                                <span class="text-xl">👍 {{ $movie->likes_count }} 👎 {{ $movie->dislikes_count }}</span>
                            </div>

                            <div>
                                <span class="font-semibold text-gray-400">Genres:</span>
                                <div class="mt-3 flex flex-wrap gap-3">
                                    @foreach ($movie->genres as $genre)
                                        <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                                            {{ $genre->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section (Full Width Below) -->
            <div class="mt-8 bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8">
                <h2 class="text-3xl font-bold text-red-400 mb-6">Comments ({{ $movie->comments_count }})</h2>

                @if($movie->reviews->count() > 0)
                    <!-- Featured Comments -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-gray-300">Featured Comments</h3>
                            @if($movie->reviews->count() > 3)
                                <a
                                    wire:click="toggleComments"
                                    class="text-red-400 hover:text-white transition cursor-pointer font-semibold text-base"
                                >
                                    {{ $showAllComments ? 'hide comments <<' : 'view all comments >>' }}
                                </a>
                            @endif
                        </div>
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($movie->reviews->take(3) as $review)
                                <div class="bg-gray-700/50 backdrop-blur-sm p-6 rounded-xl border border-gray-600 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center mb-3">
                                        <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-base mr-3">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-200 text-lg">{{ $review->user->name }}</span>
                                            <p class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 leading-relaxed">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- All Comments (Scrollable) -->
                    @if($showAllComments)
                        <div class="max-h-96 overflow-y-auto space-y-6 border-t border-gray-600 pt-6">
                            @foreach($movie->reviews as $review)
                                <div class="bg-gray-700/50 backdrop-blur-sm p-6 rounded-xl border border-gray-600 shadow-lg">
                                    <div class="flex items-center mb-3">
                                        <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-base mr-3">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-200 text-lg">{{ $review->user->name }}</span>
                                            <p class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 leading-relaxed">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-400 text-lg">No comments yet.</p>
                        <p class="text-gray-500 text-sm mt-2">Be the first to share your thoughts!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
