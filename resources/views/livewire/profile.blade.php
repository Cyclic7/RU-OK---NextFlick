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

            <!-- Simple Logout Button -->
            <div class="flex justify-center">
                <button wire:click="logout"
                        class="px-6 py-2 bg-red-700 hover:bg-red-600 rounded-lg shadow transition">
                    Log Out
                </button>
            </div>

        </div>
    </div>

</div>
