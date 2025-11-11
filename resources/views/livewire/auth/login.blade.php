<div class="relative bg-gray-900 min-h-screen flex items-center justify-center text-white overflow-hidden">
    <!-- Background Blur -->
    <div
        class="absolute inset-0 bg-cover bg-center blur-3xl opacity-30 scale-105 transition-transform duration-1000"
        style="background-image: url('https://images.unsplash.com/photo-1517602302552-471fe67acf66?auto=format&fit=crop&w=1600&q=80');"
    ></div>

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900/90 via-gray-900/95 to-black"></div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md p-8 bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-2xl animate-fade-in">
        <h1 class="text-3xl font-bold text-center text-red-500 mb-6">NextFlick Login</h1>

        @if ($errorMessage)
            <div class="bg-red-500/20 text-red-400 px-4 py-2 rounded mb-4 text-center">
                {{ $errorMessage }}
            </div>
        @endif

        <form wire:submit.prevent="login" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input
                    type="email"
                    wire:model="email"
                    class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Enter your email"
                >
                @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <input
                    type="password"
                    wire:model="password"
                    class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Enter your password"
                >
                @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="remember" class="text-red-500 focus:ring-red-500">
                    Remember me
                </label>
                <a href="#" class="text-red-400 hover:text-red-500">Forgot password?</a>
            </div>

            <button
                type="submit"
                class="w-full py-2 mt-3 bg-red-600 hover:bg-red-700 rounded-lg font-semibold transition"
            >
                Log In
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-6">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-red-400 hover:text-red-500 font-medium">Register</a>
        </p>

        {{-- ✅ Go Back Button --}}
        <div class="text-center mt-4">
            <button
                onclick="window.location.href='{{ session('url.intended', url()->previous()) }}'"
                class="text-gray-400 hover:text-white transition underline text-sm"
            >
                ← Go Back
            </button>
        </div>
    </div>

    <!-- Simple fade-in animation -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }
    </style>
</div>
