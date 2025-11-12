<div class="p-10 bg-gray-900 text-white min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold flex items-center gap-2">🎬 Manage Movies</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 px-4 py-2 rounded-lg hover:bg-gray-500">← Back to Dashboard</a>
            <button wire:click="create" class="bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-500">+ Add Movie</button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-600 text-white p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($showForm)
    <div class="bg-gray-800 p-8 rounded-2xl shadow-lg max-w-5xl mx-auto">
        <div class="grid grid-cols-2 gap-6">
            <div class="col-span-2">
                <label class="block text-sm mb-1">Title</label>
                <input type="text" wire:model="title" class="w-full bg-gray-700 p-3 rounded-lg">
                @error('title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-2">
                <label class="block text-sm mb-1">Description</label>
                <textarea wire:model="description" class="w-full bg-gray-700 p-3 rounded-lg h-24"></textarea>
            </div>

            <div>
                <label class="block text-sm mb-1">Release Year</label>
                <input type="text" wire:model="release_year" class="w-full bg-gray-700 p-3 rounded-lg">
            </div>

            <div>
                <label class="block text-sm mb-1">Genres (Select Multiple)</label>
                <select wire:model="selectedGenres" multiple class="w-full bg-gray-700 p-3 rounded-lg h-32">
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
                @error('selectedGenres') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-2">
                <label class="block text-sm mb-1">Poster URL</label>
                <input type="text" wire:model="poster_url" class="w-full bg-gray-700 p-3 rounded-lg">
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            @if($isEditing)
                <button wire:click="update" class="bg-yellow-600 px-6 py-2 rounded-lg hover:bg-yellow-500">💾 Update</button>
            @else
                <button wire:click="store" class="bg-red-600 px-6 py-2 rounded-lg hover:bg-red-500">💾 Save</button>
            @endif
            <button wire:click="$set('showForm', false)" class="bg-gray-600 px-6 py-2 rounded-lg hover:bg-gray-500">Cancel</button>
        </div>
    </div>
    @endif

    <div class="mt-10">
        <h2 class="text-2xl font-semibold mb-4">🎥 Movies List</h2>
        <div class="grid grid-cols-3 gap-8">
            @foreach($movies as $movie)
                <div class="bg-gray-800 p-5 rounded-xl shadow-lg">
                    <img src="{{ $movie->poster_url }}" alt="Poster" class="rounded-lg w-full h-72 object-cover mb-3">
                    <h3 class="text-xl font-semibold">{{ $movie->title }}</h3>
                    <p class="text-sm text-gray-400">{{ $movie->release_year }}</p>
                    <p class="mt-2 text-gray-300 text-sm">{{ Str::limit($movie->description, 100) }}</p>
                    <p class="mt-2 text-sm text-blue-400">Genres:
                        {{ $movie->genres->pluck('name')->join(', ') }}
                    </p>

                    <div class="flex justify-end gap-2 mt-3">
                        <button wire:click="edit({{ $movie->id }})" class="bg-yellow-600 px-3 py-1 rounded-lg hover:bg-yellow-500">Edit</button>
                        <button wire:click="delete({{ $movie->id }})" class="bg-red-700 px-3 py-1 rounded-lg hover:bg-red-600">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $movies->links() }}
        </div>
    </div>
</div>
