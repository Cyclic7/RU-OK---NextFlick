<nav class="bg-gray-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left: Logo -->
            <div class="flex items-center gap-2">
                <span class="font-bold text-lg text-red-400">NextFlick</span>
            </div>

            <!-- Right: Search + Genre + Profile -->
            <div class="flex items-center gap-4">

                <!-- Search Bar (first) -->
                <div class="relative w-64">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search movies..."
                        class="w-full bg-gray-800 text-white border border-gray-700 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                    <svg
                        class="absolute left-3 top-2.5 w-5 h-5 text-gray-400"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                    </svg>
                </div>

                <!-- Genre Dropdown (second) -->
                <select
                    wire:model.live="selectedGenre"
                    class="bg-gray-800 text-white border border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                >
                    <option value="">All Genres</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>

                <!-- ✅ Admin Panel Button (only for admins) -->
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}"
                           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            🎬 Admin Panel
                        </a>
                    @endif
                @endauth

                <!-- Profile -->
                @auth
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-2">
                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff"
                            alt="Profile"
                            class="w-9 h-9 rounded-full border-2 border-red-400 hover:opacity-80 transition"
                        >
                        <span class="hidden sm:inline text-gray-200 font-medium hover:text-red-400">
                            {{ Auth::user()->name }}
                        </span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm hover:text-red-400">Login</a>
                    <a href="{{ route('register') }}" class="text-sm hover:text-red-400">Register</a>
                @endauth
            </div>

        </div>
    </div>
</nav>
