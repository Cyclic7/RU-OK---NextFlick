<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true }">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex bg-gray-900 text-white min-h-screen">

    <!-- Sidebar -->
    <aside class="bg-gray-800 w-64 min-h-screen p-4">
        <h1 class="text-xl font-bold mb-6">🎬 Movie Admin</h1>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block p-2 rounded bg-gray-700 hover:bg-gray-600">
                Dashboard
            </a>
            <a href="#" class="block p-2 rounded hover:bg-gray-700">Manage Movies</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-700">Manage Users</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-700">Reviews</a>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-8 bg-gray-900">
        <h1 class="text-3xl font-bold mb-6">Dashboard Overview</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Movies -->
            <div class="bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-300 mb-2">🎥 Total Movies</h2>
                <p class="text-4xl font-bold text-white">{{ $totalMovies }}</p>
            </div>

            <!-- Users -->
            <div class="bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-300 mb-2">👤 Total Users</h2>
                <p class="text-4xl font-bold text-white">{{ $totalUsers }}</p>
            </div>

            <!-- Reviews -->
            <div class="bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-300 mb-2">⭐ Total Reviews</h2>
                <p class="text-4xl font-bold text-white">{{ $totalReviews }}</p>
            </div>
        </div>

        <!-- Add graph section or future widgets here -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold mb-4">Recent Activity</h2>
            <div class="bg-gray-800 p-6 rounded-lg shadow text-gray-300">
                <p>Coming soon...</p>
            </div>
        </div>
    </main>

    @livewireScripts
</body>
</html>
