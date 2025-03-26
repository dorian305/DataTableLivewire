<?php

namespace App\Livewire;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegisterUserForm extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:10')]
    public string $name = '';

    #[Validate('required|email|unique:users,email')]
    public string $email = '';

    #[Validate('required|string|min:8')]
    public string $password = '';
    
    public int $role = UserRole::USER->value;

    #[Validate('nullable|image')]
    public $profilePhoto;

    public function submit(): void
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ]);

        if ($this->profilePhoto) {
            $user->updateProfilePhoto($this->profilePhoto);
        }

        $this->reset([
            'name',
            'email',
            'password',
            'role',
            'profilePhoto',
        ]);

        session()->flash('status', 'New user created!');

        $this->dispatch('user-created');
    }

    public function render()
    {
        return view('livewire.register-user-form');
    }
}
