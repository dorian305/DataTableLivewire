<div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required=""
                                wire:model.live="searchValue"
                            >
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>
                            <select 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                wire:model.live="roleFilter"
                            >
                                <option value="0">All</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3" wire:click="updateSort('id')">ID</th>
                                <th scope="col" class="px-4 py-3" wire:click="updateSort('name')">Name</th>
                                <th scope="col" class="px-4 py-3 text-center" wire:click="updateSort('profile_photo_path')">Profile Photo</th>
                                <th scope="col" class="px-4 py-3" wire:click="updateSort('email')">Email</th>
                                <th scope="col" class="px-4 py-3" wire:click="updateSort('role')">Role</th>
                                <th scope="col" class="px-4 py-3" wire:click="updateSort('created_at')">Joined</th>
                                <th scope="col" class="px-4 py-3" wire:click="updateSort('updated_at')">Last update</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b" wire:key="{{ $user->id }}">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $user->id }}</th>
                                    <td class="px-4 py-3">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if ($user->profile_photo_path)
                                            <img src="{{ Storage::url($user->profile_photo_path ?? '') }}" alt="Profile Preview" class="h-16 w-16 mx-auto object-cover rounded-full">
                                        @else
                                            No photo
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-3">
                                        <span class="{{ $user->role === 1 ? 'text-green-500' : '' }}">
                                            {{ $user->role === 1 ? 'admin' : 'user' }}
                                        </span>
                                    </td>e
                                    <td class="px-4 py-3">{{ $user->created_at }}</td>
                                    <td class="px-4 py-3">{{ $user->updated_at }}</td>
                                    <td class="px-4 py-3 h-full flex items-center justify-center align-middle">
                                        <button class="px-3 py-1 bg-red-500 text-white rounded"
                                            wire:click="deleteUser({{ $user->id }})"
                                        >X</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                wire:model.live="itemsPerPage"
                            >
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $users->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>

        <livewire:register-user-form></livewire:register-user-form>
    </section>
</div>