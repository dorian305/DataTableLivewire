<div class="max-w-xl mx-auto p-6 bg-white shadow rounded-md">
    <!-- Flash Message Section -->
    @if (session('created'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('created') }}
        </div>
    @endif

    <form wire:submit.prevent="createUser">

        @if ($currentFormPage === 1)
            <!-- Section 1: Personal Information -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Personal Information</h2>
                <div class="mb-4">
                    <label for="firstName" class="block text-gray-700">First name</label>
                    <input id="firstName" type="text" wire:model.live="firstName" placeholder="Enter your first name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    @error('firstName')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="lastName" class="block text-gray-700">Last name</label>
                    <input id="lastName" type="text" wire:model.live="lastName" placeholder="Enter your last name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    @error('lastName')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input id="email" type="email" wire:model.live="email" placeholder="Enter your email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endif

        @if ($currentFormPage === 2)
            <!-- Section 2: Profile Picture -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Profile Picture</h2>
                <div>
                    <input id="photo" type="file" wire:model.live="profilePhoto"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none" />
                    @error('profilePhoto')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                @if ($profilePhoto)
                    <div class="mt-4">
                        <p class="text-gray-700 mb-2">Preview:</p>
                        <img src="{{ $profilePhoto->temporaryUrl() }}" alt="Profile Picture Preview"
                            class="w-32 h-32 object-cover rounded-full border" />
                    </div>
                @endif
            </div>
        @endif

        @if ($currentFormPage === $formPages)
            <!-- Section 3: Profile Password -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Profile Password</h2>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" wire:model.live="password" placeholder="Enter your password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" wire:model.live="confirmPassword" placeholder="Confirm your password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    @error('confirmPassword')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endif

        <div class="flex justify-between">
            @if ($currentFormPage > 1)
                <!-- Previous Button -->
                <button type="button" wire:click="goToPreviousPage"
                    class="py-2 px-4 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Previous
                </button>
            @else
                <div></div>
            @endif

            @if ($currentFormPage < $formPages)
                <!-- Next Button -->
                <button type="button" wire:click="goToNextPage"
                    class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Next
                </button>
            @endif

            @if ($currentFormPage === $formPages)
                <!-- Submit -->
                <button type="submit"
                    class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create User
                </button>
            @endif
        </div>
    </form>
</div>
