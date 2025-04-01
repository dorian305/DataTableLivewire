<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterUserForm extends Component
{
    #[Validate(['required', 'string', 'min:5', 'max:10'])] 
    public string $firstName = '';
    #[Validate(['required', 'string', 'min:5', 'max:10'])]
    public string $lastName = '';
    #[Validate(['required', 'email'])]
    public string $email = '';
    #[Validate(['required', 'min:8'])]
    public string $password = '';
    #[Validate(['required', 'min:8', 'same:password'])]
    public string $confirmPassword = '';
    #[Validate(['nullable', 'image'])]
    public $profilePhoto;
    public int $currentFormPage = 1;
    public int $formPages = 3;

    public array $validationRules = [
        1 => [
            'firstName' => ['required', 'string', 'min:5', 'max:10'],
            'lastName' => ['required', 'string', 'min:5', 'max:10'],
            'email' => ['required', 'email', 'unique:users,email'],
        ],
        2 => [
            'profilePhoto' => ['nullable', 'image'],
        ],
        3 => [
            'password' => ['required', 'min:8'],
            'confirmPassword' => ['required', 'min:8', 'same:password'],
        ],
    ];

    public function render()
    {
        return view('livewire.register-user-form');
    }

    public function goToNextPage(): void
    {
        $this->validate($this->validationRules[$this->currentFormPage]);

        $this->currentFormPage++;
    }

    public function goToPreviousPage(): void
    {
        $this->currentFormPage--;
    }

    public function createUser(): void
    {
        $validationRules = collect($this->validationRules)
            ->collapse()
            ->toArray();

        $this->validate($validationRules);

        $user = User::create([
            'name' => "{$this->firstName} {$this->lastName}",
            'email' => $this->email,
            'password' => $this->password,
        ]);

        session()->flash('created', 'User created successfully!');
    }
}
