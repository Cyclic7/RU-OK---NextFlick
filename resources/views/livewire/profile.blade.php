<div class="min-h-screen bg-gradient-to-b from-black via-gray-900 to-black text-white">

    <!-- Header -->
    <header class="flex items-center px-6 py-4 border-b border-gray-800 bg-black/60 backdrop-blur">
        <h1 class="text-2xl font-bold text-red-500 tracking-wide">NextFlick</h1>
        <span class="ml-4 text-gray-300 text-lg">| Profile Settings</span>

        <button onclick="window.location.href='/'"
            class="ml-auto px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition flex items-center gap-2">
            <span class="text-xl">←</span> Back
        </button>
    </header>


    <div class="flex justify-center py-12 px-4">
        <div class="w-full max-w-3xl space-y-10">

            <!-- Update Name -->
            <div class="bg-gray-900/70 border border-gray-700 rounded-2xl p-8 shadow-xl">
                <h2 class="text-2xl font-bold mb-6">Update Name</h2>

                <label class="block mb-2 text-gray-300">Your Name</label>
                <input type="text" wire:model="name"
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 focus:ring focus:ring-red-600">

                <button wire:click="updateProfile"
                        class="mt-5 px-6 py-2 bg-red-600 hover:bg-red-500 rounded-lg transition">
                    Save Name
                </button>
            </div>

            <!-- Change Password -->
            <div class="bg-gray-900/70 border border-gray-700 rounded-2xl p-8 shadow-xl">
                <h2 class="text-2xl font-bold mb-6">Change Password</h2>

                <label class="block mb-2 text-gray-300">Current Password</label>
                <input type="password" wire:model="currentPassword"
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 mb-4">

                <label class="block mb-2 text-gray-300">New Password</label>
                <input type="password" wire:model="newPassword"
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 mb-4">

                <label class="block mb-2 text-gray-300">Confirm New Password</label>
                <input type="password" wire:model="confirmPassword"
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 mb-4">

                <button wire:click="updatePassword"
                        class="mt-2 px-6 py-2 bg-red-600 hover:bg-red-500 rounded-lg transition">
                    Update Password
                </button>
            </div>

            <!-- Logout Button -->
            <div class="flex justify-center">
                <button wire:click="logout"
                        class="px-6 py-2 bg-red-700 hover:bg-red-600 rounded-lg shadow transition">
                    Log Out
                </button>
            </div>

        </div>
    </div>


    <!-- Logout Modal -->
    <div x-data="{ open: false }" x-on:show-logout-options.window="open = true">

        <div x-show="open"
             class="fixed inset-0 flex items-center justify-center bg-black/70 backdrop-blur">

            <div class="bg-gray-900 border border-gray-700 p-8 rounded-2xl shadow-xl w-80">

                <h2 class="text-xl font-bold mb-4 text-white">Log Out Options</h2>
                <p class="text-gray-300 mb-6">
                    Do you want to fully log out or switch to guest mode?
                </p>

                <div class="space-y-4">

                    <!-- Full Logout -->
                    <button wire:click="logoutCompletely"
                            class="w-full py-2 bg-red-700 hover:bg-red-600 rounded-lg transition">
                        Stay Logged Out
                    </button>

                    <!-- Guest Mode -->
                    <button wire:click="switchToGuest"
                            class="w-full py-2 bg-blue-600 hover:bg-blue-500 rounded-lg transition">
                        Switch to Guest
                    </button>

                    <!-- Cancel -->
                    <button x-on:click="open = false"
                            class="w-full py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition">
                        Cancel
                    </button>

                </div>

            </div>
        </div>

    </div>

</div>
