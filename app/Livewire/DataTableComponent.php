<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DataTableComponent extends Component
{
    use WithPagination;

    #[Url(as: 'perPage', history: true)]
    public int $itemsPerPage = 5;

    #[Url(as: 'search', history: true)]
    public string $searchValue = '';

    #[Url(as: 'userType', history: true)]
    public string $roleFilter = '';

    #[Url(as: 'sortBy', history: true)]
    public string $sortingColumn = 'created_at';

    #[Url(as: 'sortDirection', history: true)]
    public string $sortingDirection = 'ASC';

    public function deleteUser(int $userId): void
    {
        User::findOrFail($userId)->delete();
    }

    public function updateSort(string $column): void
    {
        if ($this->sortingColumn === $column) {
            $this->sortingDirection = $this->sortingDirection === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortingColumn = $column;
            $this->sortingDirection = 'ASC';
        }
    }

    public function updateField(int $userId, string $field, mixed $value): void
    {
        $user = User::findOrFail($userId);

        // if ($field === 'name' &&)

        if ($field === 'email' && User::where($field, '=', $value)->exists()) {
            $this->dispatch('email-taken');

            return;
        }

        $user->update([
            $field => $value,
        ]);
    }

    #[On('user-created')]
    public function updateUsers(): void
    {
        // Refreshes the component because of event listener, updating users list.
    }

    public function users()
    {
        return User::search($this->searchValue)
            ->when($this->roleFilter, fn ($query) =>
                $query->where('role', '=', $this->roleFilter)
            )
            ->orderBy($this->sortingColumn, $this->sortingDirection)
            ->paginate($this->itemsPerPage);
    }

    public function render()
    {
        return view('livewire.data-table-component', [
            'users' => $this->users(),
        ]);
    }
}
