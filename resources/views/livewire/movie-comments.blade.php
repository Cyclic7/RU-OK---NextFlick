<div class="min-h-screen bg-gray-900 text-white py-12 px-6 relative">
    <!-- Background Blur -->
    <div
        class="absolute inset-0 bg-cover bg-center blur-2xl opacity-30"
        style="background-image: url('{{ $movie->poster_url }}');"
    ></div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900/90 via-gray-900/95 to-black"></div>

    <div class="relative z-10 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-red-400">{{ $movie->title }}</h1>
                <p class="text-gray-400 text-sm mt-1">All user comments & ratings</p>
            </div>
            <a href="{{ route('movie.details', $movie->id) }}"
               class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold">
                ← Back to Movie
            </a>
        </div>

        <!-- Filter Controls -->
        <div class="flex space-x-4 mb-8">
            <button wire:click="$set('filter', 'all')"
                class="px-4 py-2 rounded-lg font-semibold {{ $filter === 'all' ? 'bg-red-500 text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                All
            </button>
            <button wire:click="$set('filter', 'high')"
                class="px-4 py-2 rounded-lg font-semibold {{ $filter === 'high' ? 'bg-red-500 text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                High Rating
            </button>
            <button wire:click="$set('filter', 'low')"
                class="px-4 py-2 rounded-lg font-semibold {{ $filter === 'low' ? 'bg-red-500 text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                Low Rating
            </button>
        </div>

        <!-- Comments Grid -->
        @if($reviews->count() > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($reviews as $review)
                    @php
                        $userRating = $movie->ratings->where('user_id', $review->user_id)->first();
                    @endphp
                    <div class="bg-gray-800/70 backdrop-blur-sm p-6 rounded-xl border border-gray-700 shadow-lg hover:shadow-2xl transition-shadow">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-base mr-3">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <span class="font-semibold text-gray-200 text-lg">{{ $review->user->name }}</span>
                                <p class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</p>
                                <p class="text-yellow-400 text-sm font-semibold">
                                    ⭐ {{ $userRating ? $userRating->score . '/10' : 'No rating' }}
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg">No comments found.</p>
            </div>
        @endif
    </div>
</div>
