<div class="min-h-screen bg-gray-900 text-white flex flex-col">
    <!-- Navbar -->
    <livewire:partials.navbar />

    <div class="flex justify-center mt-10 px-6">
        <div class="w-full max-w-2xl bg-gray-800 rounded-xl shadow-xl p-8">
            <h2 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-2">Profile Settings</h2>

            @if (session('success'))
                <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-600 text-white px-4 py-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Profile Info -->
            <div class="mb-8">
                <label class="block mb-1 text-gray-300">Name</label>
                <input type="text" wire:model="name"
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">

                <label class="block mt-4 mb-1 text-gray-300">Email</label>
                <input type="email" wire:model="email"
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">

                <button wire:click="save"
                    class="mt-5 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition">
                    Save Changes
                </button>
            </div>

            <hr class="border-gray-700 my-6">

            <!-- Change Password -->
            <h3 class="text-xl font-semibold mb-4">Change Password</h3>

            <label class="block mb-1 text-gray-300">Current Password</label>
            <input type="password" wire:model="password"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">

            <label class="block mt-4 mb-1 text-gray-300">New Password</label>
            <input type="password" wire:model="newPassword"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">

            <label class="block mt-4 mb-1 text-gray-300">Confirm New Password</label>
            <input type="password" wire:model="confirmPassword"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">

            <button wire:click="updatePassword"
                class="mt-5 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                Update Password
            </button>
        </div>
    </div>
</div>
