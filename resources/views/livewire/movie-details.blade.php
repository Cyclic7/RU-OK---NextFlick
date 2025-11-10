<div class="relative bg-gray-900 min-h-screen text-white overflow-hidden">
    <div
        class="absolute inset-0 bg-cover bg-center blur-2xl opacity-30"
        style="background-image: url('{{ $movie->poster_url }}');"
    ></div>

    <div class="absolute inset-0 bg-gradient-to-b from-gray-900/90 via-gray-900/95 to-black"></div>

    <div class="relative z-10">
        <livewire:partials.navbar />

        <div class="max-w-6xl mx-auto px-6 py-12">
            <a href="{{ route('home') }}" class="text-red-400 hover:text-red-500">&larr; Back to Movies</a>

            <div class="mt-8 bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="w-full md:w-1/3">
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                            class="w-full h-auto rounded-xl shadow-lg object-cover">

                        <div class="mt-6 space-y-3 text-base">
                            <div class="flex items-center">
                                <span class="font-semibold text-gray-400 mr-4">Release Year:</span>
                                <span class="text-lg">{{ $movie->release_year }}</span>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold text-gray-400 mr-4">Genres:</span>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($movie->genres as $genre)
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $genre->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold text-gray-400 mr-4">Tomatometer:</span>
                                <span
                                    class="font-bold text-lg {{ $movie->tomatometer_status === 'Fresh' ? 'text-green-400' : ($movie->tomatometer_status === 'Certified Fresh' ? 'text-yellow-400' : 'text-red-400') }}">
                                    {{ $movie->tomatometer_icon }} {{ $movie->tomatometer }}% - {{ $movie->tomatometer_status }}
                                </span>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold text-gray-400 mr-4">Likes/Dislikes:</span>
                                <span class="text-lg">👍 {{ $movie->likes->where('type','like')->count() }}
                                    &nbsp;👎 {{ $movie->likes->where('type','dislike')->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1">
                        <h1 class="text-5xl font-bold text-red-400 mb-6">{{ $movie->title }}</h1>
                        <p class="text-gray-300 leading-relaxed mb-8 text-lg">{{ $movie->description }}</p>

                        <!-- Like / Dislike -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-200 mb-2">React to this movie</h3>
                            <div class="flex items-center space-x-10">
                                <button
                                    wire:click="likeMovie('like')"
                                    class="text-6xl {{ $userLikeType === 'like' ? 'text-blue-400' : 'text-gray-500' }} hover:scale-110 transition-transform duration-200">
                                    👍
                                </button>
                                <button
                                    wire:click="likeMovie('dislike')"
                                    class="text-6xl {{ $userLikeType === 'dislike' ? 'text-red-400' : 'text-gray-500' }} hover:scale-110 transition-transform duration-200">
                                    👎
                                </button>
                            </div>
                        </div>

                        <!-- Rating + Comment -->
                        <div class="mt-10 space-y-6">
                            <h3 class="text-lg font-semibold text-gray-200 mb-3">Rate & Comment</h3>

                            <div class="flex items-center space-x-2 mb-4">
                                @for ($i = 1; $i <= 10; $i++)
                                    <button
                                        wire:click="$set('userRating', {{ $i }})"
                                        class="text-3xl {{ $userRating >= $i ? 'text-yellow-400' : 'text-gray-600' }}">
                                        ★
                                    </button>
                                @endfor
                                <span class="ml-3 text-gray-400 text-sm">
                                    ({{ $userRating ? $userRating . '/10' : 'No rating yet' }})
                                </span>
                            </div>

                            <textarea
                                wire:model="comment"
                                class="w-full h-28 bg-gray-800 border border-gray-700 rounded-lg p-3 text-gray-200 focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="Share your thoughts about this movie..."></textarea>

                            <button
                                wire:click="submitRatingAndComment"
                                class="mt-4 px-5 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-white font-semibold">
                                Submit
                            </button>

                            @if (session()->has('success'))
                                <p class="text-green-400 mt-2">{{ session('success') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mt-10 bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8">
                <h2 class="text-3xl font-bold text-red-400 mb-6">Comments ({{ $movie->reviews->count() }})</h2>

                @if($movie->reviews->count() > 0)
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-gray-300">User Feedback</h3>
                            @if($movie->reviews->count() > 3)
                                <a href="{{ route('movie.comments', $movie->id) }}"
                                    class="text-red-400 hover:text-white transition cursor-pointer font-semibold text-base">
                                    View all comments >>
                                </a>
                            @endif
                        </div>

                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($movie->reviews->take($showAllComments ? $movie->reviews->count() : 3) as $review)
                                @php
                                    $userRating = $movie->ratings->where('user_id', $review->user_id)->first();
                                @endphp
                                <div
                                    class="bg-gray-700/50 backdrop-blur-sm p-6 rounded-xl border border-gray-600 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-base mr-3">
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
                    </div>
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

<!-- Guest warning redirect -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('guest-warning', function () {
        const confirmRedirect = confirm("⚠️ You need to register or log in to rate or comment on this movie.\n\nDo you want to register now?");
        if (confirmRedirect) {
            window.location.href = "{{ route('register') }}";
        }
    });
});
</script>
