<div class="mt-10 mx-auto max-w-screen-xl px-4 lg:px-12">
    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Add New User</h2>
        <div wire:dirty>Unsaved changes</div>
        @if (session('status'))
            <h3>{{ session('status') }}</h3>
        @endif
        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" wire:model="name" required
                    class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-primary-500 focus:border-primary-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" wire:model="email" required
                    class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-primary-500 focus:border-primary-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" wire:model="password" required
                    class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-primary-500 focus:border-primary-500">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" wire:model="role" required
                    class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Select a role</option>
                    <option value="{{ \App\Enums\UserRole::ADMIN->value }}">Admin</option>
                    <option value="{{ \App\Enums\UserRole::USER->value }}">User</option>
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="profilePhoto" class="block text-sm font-medium text-gray-700">Profile Photo</label>
                <input type="file" id="profilePhoto" wire:model="profilePhoto"
                    class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                @error('profilePhoto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @if ($profilePhoto)
                    <div class="mt-2">
                        <img src="{{ $profilePhoto->temporaryUrl() }}" alt="Profile Preview" class="h-20 w-20 object-cover rounded-full">
                    </div>
                @endif
            </div>
            <div>
                <button type="submit"
                    class="w-full px-4 py-2 bg-primary-600 text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    Add User
                </button>
            </div>
        </form>
    </div>
</div>
