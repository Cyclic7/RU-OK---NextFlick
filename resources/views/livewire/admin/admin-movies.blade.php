<!-- resources/views/livewire/admin/admin-movies.blade.php -->
<div class="p-8 bg-gray-900 text-white">
    <h1 class="text-2xl font-bold mb-4">Manage Movies</h1>

    @if (session()->has('success'))
        <div class="bg-green-600 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <button wire:click="create" class="bg-blue-600 px-4 py-2 rounded mb-4">Add Movie</button>

    @if ($showForm)
    <div class="bg-gray-800 p-4 rounded mb-4">
        <h2 class="text-lg font-bold mb-3">{{ $isEditing ? 'Edit Movie' : 'Add Movie' }}</h2>

        <div class="space-y-3">
            <input type="text" wire:model="title" placeholder="Title" class="w-full bg-gray-700 p-2 rounded">
            @error('title') <div class="text-red-400 text-sm">{{ $message }}</div> @enderror

            <textarea wire:model="description" placeholder="Description" class="w-full bg-gray-700 p-2 rounded" rows="3"></textarea>
            @error('description') <div class="text-red-400 text-sm">{{ $message }}</div> @enderror

            <input type="number" wire:model="release_year" placeholder="Year" class="w-full bg-gray-700 p-2 rounded">
            @error('release_year') <div class="text-red-400 text-sm">{{ $message }}</div> @enderror

            <input type="url" wire:model="poster_url" placeholder="Poster URL" class="w-full bg-gray-700 p-2 rounded">
            @error('poster_url') <div class="text-red-400 text-sm">{{ $message }}</div> @enderror

            <select wire:model="selectedGenres" multiple class="w-full bg-gray-700 p-2 rounded h-24">
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
            @error('selectedGenres') <div class="text-red-400 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="flex gap-2 mt-4">
            @if($isEditing)
                <button wire:click="update" class="bg-green-600 px-4 py-2 rounded">Update</button>
            @else
                <button wire:click="store" class="bg-green-600 px-4 py-2 rounded">Save</button>
            @endif
            <button wire:click="$set('showForm', false)" class="bg-gray-600 px-4 py-2 rounded">Cancel</button>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($movies as $movie)
            <div class="bg-gray-800 p-4 rounded">
                <h3 class="font-bold">{{ $movie->title }}</h3>
                <p class="text-gray-400 text-sm">{{ $movie->release_year }}</p>
                <p class="text-sm mt-2">{{ Str::limit($movie->description, 80) }}</p>

                <div class="flex gap-2 mt-3">
                    <button wire:click="loadMovie({{ $movie->id }})" class="bg-yellow-600 px-3 py-1 rounded text-sm">Edit</button>
                    <button wire:click="deleteMovie({{ $movie->id }})" class="bg-red-600 px-3 py-1 rounded text-sm">Delete</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $movies->links() }}
    </div>
</div>
