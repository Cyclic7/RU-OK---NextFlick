<nav class="bg-gray-800 shadow-md p-4 flex justify-between items-center">
    <!-- Left Side: Logo -->
    <div class="flex items-center">
        <a href="{{ route('home') }}" class="text-red-400 text-xl font-bold">NextFlick</a>
    </div>

    <!-- Right Side: Search + Genre + Profile -->
    <div class="flex items-center gap-4">
        <!-- Search Bar -->
        <div class="relative">
            <input
                wire:model.live.debounce.500ms="search"
                type="text"
                placeholder="Search movies..."
                class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm focus:outline-none w-48 sm:w-64"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
            </svg>
        </div>

        <!-- Genre Dropdown (beside search bar) -->
        <select
            wire:model="selectedGenre"
            class="bg-gray-700 text-white px-3 py-2 rounded-lg text-sm focus:outline-none"
        >
            <option value="">All Genres</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>

        <!-- Profile / Auth Section -->
        @auth
            <div class="relative">
                <button wire:click="toggleProfileMenu" class="flex items-center gap-2 focus:outline-none">
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff"
                        alt="Profile"
                        class="w-9 h-9 rounded-full border-2 border-red-400"
                    >
                    <span class="hidden sm:inline text-gray-200 font-medium">
                        {{ Auth::user()->name }}
                    </span>
                </button>

                @if ($showProfileMenu)
                    <div class="absolute right-0 mt-2 w-48 bg-gray-700 rounded-lg shadow-lg py-2 z-50">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm hover:bg-gray-600">Profile</a>
                        <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm hover:bg-gray-600">Settings</a>
                        <button
                            wire:click="logout"
                            class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-600"
                        >
                            Logout
                        </button>
                    </div>
                @endif
            </div>
        @else
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="text-gray-200 hover:text-red-400">Login</a>
                <a href="{{ route('register') }}" class="text-gray-200 hover:text-red-400">Register</a>
            </div>
        @endauth
    </div>
</nav>
