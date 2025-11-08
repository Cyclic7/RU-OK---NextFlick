<div class="max-w-4xl mx-auto mt-10 text-gray-200">
    <a href="{{ route('home') }}" class="text-red-400 hover:text-red-500">&larr; Back to Movies</a>

    <div class="mt-6 bg-gray-800 rounded-2xl shadow-lg p-6 flex flex-col md:flex-row gap-6">
        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full md:w-1/3 rounded-xl shadow-md">

        <div class="flex-1">
            <h1 class="text-3xl font-bold text-red-400 mb-2">{{ $movie->title }}</h1>
            <p class="text-gray-400 mb-4">{{ $movie->description }}</p>

            <div class="mb-3">
                <strong>Release Year:</strong> {{ $movie->release_year }}
            </div>
            <div class="mb-3">
                <strong>Rating:</strong> {{ $movie->average_rating }}
            </div>
            <div>
                <strong>Genres:</strong>
                @foreach ($movie->genres as $genre)
                    <span class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm mr-1 mb-1">
                        {{ $genre->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
