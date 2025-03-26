<?php

namespace Tests\Feature\DataTable;

use App\Enums\UserRole;
use App\Livewire\RegisterUserForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class DataTableComponentTest extends TestCase
{
    use DatabaseTransactions;

    public function test_form_can_create_new_user()
    {
        $userData = [
            'name'     => 'John',
            'email'    => 'john@example.com',
            'password' => 'secret123',
            'role'     => UserRole::USER->value,
        ];

        Livewire::test(RegisterUserForm::class)
            ->set('name', $userData['name'])
            ->set('email', $userData['email'])
            ->set('password', $userData['password'])
            ->set('role', $userData['role'])
            ->call('submit')
            ->assertHasNoErrors();

            $this->assertDatabaseHas('users', [
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role' => $userData['role'],
            ]);
    }

    public function test_duplicate_email_not_allowed()
    {
        $userData1 = [
            'name'     => 'John',
            'email'    => 'john@example.com',
            'password' => 'secret123',
            'role'     => UserRole::USER->value,
        ];
        $userData2 = [
            'name'     => 'Blan',
            'email'    => 'john@example.com',
            'password' => 'secret123',
            'role'     => UserRole::USER->value,
        ];

        Livewire::test(RegisterUserForm::class)
            ->set('name', $userData1['name'])
            ->set('email', $userData1['email'])
            ->set('password', $userData1['password'])
            ->set('role', $userData1['role'])
            ->call('submit')
            ->assertHasNoErrors();

        Livewire::test(RegisterUserForm::class)
            ->set('name', $userData2['name'])
            ->set('email', $userData2['email'])
            ->set('password', $userData2['password'])
            ->set('role', $userData2['role'])
            ->call('submit')
            ->assertHasErrors();
    }
}