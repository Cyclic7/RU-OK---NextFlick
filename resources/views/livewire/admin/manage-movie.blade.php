<div class="flex bg-gray-900 text-white min-h-screen" x-data="{ sidebarOpen: true }">
    <!-- Sidebar -->
    <aside class="bg-gray-800 w-64 min-h-screen p-4">
        <h1 class="text-xl font-bold mb-6">🎬 Movie Admin</h1>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block p-2 rounded
               {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
                🏠 Dashboard
            </a>
            <a href="{{ route('admin.movies') }}"
               class="block p-2 rounded
               {{ request()->routeIs('admin.movies') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
                🎬 Manage Movies
            </a>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-8 bg-gray-900">
        <h1 class="text-3xl font-bold mb-6">🎬 Manage Movies</h1>

        <table class="min-w-full bg-gray-800 rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-700 text-left text-gray-300">
                    <th class="py-3 px-4">Title</th>
                    <th class="py-3 px-4">Genre</th>
                    <th class="py-3 px-4">Year</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movies as $movie)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="py-3 px-4">{{ $movie->title }}</td>
                        <td class="py-3 px-4">{{ $movie->genre }}</td>
                        <td class="py-3 px-4">{{ $movie->year }}</td>
                        <td class="py-3 px-4">
                            <button class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-700">Edit</button>
                            <button class="bg-red-600 px-3 py-1 rounded hover:bg-red-700">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-400">No movies found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</div>
