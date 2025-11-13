<div class="p-6 bg-gray-900 text-white min-h-screen">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold flex items-center gap-2">🎬 Manage Movies</h1>
        <p class="text-gray-400 mt-1">Add, edit, and manage your movie collection</p>
    </div>

    <!-- Success/Error Messages -->
    @if (session()->has('success'))
        <div class="bg-green-600 text-white p-4 rounded-lg mb-6 flex items-center gap-2">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-600 text-white p-4 rounded-lg mb-6">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <!-- Search Bar -->
        <div class="flex-1 w-full sm:max-w-md">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search"
                placeholder="Search movies..."
                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
            >
        </div>
        
        <!-- Action Buttons -->
        <div class="flex gap-3 w-full sm:w-auto">
            <!-- Return to Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-gray-600 hover:bg-gray-500 px-4 py-2 rounded-lg font-semibold transition whitespace-nowrap flex items-center gap-2">
                ← Dashboard
            </a>
            
            <!-- Add New Movie -->
            <button wire:click="create"
                    class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded-lg font-semibold transition whitespace-nowrap flex items-center gap-2">
                🎬 Add Movie
            </button>
        </div>
    </div>

    <!-- Add/Edit Form -->
    @if ($showForm)
    <div class="bg-gray-800 rounded-xl p-6 mb-8 border border-gray-700">
        <h2 class="text-xl font-bold mb-6">
            {{ $isEditing ? '✏️ Edit Movie' : '🎬 Add New Movie' }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div class="md:col-span-2">
                <label class="block text-gray-300 mb-2">Movie Title *</label>
                <input type="text" wire:model="title" placeholder="Enter movie title"
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                @error('title') <div class="text-red-400 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block text-gray-300 mb-2">Description *</label>
                <textarea wire:model="description" placeholder="Enter movie description" rows="4"
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                @error('description') <div class="text-red-400 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <!-- Release Year -->
            <div>
                <label class="block text-gray-300 mb-2">Release Year *</label>
                <input type="number" wire:model="release_year" placeholder="2024" min="1880" max="{{ date('Y') + 5 }}"
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                @error('release_year') <div class="text-red-400 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <!-- Poster URL -->
            <div>
                <label class="block text-gray-300 mb-2">Poster URL *</label>
                <input type="url" wire:model="poster_url" placeholder="https://example.com/poster.jpg"
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                @error('poster_url') <div class="text-red-400 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <!-- Genres - Checkboxes -->
            <div class="md:col-span-2">
                <label class="block text-gray-300 mb-3">Genres * (Select at least one)</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 max-h-60 overflow-y-auto p-4 bg-gray-700 rounded-lg border border-gray-600">
                    @foreach($genres as $genre)
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-600 rounded transition cursor-pointer">
                            <input type="checkbox" wire:model="selectedGenres" value="{{ $genre->id }}"
                                class="rounded bg-gray-600 border-gray-500 text-red-500 focus:ring-red-500 focus:ring-2">
                            <span class="text-gray-200">{{ $genre->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('selectedGenres') <div class="text-red-400 text-sm mt-2">{{ $message }}</div> @enderror
                <p class="text-gray-400 text-sm mt-2">Selected: {{ count($selectedGenres) }} genre(s)</p>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-700">
            @if($isEditing)
                <button wire:click="update"
                    class="bg-green-600 hover:bg-green-500 px-6 py-3 rounded-lg font-semibold transition flex-1">
                    💾 Update Movie
                </button>
            @else
                <button wire:click="store"
                    class="bg-green-600 hover:bg-green-500 px-6 py-3 rounded-lg font-semibold transition flex-1">
                    💾 Save Movie
                </button>
            @endif
            <button wire:click="cancel"
                class="bg-gray-600 hover:bg-gray-500 px-6 py-3 rounded-lg transition flex-1">
                Cancel
            </button>
        </div>
    </div>
    @endif

    <!-- Movies Grid -->
    <div class="bg-gray-800 rounded-xl p-6">
        <h2 class="text-xl font-bold mb-6">🎥 Movies List ({{ $movies->total() }})</h2>

        @if($movies->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($movies as $movie)
                    <div class="bg-gray-750 rounded-lg p-4 border border-gray-700 hover:border-gray-600 transition group">
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                            class="w-full h-64 object-cover rounded-lg mb-4 group-hover:scale-105 transition duration-300"
                            onerror="this.src='https://via.placeholder.com/300x400/374151/6b7280?text=No+Poster'">
                        
                        <h3 class="font-bold text-lg text-white group-hover:text-red-400 transition mb-2">
                            {{ $movie->title }}
                        </h3>
                        <p class="text-gray-400 text-sm mb-3">{{ $movie->release_year }}</p>
                        <p class="text-gray-300 text-sm mb-4 leading-relaxed">
                            {{ Str::limit($movie->description, 100) }}
                        </p>

                        <div class="mb-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach($movie->genres as $genre)
                                    <span class="bg-gray-600 px-2 py-1 text-xs rounded text-gray-300">
                                        {{ $genre->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-2 pt-4 border-t border-gray-600">
                            <button wire:click="loadMovie({{ $movie->id }})"
                                class="flex-1 bg-yellow-600 hover:bg-yellow-500 px-3 py-2 rounded text-sm transition font-medium">
                                ✏️ Edit
                            </button>
                            <button onclick="confirmDelete({{ $movie->id }}, '{{ addslashes($movie->title) }}')"
                                class="flex-1 bg-red-600 hover:bg-red-500 px-3 py-2 rounded text-sm transition font-medium">
                                🗑️ Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $movies->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg mb-4">No movies found.</p>
                <button wire:click="create"
                    class="bg-red-600 hover:bg-red-500 px-6 py-3 rounded-lg font-semibold transition">
                    🎬 Add Your First Movie
                </button>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(movieId, movieTitle) {
        Swal.fire({
            title: 'Delete Movie?',
            html: `You are about to delete <strong>"${movieTitle}"</strong>. <br>This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            background: '#1f2937',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('deleteMovie', movieId);
            }
        });
    }
</script>